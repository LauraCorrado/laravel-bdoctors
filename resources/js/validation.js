import validate from 'validate.js';
/*Regole di convalida apprese:
- allowEmpty false -> per non accettare oggetti, array, stringhe vuoti e o stringhe con spazi bianchi
*/
// form registrazione
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('form-register');

    // Definizione delle regole di convalida
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

    // Funzione per mostrare gli errori
    function showErrors(errors) {
        // Rimuove i messaggi di errore esistenti
        document.querySelectorAll('.invalid-feedback').forEach(el => el.remove());
        // Mostra i nuovi errori
        for (let [inputName, messages] of Object.entries(errors)) {
            const input = document.querySelector(`[name="${inputName}"]`);
            const errorDiv = document.createElement('div');
            errorDiv.className = 'invalid-feedback d-block';
            errorDiv.innerText = messages.join('. ');
            input.classList.add('is-invalid');
            input.parentNode.appendChild(errorDiv);
        }
    }

    // Ascolta l'evento di submit
    form.addEventListener('submit', function (e) {
        e.preventDefault();

        // Esegue la convalida
        const formValues = {
            name: form.querySelector('[name="name"]').value,
            surname: form.querySelector('[name="surname"]').value,
            email: form.querySelector('[name="email"]').value,
            password: form.querySelector('[name="password"]').value,
            password_confirmation: form.querySelector('[name="password_confirmation"]').value,
        };
        
        const errors = validate(formValues, constraints);

        if (errors) {
            showErrors(errors);
        } else {
            form.submit(); // Invia il form se non ci sono errori
        }
    });
});

// form create
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('form-doc-create');
    console.log("Form selezionato:", form);
    // Definizione delle regole di convalida
    const constraints = {
        user_name: {
            presence: { allowEmpty: false, message: "^Il nome è obbligatorio" },
            length: {
                minimum: 2,
                maximum: 100,
                message: "^Il nome deve avere tra 2 e 100 caratteri"
            }
        },
        user_surname: {
            presence: { allowEmpty: false, message: "^Il cognome è obbligatorio" },
            length: {
                minimum: 2,
                maximum: 100,
                message: "^Il cognome deve avere tra 2 e 100 caratteri"
            }
        },
        city: {
            presence: { allowEmpty: false, message: "^La città è obbligatoria" },
            length: { 
                maximum: 100,
                message: "^La città non deve superare i 100 caratteri"
            }
        },
        address: {
            presence: { allowEmpty: false, message: "^L'indirizzo è obbligatorio" },
            length: {
                minimum: 5,
                maximum: 150,
                message: "^L'indirizzo deve avere tra 5 e 150 caratteri"
            }
        },
        phone_number: {
            presence: { allowEmpty: false, message: "^Il numero di telefono è obbligatorio" },
            length: {
                minimum: 10,
                maximum: 20,
                message: "^Il numero deve contenere tra 10 e 20 cifre"
            }
        },
        performance: {
            presence: { allowEmpty: false, message: "^Una descrizione delle prestazioni è obbligatoria" },
            length: {
                minimum: 30,
                message: "^La descrizione deve contenere almeno 30 caratteri"
            }
        },
        fields: {
            presence: { allowEmpty: false, message: "^Seleziona almeno una specializzazione per registrare il tuo profilo"},
            type: "array"
        }
    };    

    // Funzione per mostrare gli errori
    function showErrors(errors) {
        // Rimuove i messaggi di errore esistenti
        document.querySelectorAll('.text-danger').forEach(el => el.remove());
        // Mostra i nuovi errori
        for (let [inputName, messages] of Object.entries(errors)) {
            const input = document.querySelector(`[name="${inputName}"]`);
            const errorDiv = document.createElement('div');
            errorDiv.className = 'text-danger';
            errorDiv.innerText = messages.join('. ');
            input.classList.add('is-invalid');
            input.parentNode.appendChild(errorDiv);
        }
    }

    // Ascolta l'evento di submit
    form.addEventListener('submit', function (e) {
        e.preventDefault();

        // Esegue la convalida
        const formValues = {
            user_name: form.querySelector('[name="user_name"]').value,
            user_surname: form.querySelector('[name="user_surname"]').value,
            city: form.querySelector('[name="city"]').value,
            address: form.querySelector('[name="address"]').value,
            phone_number: form.querySelector('[name="phone_number"]').value,
            performance: form.querySelector('[name="performance"]').value,
            fields: Array.from(form.querySelectorAll('[name="fields[]"]:checked')).map(field => field.value)
        };
        
        const errors = validate(formValues, constraints);

        if (errors) {
            showErrors(errors);
        } else {
            form.submit(); // Invia il form se non ci sono errori
        }
    });
});