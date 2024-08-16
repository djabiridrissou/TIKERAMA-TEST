@extends('layouts.app')

@section('title', 'Créer une commande')

@section('content')
    <style>
        .input-container {
            position: relative;
            margin-bottom: 1rem;
        }
        .input-container input,
        .input-container select {
            border-radius: 0.375rem;
            border: 1px solid #e2e8f0;
            padding: 0.5rem 1rem;
            width: 100%;
        }
        .input-container span {
            display: block;
            margin-top: 0.25rem;
            font-size: 0.875rem;
            color: #4a5568;
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
        .card-section {
            border-left: 1px solid #e2e8f0;
            padding-left: 2rem;
            margin-left: 2rem;
        }
        .card-section h2 {
            margin-bottom: 1rem;
            font-size: 1.25rem;
            color: #2d3748;
        }
        .card-input {
            margin-bottom: 1rem;
        }
        .card-input label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
        }
        .card-input input {
            border-radius: 0.375rem;
            border: 1px solid #e2e8f0;
            padding: 0.5rem;
            width: 100%;
        }
        .total-price {
            font-size: 1.25rem;
            font-weight: bold;
            color: #2d3748;
            margin: 1rem 0;
        }
        .info-message {
            font-size: 0.875rem;
            color: #4a5568;
            margin-bottom: 0.5rem;
        }
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 1000
        }

        .modal-content {
            background-color: #fff;
            border-radius: 0.375rem;
            padding: 1rem;
            max-width: 500px;
            width: 90%;
            margin: auto;
            text-align: center;
        }

        .close {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 1.5rem;
            cursor: pointer;
            color: #4a5568;
        }
    </style>

    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 sm:items-center py-4 sm:pt-0">
        <div class="max-w-6xl mx-auto flex flex-col sm:px-6 lg:px-8">
            <div class="bg-white w-full p-8 rounded-lg shadow-md flex">
                <div class="flex-1">
                    <p class="border-b-2 border-black text-center text-lg font-semibold mb-4">Créer une commande pour le billet : <span class="text-green-500">{{ $ticketType->ticket_type_name }}</span></p>

                    <form id="orderForm">
                        <div class="input-container">
                            <label for="quantity">Quantité</label>
                            <input id="quantity" type="number" min="1" max="{{ $ticketType->ticket_type_real_quantity }}" required placeholder="Quantité souhaitée">
                            <span id="quantityInfo" class="info-message">Quantité disponible : {{ $ticketType->ticket_type_real_quantity }}</span>
                        </div>
                        <div class="total-price" id="totalPrice">Montant total : 0 F CFA</div>
                    </form>
                </div>

                <div class="card-section">
                    <h2>Informations de paiement</h2>
                    <div class="card-input">
                        <label for="cardNumber">Numéro de carte</label>
                        <input id="cardNumber" type="text" placeholder="1234 5678 9012 3456" required>
                    </div>
                    <div class="card-input">
                        <label for="expiryDate">Date d'expiration</label>
                        <input id="expiryDate" type="text" placeholder="MM/YY" required>
                    </div>
                    <div class="card-input">
                        <label for="cvc">Code de sécurité</label>
                        <input id="cvc" type="text" placeholder="123" required>
                    </div>
                    <button type="button" class="btn bg-blue-500" onclick="processPayment()">Payer</button>
                </div>
            </div>
        </div>
        
    </div>
    <div id="quantityErrorModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <p class="text-center text-sm">La quantité demandée est incorrecte. Veuillez vérifier et réessayer.</p>
        <button class="btn bg-red-500" onclick="closeModal()">OK</button>
    </div>
</div>

    <script>
        function updateTotalPrice() {
            const quantity = document.getElementById('quantity').value;
            const price = {{ $ticketType->ticket_type_price }};
            const totalPrice = quantity * price;
            document.getElementById('totalPrice').textContent = `Montant total : ${totalPrice} F CFA`;
        }

        document.getElementById('quantity').addEventListener('input', updateTotalPrice);

        function processPayment() {
            const quantity = parseInt(document.getElementById('quantity').value, 10);
            const availableQuantity = {{ $ticketType->ticket_type_real_quantity }};
            if (quantity <= 0 || quantity > availableQuantity || !quantity) {
                document.getElementById('quantityErrorModal').style.display = 'flex';
            } else {
                const totalPrice = quantity * {{ $ticketType->ticket_type_price }};
                const orderData = {
                    quantity: quantity,
                    total_price: totalPrice,
                    ticket_type_id: {{ $ticketType->ticket_type_id }}
                };

                fetch('{{ route("order_intent.add") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(orderData)
                })
                .then(response => {
                    if (response.ok) {
                        window.location.href = "{{ route('order_intent.index') }}";
                    } else {
                        console.error('Erreur lors de la création de la commande.', response);
                        throw new Error('Erreur lors de la création de la commande.');
                    }
                })
                .catch(error => {
                    console.error('Erreur:', error);
                });
            }
        }

        function closeModal() {
            document.getElementById('quantityErrorModal').style.display = 'none';
        }
    </script>
@endsection
