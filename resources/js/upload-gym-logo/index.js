export function upload_gym_logo()
{
    $("#change-logo").on("change", function() {
        if ($(this).val()) {
            let reader = new FileReader();
            reader.onload = function(e) {
                $('#logo').attr('src', e.target.result);
            }
            reader.readAsDataURL($(this)[0].files[0]);
        } else {
            $('#logo').attr('src', "/img/company-logo.png");
        }
    })
    $("#remove-logo").on('click', function() {
        $("#delete-gym-logo").submit()
    })
}
