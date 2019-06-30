export function upload_service_attachment()
{
    $(".upload-service-attachment").on("change", function() {
        if ($(this).val()) {
            let reader = new FileReader();
            reader.onload = function(e) {
                $('.service-attachment').attr('src', e.target.result);
                $('.service-attachment-container').removeClass("d-none")
            }
            reader.readAsDataURL($(this)[0].files[0]);
        } else {
            $('.service-attachment').attr('src', "");
            $('.service-attachment-container').addClass("d-none")
        }
    })

    $(".remove-service-attachment").on('click', function() {
        $(".upload-service-attachment").val("")
        $('.service-attachment').attr('src', "");
        $('.service-attachment-container').addClass("d-none")
    })
}
