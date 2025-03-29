import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ["username", "password", "button"]

    keydown(event) {
        if (event.key === "enter") {
            event.preventDefault();
        }

        this.buttonTarget.disabled = this.usernameTarget.value.trim().length === 0 ||
            this.passwordTarget.value.trim().length === 0;
    }
}
