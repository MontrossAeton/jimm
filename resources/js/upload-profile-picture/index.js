export function upload_profile_picture()
{
    $("#profile-picture-input").on("change", function() {
        let reader = new FileReader();
        reader.onload = function(e) {
            $('#replace-profile-picture').attr('src', e.target.result);
        }
        reader.readAsDataURL($(this)[0].files[0]);
    });
}