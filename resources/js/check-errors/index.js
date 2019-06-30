export function check_errors()
{
    if (window.gym_locator) {
        if (window.gym_locator.hasOwnProperty("errors")) {
            if (window.gym_locator.errors.error_type === "modal") {
                $("#" + window.gym_locator.errors.modal_id).modal('show');
            }
        }
    }
}
