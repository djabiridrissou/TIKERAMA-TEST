@extends('layouts.app')

@section('title', 'Ajouter un événement')

@section('content')
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
        .input-container {
            position: relative;
            margin-bottom: 1rem;
        }
        .input-container input,
        .input-container textarea,
        .input-container select {
            border-radius: 0.375rem;
            border: 1px solid #e2e8f0;
            padding: 0.5rem 1rem;
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
        .cancel-link {
            display: inline-flex;
            align-items: center;
            font-size: 0.875rem;
            color: #3182ce;
            text-decoration: none;
            font-weight: 600;
            padding: 0.5rem;
            border-radius: 0.375rem;
            background-color: #f1f5f9;
            transition: background-color 0.2s ease, color 0.2s ease;
        }
        .cancel-link:hover {
            background-color: #e2e8f0;
            color: #2b6cb0;
        }
        .cancel-link svg {
            margin-right: 0.5rem;
            width: 1.25rem;
            height: 1.25rem;
            fill: currentColor;
        }
    </style>
</head>
<body class="antialiased">
    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
        <div class="max-w-6xl mx-auto flex flex-col items-center justify-center sm:px-6 lg:px-8">
            <div class="bg-slate-100 w-full p-8 rounded-lg shadow-md">
                <p class="border-b-2 border-black text-center text-lg font-semibold mb-4">Créer un événement</p>
                <span class="text-xs text-gray-600">Remplissez les informations ci-dessous pour créer un nouvel événement</span>
                <div class="mt-4 flex flex-col space-y-4">
                    <div class="input-container">
                        <select id="event_category" required>
                            <option value="Concert-Spectacle">Concert-Spectacle</option>
                            <option value="Dîner">Dîner</option>
                            <option value="Gala">Gala</option>
                            <option value="Festival">Festival</option>
                            <option value="Formation">Formation</option>
                            <option value="Autre">Autre</option>
                        </select>
                        <p id="categoryError" class="error-message"></p>
                    </div>
                    <div class="input-container">
                        <input id="event_title" type="text" required placeholder="Titre de l'événement">
                        <p id="titleError" class="error-message"></p>
                    </div>
                    <div class="input-container">
                        <textarea id="event_description" required placeholder="Description de l'événement"></textarea>
                        <p id="descriptionError" class="error-message"></p>
                    </div>
                    <div class="input-container">
                        <input id="event_date" type="datetime-local" required placeholder="Date de l'événement">
                        <p id="dateError" class="error-message"></p>
                    </div>
                    <div class="input-container">
                        <input id="event_image" type="file" accept="image/*" required placeholder="Image de l'événement">
                        <p id="imageError" class="error-message"></p>
                    </div>
                    <div class="input-container">
                        <input id="event_city" type="text" required placeholder="Ville de l'événement">
                        <p id="cityError" class="error-message"></p>
                    </div>
                    <div class="input-container">
                        <input id="event_address" type="text" required placeholder="Adresse de l'événement">
                        <p id="addressError" class="error-message"></p>
                    </div>
                    <button type="button" class="btn" onclick="validateEventForm()">Créer l'événement</button>
                    <span>
                        <a href="{{ route('events.index') }}" class="cancel-link">
                            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 10.293L18.707 3.586 21.414 6.293 14.707 13 21.414 19.707 18.707 22.414 12 15.707 5.293 22.414 2.586 19.707 9.293 13 2.586 6.293 5.293 3.586 12 10.293z"/></svg>
                            Annuler
                        </a>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="eventModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <p class="text-center text-sm">L'événement a été créé avec succès !</p>
            <button class="btn" onclick="redirectToEvents()">OK</button>
        </div>
    </div>

    <div id="eventErrorModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <p class="text-center text-sm">Une erreur est survenue. Veuillez réessayer.</p>
            <button class="btn bg-red-500" onclick="closeModal()">OK</button>
        </div>
    </div>

    <script>
        function validateEventForm() {
            let valid = true;

            // Réinitialiser les messages d'erreur
            document.getElementById('categoryError').textContent = '';
            document.getElementById('titleError').textContent = '';
            document.getElementById('descriptionError').textContent = '';
            document.getElementById('dateError').textContent = '';
            document.getElementById('imageError').textContent = '';
            document.getElementById('cityError').textContent = '';
            document.getElementById('addressError').textContent = '';

            // Validation de chaque champ
            const category = document.getElementById('event_category').value.trim();
            const title = document.getElementById('event_title').value.trim();
            const description = document.getElementById('event_description').value.trim();
            const date = document.getElementById('event_date').value.trim();
            const image = document.getElementById('event_image').files[0];
            const city = document.getElementById('event_city').value.trim();
            const address = document.getElementById('event_address').value.trim();

            if (category === '') {
                document.getElementById('categoryError').textContent = 'La catégorie est requise.';
                valid = false;
            }

            if (title === '') {
                document.getElementById('titleError').textContent = 'Le titre est requis.';
                valid = false;
            }

            if (description === '') {
                document.getElementById('descriptionError').textContent = 'La description est requise.';
                valid = false;
            }

            if (date === '') {
                document.getElementById('dateError').textContent = 'La date est requise.';
                valid = false;
            }

            if (!image) {
                document.getElementById('imageError').textContent = 'L\'image est requise.';
                valid = false;
            }

            if (city === '') {
                document.getElementById('cityError').textContent = 'La ville est requise.';
                valid = false;
            }

            if (address === '') {
                document.getElementById('addressError').textContent = 'L\'adresse est requise.';
                valid = false;
            }

            if (valid) {
                const formData = new FormData();
                formData.append('event_category', category);
                formData.append('event_title', title);
                formData.append('event_description', description);
                formData.append('event_date', date);
                formData.append('event_image', image);
                formData.append('event_city', city);
                formData.append('event_address', address);

                fetch('{{ route("events.add") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: formData,
                })
                .then(response => {
                    if (response.ok) {
                        document.getElementById('eventModal').style.display = 'flex';
                    } else {
                        console.error('Erreur lors de la création de l\'événement.', response);
                        throw new Error('Erreur lors de la création de l\'événement.');
                    }
                })
                .catch(error => {
                    document.querySelector('#eventErrorModal p').textContent = error.message;
                    document.getElementById('eventErrorModal').style.display = 'flex';
                });
            }
        }

        function closeModal() {
            document.getElementById('eventModal').style.display = 'none';
            document.getElementById('eventErrorModal').style.display = 'none';
        }

        function redirectToEvents() {
            window.location.href = '{{ route("events.index") }}';
        }
    </script>
@endsection
