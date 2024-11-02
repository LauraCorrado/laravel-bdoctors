import './bootstrap';
import '~resources/scss/app.scss';
import '~icons/bootstrap-icons.scss';
import * as bootstrap from 'bootstrap';
import.meta.glob([
    '../img/**'
])

// raccolgo specializzazioni selezionate e le salvo nel div #selectedFields
function updateSelectedFields() {
    const selectedFieldsDiv = document.getElementById('selectedFields');
    selectedFieldsDiv.innerHTML = '';

    const checkboxes = document.querySelectorAll('input[name="fields[]"]:checked');

    checkboxes.forEach((checkbox) => {
        //inserisco testo label della checkbox selezionata
        selectedFieldsDiv.innerHTML += `<strong>${checkbox.nextElementSibling.innerText}</strong><br>`;
    });
    //se è pieno
    if (checkboxes.length > 0) {
        selectedFieldsDiv.style.display = 'block'
    } else {
        selectedFieldsDiv.innerHTML = '<em>Nessuna specializzazione selezionata</em>';
    }
}

// Conferma modale
document.addEventListener('DOMContentLoaded', () => {
    const confirmButton = document.getElementById('confirmButton');
    if (confirmButton) {
        confirmButton.addEventListener('click', () => {
            updateSelectedFields();
            // istanza classe Modal associata alla modale
            const fieldsModal = bootstrap.Modal.getInstance(document.getElementById('fieldsModal'));
            fieldsModal.hide();
        });
    }
});