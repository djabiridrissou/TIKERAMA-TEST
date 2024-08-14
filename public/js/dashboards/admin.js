$(document).ready(function() {
    $('#inscriptions-table').DataTable({
        processing: true,
        serverSide: false,
        paging: true,
        searching: true,
        order: [[0, 'desc']], // default(id)
        columnDefs: [
            {
                targets: -1,
                orderable: false,
            }
        ]
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('confirmationModal');
    const closeModalBtn = document.getElementById('closeModalBtn');
    const closeModal = document.getElementById('closeModal');

    // Affiche le modal si une session 'status' est présente
    if(session('status')) modal.classList.remove('hidden');


    // Ferme le modal lorsque le bouton de fermeture est cliqué
    closeModalBtn.addEventListener('click', function() {
        modal.classList.add('hidden');
    });

    closeModal.addEventListener('click', function() {
        modal.classList.add('hidden');
    });
});