// --- VALIDAZIONE REGISTRAZIONE: uso di validate.js library ---
import validate from 'validate.js';
document.addEventListener('DOMContentLoaded', function () {
    // Recupero del form di registrazione
    const reg_form = document.getElementById('form-register')
    // Definizione delle regole di convalida, secondo lo standard di validatejs
    const constraints = {
        name: {
            presence: { allowEmpty: false, message: "^Il nome è obbligatorio" },
            length: { minimum: 3, message: "^Il nome deve avere almeno 3 caratteri" }
        },
        surname: {
            presence: { allowEmpty: false, message: "^Il cognome è obbligatorio" },
            length: { minimum: 3, message: "^Il cognome deve avere almeno 3 caratteri" }
        },
        email: {
            presence: { allowEmpty: false, message: "^L'email è obbligatoria" },
            email: { message: "^Inserisci un indirizzo email valido" }
        },
        password: {
            presence: { allowEmpty: false, message: "^La password è obbligatoria" },
            length: { minimum: 6, message: "^La password deve avere almeno 6 caratteri" }
        },
        password_confirmation: {
            presence: { allowEmpty: false, message: "^La conferma della password è obbligatoria" },
            equality: { attribute: "password", message: "^Le password devono coincidere" }
        }
    };
    // Funzione per mostrare gli errori con parametro che rappresenta l'oggetto contenente gli errori di validazione
    function showErrors(errors) {
        // Rimozione messaggi di errore già esistenti (lato back-end) tramite foreach
        document.querySelectorAll('.invalid-feedback').forEach(el => el.remove())
        // Mostro nuovi errori (ciclo for...of e conversione dell'oggetto errors in array di array). inputName è il valore di name e messages sono i messaggi d'errore associati
        for (let [inputName, messages] of Object.entries(errors)) {
            const input = document.querySelector(`[name="${inputName}"]`)
            // creazione del div per ogni errore, con classi e testi concatenati e separati da un punto
            const errorDiv = document.createElement('div')
            errorDiv.className = 'invalid-feedback d-block'
            errorDiv.innerText = messages.join('. ')
            // aggiungo is-invalid come classe dell'input per evidenziare l'errore
            input.classList.add('is-invalid')
            // aggiungiamo come ultimo figlio del del contenitore di input
            input.parentNode.appendChild(errorDiv)
        }
    }
    // Evento submit
    if(reg_form) {

        reg_form.addEventListener('submit', function (e) {
            e.preventDefault();
            // salvo i valori del form in un oggetto
            const formValues = {
                name: reg_form.querySelector('[name="name"]').value,
                surname: reg_form.querySelector('[name="surname"]').value,
                email: reg_form.querySelector('[name="email"]').value,
                password: reg_form.querySelector('[name="password"]').value,
                password_confirmation: reg_form.querySelector('[name="password_confirmation"]').value,
            };
            // uso funzione di validatejs per controllare i formValues attraverso le regole definite sopra in constraints
            const errors = validate(formValues, constraints);
            // se ci sono errori, mostrali; altrimenti sottometti il form
            if (errors) {
                showErrors(errors)
            } else {
                reg_form.submit()
            }
        });
    } else {
        console.log('Qui non puoi visualizzare il form della registrazione')
    }
});

// --- VALIDAZIONE CREATE: js vanilla ---
const create_form = document.getElementById("form-doc-create");
if(create_form) {

    create_form.addEventListener("submit", function(event) {
        // flag a true, assumendo di base che i valori siano validi
        let formIsValid = true
        // Rimuovo tutti i messaggi di errore preesistenti
        document.querySelectorAll(".text-danger").forEach(error => error.remove());
        
        // --- Gestione dei valori dei campi (uso di trim() per evitare spazi iniziali e finali). Commenti uguali per tutti gli input, ma ne aggiungo se c'è da specificare altro ---
        // CITY
        const city = document.getElementById("city").value.trim();
        // se il valore di city è vuoto o è maggiore della sua lunghezza massima
        if (!city || city.length > 50) {
            // creazione div del messaggio di errore subito dopo l'input, con aggiunta classi e testo a seconda se city è vuoto o no
            const error = document.createElement("div");
            error.className = "text-danger";
            error.innerText = city ? "La città non può superare i 50 caratteri." : "Questo campo è obbligatorio.";
            document.getElementById("city").after(error);
            // il form non è valido
            formIsValid = false;
        }
    
        // ADDRESS
        const address = document.getElementById("address").value.trim();
        if (!address || address.length < 5 || address.length > 100) {
            const error = document.createElement("div");
            error.className = "text-danger";
            error.innerText = !address ? "Questo campo è obbligatorio." :
                              address.length < 5 ? "L'indirizzo deve contenere almeno 5 caratteri." :
                              "L'indirizzo non può superare i 100 caratteri.";
            document.getElementById("address").after(error);
            formIsValid = false;
        }
    
        // PHONE NUMBER
        const phoneNumber = document.getElementById("phone_number").value.trim();
        if (!phoneNumber || phoneNumber.length < 10 || phoneNumber.length > 15) {
            const error = document.createElement("div");
            error.className = "text-danger";
            error.innerText = !phoneNumber ? "Questo campo è obbligatorio." :
                              phoneNumber.length < 10 ? "Il numero di telefono deve contenere almeno 10 cifre." :
                              "Il numero di telefono non può essere superiore a 15 cifre.";
            document.getElementById("phone_number").after(error);
            formIsValid = false;
        }
    
        // PERFORMANCE
        const performance = document.getElementById("performance").value.trim();
        if (!performance || performance.length < 30) {
            const error = document.createElement("div");
            error.className = "text-danger";
            error.innerText = !performance ? "Questo campo è obbligatorio." :
                              "La descrizione delle prestazioni deve contenere almeno 30 caratteri.";
            document.getElementById("performance").after(error);
            formIsValid = false;
        }
    
        // FIELDS
        const fields = document.querySelectorAll('input[name="fields[]"]:checked');
        // almeno una checkbox deve essere stata selezionata
        if (fields.length === 0) {
            const error = document.createElement("div");
            error.className = "text-danger";
            error.innerText = "Seleziona almeno una specializzazione.";
            document.querySelector('label[for="fields"]').after(error);
            formIsValid = false;
        }
        // Se il form non è valido, previeni submit e refresh pagina
        if (!formIsValid) {
            event.preventDefault();
        }
    });
} else {
    console.log('Qui non puoi visualizzare il form della create')
}

