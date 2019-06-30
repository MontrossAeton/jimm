export function upload_post_attachment()
{
    $(".upload-post-attachment").on("change", function() {
        let id = $(this).attr('id')
        let upload_str_length = "upload_post_attachment".length
        id = id.substring(upload_str_length)
        if ($(this).val()) {
            let reader = new FileReader();
            reader.onload = function(e) {
                $('#post_attachment' + id).attr('src', e.target.result);
                $('#post_attachment_container' + id).removeClass("d-none")
            }
            reader.readAsDataURL($(this)[0].files[0]);
        } else {
            $('#post_attachment' + id).attr('src', "");
            $('#post_attachment_container' + id).addClass("d-none")
        }
    })

    $(".remove-post-attachment").on('click', function() {
        let id = $(this).attr('id')
        let remove_str_length = "remove_post_attachment".length
        id = id.substring(remove_str_length)
        let confirm = window.confirm("Are you sure you want to remove the photo?")
        if (confirm) {
            if (id.trim().length > 0) {
                axios.delete(`/posts/${id.substring(1)}/delete-photo`)
                    .then((response) => {
                    })
                    .catch((error) => {
                        console.dir(error)
                    })
            } 
            $("#upload_post_attachment" + id).val("")
            $('#post_attachment' + id).attr('src', "");
            $('#post_attachment_container' + id).addClass("d-none")
        }
    })

    $(".remove-post-attachment-admin").on('click', function() {
        let id = $(this).attr('id')
        let remove_str_length = "remove_post_attachment".length
        id = id.substring(remove_str_length)
        let confirm = window.confirm("Are you sure you want to remove the photo?")
        if (confirm) {
            if (id.trim().length > 0) {
                axios.delete(`/admin/posts/${id.substring(1)}/delete-photo`)
                    .then((response) => {
                    })
                    .catch((error) => {
                    })
            }
            $("#upload_post_attachment" + id).val("")
            $('#post_attachment' + id).attr('src', "");
            $('#post_attachment_container' + id).addClass("d-none")
        }
    })
}
