<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
        .input-container {
            position: relative;
            margin-bottom: 1rem;
        }
        .input-container input {
            border-radius: 0.375rem;
            border: 1px solid #e2e8f0;
            padding: 0.5rem 2.5rem 0.5rem 1rem;
            width: 100%;
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
            width: 100%;
        }
        .btn:hover {
            background-color: #2b6cb0;
        }
        .error-message {
            color: #e3342f;
            font-size: 0.875rem;
            margin-top: 0.5rem;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.5);
            justify-content: center;
            align-items: center;
        }
        .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            width: 80%;
            max-width: 500px;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body class="antialiased">
    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
        <div class="max-w-6xl mx-auto flex flex-col items-center justify-center sm:px-6 lg:px-8">
            <div class="bg-slate-100 w-full p-8 rounded-lg shadow-md">
                <p class="border-b-2 border-black text-center text-lg font-semibold mb-4">Créer un compte utilisateur</p>
                <span class="text-xs text-gray-600">Remplissez les informations ci-dessous pour demander l'accès à nos services</span>
                <div class="mt-4 flex flex-col space-y-4">
                    <div class="input-container">
                        <input id="name" type="text" required placeholder="Nom" class="w-full">
                        <p id="nameError" class="error-message"></p>
                    </div>
                    <div class="input-container">
                        <input id="surname" type="text" required placeholder="Prénom" class="w-full">
                        <p id="surnameError" class="error-message"></p>
                    </div>
                    <div class="input-container">
                        <input id="enterprise" type="text" required placeholder="Entreprise" class="w-full">
                        <p id="enterpriseError" class="error-message"></p>
                    </div>
                    <div class="input-container">
                        <input id="email" type="email" required placeholder="Adresse mail" class="w-full">
                        <p id="emailError" class="error-message"></p>
                    </div>
                    <div class="input-container">
                        <input id="address" type="text" required placeholder="Adresse" class="w-full">
                        <p id="addressError" class="error-message"></p>
                    </div>
                    <button type="button" class="btn" onclick="validateForm()">S'inscrire</button>
                </div>
                <div class="flex items-center justify-center mt-4 text-xs">
                    <span>Vous avez déjà un compte ?</span>
                    <a href="{{ route('login') }}" class="text-blue-600 ml-1 cursor-pointer">Connectez-vous</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <p class="text-center text-sm">Merci de votre inscription ! Vous recevrez un email avec vos identifiants après validation par l'administrateur.</p>
            <button class="btn" onclick="redirectToLogin()">OK</button>
        </div>
    </div>

    <div id="myErrorModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <p class="text-center text-sm">Une erreur est survenue. Veuillez réessayer.</p>
            <button class="btn bg-red-500" onclick="closeModal()">OK</button>
        </div>
    </div>

    <script>
        function validateEmail(email) {
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email);
        }

        function validateForm() {
            let valid = true;

            // Réinitialiser les messages d'erreur
            document.getElementById('nameError').textContent = '';
            document.getElementById('surnameError').textContent = '';
            document.getElementById('enterpriseError').textContent = '';
            document.getElementById('emailError').textContent = '';
            document.getElementById('addressError').textContent = '';

            // Validation de chaque champ
            const name = document.getElementById('name').value.trim();
            const surname = document.getElementById('surname').value.trim();
            const enterprise = document.getElementById('enterprise').value.trim();
            const email = document.getElementById('email').value.trim();
            const address = document.getElementById('address').value.trim();

            if (name === '') {
                document.getElementById('nameError').textContent = 'Le nom est requis.';
                valid = false;
            }

            if (surname === '') {
                document.getElementById('surnameError').textContent = 'Le prénom est requis.';
                valid = false;
            }

            if (enterprise === '') {
                document.getElementById('enterpriseError').textContent = 'L\'entreprise est requise.';
                valid = false;
            }

            if (!validateEmail(email)) {
                document.getElementById('emailError').textContent = 'Adresse mail invalide.';
                valid = false;
            }

            if (address === '') {
                document.getElementById('addressError').textContent = 'L\'adresse est requise.';
                valid = false;
            }

            if (valid) {
                const formData = {
                    name: document.getElementById('name').value.trim(),
                    surname: document.getElementById('surname').value.trim(),
                    enterprise: document.getElementById('enterprise').value.trim(),
                    email: document.getElementById('email').value.trim(),
                    address: document.getElementById('address').value.trim()
                };

                fetch('{{ route("inscription.store") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify(formData),
                })
                .then(response => {
                    if (response.redirected == false) {
                        document.getElementById('myModal').style.display = 'flex';
                    } else {
                        return response.text().then(text => {
                            throw new Error('Adresse mail déja utilisée');
                        });
                    }
                })
                .catch(error => {
                    document.querySelector('#myErrorModal p').textContent = error.message;
                    document.getElementById('myErrorModal').style.display = 'flex';
                });
    
            }   
        }

        function closeModal() {
            document.getElementById('myModal').style.display = 'none';
            document.getElementById('myErrorModal').style.display = 'none';
        }

        function redirectToLogin() {
            window.location.href = "{{ route('login') }}";
        }
    </script>
</body>
</html>
