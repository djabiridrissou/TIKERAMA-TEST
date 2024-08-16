<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserInscription;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserApproveMail;
use Illuminate\Support\Str;

class UserInscriptionController extends Controller
{

    public function index()
    {
        try {
            // Récupérer tous les éléments de la table avec pagination
            $inscriptions = UserInscription::paginate(1);
            
            // Retourner la vue avec les inscriptions
            return view('admin.inscriptions', ['inscriptions' => $inscriptions]);
        } catch (\Exception $e) {
            // Gestion des erreurs
            Log::error('Error fetching inscriptions: ' . $e->getMessage());
            return redirect()->route('admin.dashboard')->with('error', 'Une erreur est survenue lors de la récupération des inscriptions.');
        }
    }

    public function store(Request $request)
    {
        Log::info('Request data: ', $request->all());
        // Validation
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'enterprise' => 'required|string|max:255',
            'email' => 'required|email|unique:user_inscriptions,email',
            'address' => 'required|string|max:255',
        ]);

        try {
            $existingUser = User::where('email', $validatedData['email'])->first();
            if ($existingUser) {
                if ($request->ajax()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'L\'adresse email est déjà utilisée.'
                    ]);
                } else {
                    return redirect()->back()->withErrors(['email' => 'L\'adresse email est déjà utilisée.']);
                }
            }

            // new user
            UserInscription::create($validatedData);
            // Réponse
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Inscription réussie. Vous recevrez un email avec vos identifiants après validation.',
                    'request_data' => $request->all(),
                ]);
            }

        } catch (\Illuminate\Database\QueryException $e) {
            // Gestion spécifique des erreurs de base de données
            Log::error('User inscription error: ' . $e->getMessage());
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Une erreur est survenue. L\'adresse mail est peut-être déjà utilisée.'
                ]);
            }

        } catch (\Exception $e) {
            // Réponse en cas d'erreur
            Log::error('User inscription error: ' . $e->getMessage());
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Une erreur est survenue. Veuillez réessayer.'
                ]);
            }
        }
    }

    public function approve($id)
    {
        $userInscription = UserInscription::findOrFail($id);
        //mdp par défaut
        if ($userInscription) {
            $password = Str::random(8);
            $user = User::create([
                'name' => $userInscription->name,
                'surname' => $userInscription->surname,
                'email' => $userInscription->email,
                'password' => Hash::make($password),
                'enterprise' => $userInscription->enterprise,
                'address' => $userInscription->address,
                'role' => 'vendeur',
            ]);

            $userInscription->delete();
            Mail::to($user->email)->send(new UserApproveMail($user, $password));
            return redirect()->route('admin.dashboard')->with('status', 'Inscription approuvée.');
        }
        return redirect()->route('admin.dashboard')->with('error', 'L\'inscription n\'existe pas.');
    }
}
