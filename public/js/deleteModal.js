// séléction des boutons supprimer
let btnDelete = $('table .btn-danger');

// séléction du bouton confirmer du modal
let btnDeleteModal = $('div.modal-footer .btn-danger');

// créer un évènement click sur supprimer
btnDelete.on('click',function(event) {
    let href = $(this).attr('href');
    btnDeleteModal.attr({'href':href});
});