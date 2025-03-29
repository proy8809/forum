import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = [
        "username",
        "firstName",
        "lastName",
        "password",
        "passwordConfirmation",
        "button"
    ]

    keydown(event) {
        if (event.key === "enter") {
            event.preventDefault();
        }

        const valuesToAssert = [
            this.usernameTarget.value,
            this.firstNameTarget.value,
            this.lastNameTarget.value,
            this.passwordTarget.value,
            this.passwordConfirmationTarget.value
        ];

        this.buttonTarget.disabled = valuesToAssert.some(valueToAssert => valueToAssert.trim().length === 0);
    }
}
