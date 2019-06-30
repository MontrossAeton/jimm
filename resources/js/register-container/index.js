export function register_container()
{
    $("#register-container .customer-tab").on('click', function() {
        $("#register-container").removeClass("col-8").addClass("col-4")
    })
    $("#register-container .gym-owner-tab").on('click', function() {
        $("#register-container").removeClass("col-4").addClass("col-8")
    })
}
