export function has_messages() {
    if (window.gym_locator.has_success_message) {
        $("#flash-message-success").delay( 5000 ).slideUp(300);
    }

    if (window.gym_locator.has_info_message) {
        $("#flash-message-info").delay( 5000 ).slideUp(300);
    }

    if (window.gym_locator.has_danger_message) {
        $("#flash-message-danger").delay( 5000 ).slideUp(300);
    }
}
