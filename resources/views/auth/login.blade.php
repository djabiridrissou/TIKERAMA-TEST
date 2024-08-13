<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tikerama</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    <!-- Styles -->
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
        .input-container {
            position: relative;
        }
        .input-container input {
            border-radius: 0.375rem; /* Rounded corners */
            border: 1px solid #e2e8f0;
            padding: 0.5rem 2.5rem 0.5rem 1rem; /* Padding for input */
        }
        .input-container .eye-icon {
            position: absolute;
            right: 0.5rem;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 1rem;
        }
        .input-container input[type="password"] {
            padding-right: 2.5rem; /* Space for eye icon */
        }
        .btn {
            display: inline-block;
            padding: 0.5rem 1.5rem;
            border-radius: 0.375rem;
            background-color: #3182ce;
            color: #fff;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }
        .btn:hover {
            background-color: #2b6cb0;
        }
    </style>
</head>
<body class="antialiased">
    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
        <div class="max-w-6xl mx-auto flex flex-col items-center justify-center sm:px-6 lg:px-8">
            <div class="bg-slate-100 w-full p-6 rounded-lg shadow-md">
                <p class="border-b-2 border-black text-center text-lg font-semibold mb-4">Tikerama</p>
                <span class="text-xs text-gray-600">Connectez-vous pour accéder aux fonctionnalités</span>
                <form method="POST" action="{{ route('login') }}" class="mt-4 flex flex-col space-y-4">
                    @csrf
                    <div class="input-container">
                        <input type="email" name="email" id="email" placeholder="Entrez votre mail" class="w-full">
                    </div>
                    <div class="input-container">
                        <input type="password" name="password" id="password" placeholder="Entrez votre mot de passe" class="w-full">
                        <span class="eye-icon" id="toggle-password">
                            👁️
                        </span>
                    </div>
                    <button type="submit" class="btn">Se connecter</button>
                </form>
                <div class="flex items-center justify-center mt-4 text-xs">
                    <span>Vous n'avez pas de compte ?</span>
                    <a href="{{ route('register') }}" class="text-blue-600 ml-1 cursor-pointer">Créez un compte</a>
                </div>
            </div>
        </div>
    </div>
    

    <script>
        document.getElementById('toggle-password').addEventListener('click', function() {
            var passwordInput = document.getElementById('password');
            var type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
        });
    </script>
</body>
</html>
