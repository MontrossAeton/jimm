export function upload_gym_images() {
    let files = []

    $("#gym-images-form").on('submit', function(e) {
        e.preventDefault()
        if (files.length > 0) {
            let data = new FormData()
            data.append(`action-type`, "create-gym-images-modal")
            for (let i = 0, length = files.length; i < length; i++) {
                data.append(`images[${i}]`, files[i])
            }

            $(this).find('button,input,textarea,label').prop("disabled", true)
            $(this).find('button,input,textarea,label').addClass("disabled cursor-not-allowed")
            $("#gym-images-progress-bar").removeClass("d-none")
            let config = {
                onUploadProgress: function(progressEvent) {
                    let percentCompleted = Math.round( (progressEvent.loaded * 100) / progressEvent.total );
                    $("#gym-images-progress-bar div.progress-bar").prop("aria-valuenow", percentCompleted)
                    $("#gym-images-progress-bar div.progress-bar").css({
                        "width": percentCompleted + "%",
                    })
                    $("#gym-images-progress-bar strong").html(`${percentCompleted}%`)
                }
            };
            axios.post("/admin/gym-images", data, config)
                .then((response) => {
                    window.location.reload(false)
                })
                .catch((error) => {
                    console.dir(error)
                })
        }
    })
    $("input:file#gym-images").on('change', function() {
        if ($(this)[0].files.length > 0) {
            $("#gym-images-container").removeClass("d-none")

            for (let i = 0, length = $(this)[0].files.length; i < length; i++) {
                let uuidv4 = require('uuid/v4')
                let uuid = uuidv4()
                $(this)[0].files[i].id = uuid
                    $("#gym-images-container").append(`
                        <div class="col-3 pt-4" id="gym_image_${uuid}">
                            <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                <img id="gym-image-image-${uuid}" src="" class="img-fluid" />
                                <button type="button" id="${uuid}" class="remove-gym-image btn btn-outline-danger">
                                    Remove
                                </button>
                            </div>
                        </div>
                    `)

                    let reader = new FileReader();
                    reader.onload = function(e) {
                        $('#gym-image-image-' + uuid).attr('src', e.target.result);
                    }
                    reader.readAsDataURL($(this)[0].files[i]);
            }
            files = [...files, ...$(this)[0].files]

            $(".remove-gym-image").on('click', function() {
                let id = $(this).prop("id")
                let index = files.findIndex((file) => {
                    return file.id === id
                })

                if (index >= 0) {
                    files.splice(index, 1)
                }
                $("#gym_image_" + id).remove()

                if (files.length <= 0) {
                    $("#gym-images-container").addClass("d-none")
                }
            })
            $(this).val("")
        }
    })
}
