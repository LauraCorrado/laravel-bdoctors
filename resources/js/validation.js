import validate from 'validate.js';
// form registrazione
console.log("validation.js loaded");
document.addEventListener('DOMContentLoaded', function () {
    const forms = [
        {
            formId: 'form-register',
            constraints: {
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
            }
        },
        {
            formId: 'form-doc-create',
            constraints: {
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
                address: {
                    presence: { allowEmpty: false, message: "^L'indirizzo è obbligatorio" },
                    length: {
                        minimum: 5,
                        maximum: 150,
                        message: "^L'indirizzo deve avere tra 5 e 150 caratteri"
                    }
                },
                city: {
                    presence: { allowEmpty: false, message: "^La città è obbligatoria" },
                    length: { 
                        maximum: 100,
                        message: "^La città non deve superare i 100 caratteri"
                    }
                },
                phone_number: {
                    presence: { allowEmpty: false, message: "^Il numero di telefono è obbligatorio" },
                    length: {
                        minimum: 10,
                        maximum: 20,
                        message: "^Il numero deve contenere tra 10 e 20 cifre"
                    },
                    format: {
                        pattern: /^[0-9]+$/,
                        message: "^Il numero di telefono può contenere solo numeri"
                    }
                },
                cv: {
                    presence: false
                },
                thumb: {
                    presence: false
                },
                fields: {
                    presence: { allowEmpty: false, message: "^Seleziona almeno una specializzazione per registrare il tuo profilo"},
                    type: "array",
                    length: {
                        minimum: 1,
                        message: "^Devi selezionare almeno una specializzazione"
                    }
                },
                performance: {
                    presence: { allowEmpty: false, message: "^Una descrizione delle prestazioni è obbligatoria" },
                    length: {
                        minimum: 30,
                        message: "^La descrizione deve contenere almeno 30 caratteri"
                    }
                }
            }
        }
    ]
    
    forms.forEach(({ formId, constraints }) => {
        const form = document.getElementById(formId);

        if(form) {
            console.log(`Form found: ${formId}`);
            form.addEventListener('submit', function (ev) {
                ev.preventDefault()
                const formValues = Array.from(form.elements).reduce((values, input) => {
                    if (input.name) {
                        values[input.name] = input.type === 'checkbox' && input.checked ? input.value : input.value;
                    }
                    return values;
                }, {});
                const errors = validate(formValues, constraints);
                if (errors) {
                    showErrors(errors, form);
                } else {
                    console.log("No validation errors");
                    form.submit();
                }
            })
        }
    })

    // Funzione per mostrare gli errori
    function showErrors(errors, form) {
        //rimozione messaggi di errore server-side
        form.querySelectorAll('.invalid-feedback').forEach(el => el.remove());
        form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
        
        for (let [inputName, messages] of Object.entries(errors)) {
            const input = form.querySelector(`[name="${inputName}"]`);
            if (input) {
                console.log(`Mostro errore per ${inputName}: ${messages.join('. ')}`);  // Aggiungi questa riga
                const errorDiv = document.createElement('div');
                errorDiv.className = 'invalid-feedback d-block';
                errorDiv.innerText = messages.join('. ');
                input.classList.add('is-invalid');
                input.parentNode.appendChild(errorDiv);
            }
        }
    }
});