export function upload_ad_attachment()
{
    $(".upload-ad-attachment").on("change", function() {
        let id = $(this).attr('id')
        let upload_str_length = "upload_ad_attachment".length
        id = id.substring(upload_str_length)
        if ($(this).val()) {
            let reader = new FileReader();
            reader.onload = function(e) {
                $('#ad_attachment' + id).attr('src', e.target.result);
                $('#ad_attachment_container' + id).removeClass("d-none")
            }
            reader.readAsDataURL($(this)[0].files[0]);
        } else {
            $('#ad_attachment' + id).attr('src', "");
            $('#ad_attachment_container' + id).addClass("d-none")
        }
    })

    $(".remove-ad-attachment").on('click', function() {
        let id = $(this).attr('id')
        let remove_str_length = "remove_ad_attachment".length
        id = id.substring(remove_str_length)
        let confirm = window.confirm("Are you sure you want to remove the photo?")
        if (confirm) {
            if (id.trim().length > 0) {
                axios.delete(`/ads/${id.substring(1)}/delete-photo`)
                    .then((response) => {
                    })
                    .catch((error) => {
                        console.dir(error)
                    })
            } 
            $("#upload_ad_attachment" + id).val("")
            $('#ad_attachment' + id).attr('src', "");
            $('#ad_attachment_container' + id).addClass("d-none")
        }
    })

    $(".remove-ad-attachment-admin").on('click', function() {
        let id = $(this).attr('id')
        let remove_str_length = "remove_ad_attachment".length
        id = id.substring(remove_str_length)
        let confirm = window.confirm("Are you sure you want to remove the photo?")
        if (confirm) {
            if (id.trim().length > 0) {
                axios.delete(`/admin/ads/${id.substring(1)}/delete-photo`)
                    .then((response) => {
                    })
                    .catch((error) => {
                    })
            }
            $("#upload_ad_attachment" + id).val("")
            $('#ad_attachment' + id).attr('src', "");
            $('#ad_attachment_container' + id).addClass("d-none")
        }
    })
}
