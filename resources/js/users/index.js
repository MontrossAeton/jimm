export function users()
{
    $(".user-delete").on('click', function() {
        let continue_to_delete = confirm('Are you sure you want to deactivate this user?')
        if (continue_to_delete) {
            //$('.review-delete-form').submit()
            $(this).siblings('.user-delete-form').submit()
        }
    })
    $(".user-restore").on('click', function() {
        let continue_to_delete = confirm('Are you sure you want to restore this user?')
        if (continue_to_delete) {
            //$('.review-delete-form').submit()
            $(this).siblings('.user-restore-form').submit()
        }
    })
}
