import { textarea } from '../textarea'

export function star_ratings() {
    var SetRatingStar = function(editable = false) {
        var $star_rating = $('.star-rating');
        if (editable) {
            $star_rating = $('.star-rating.editable');
        }
        return $star_rating.each(function() {
            let $local_star_rating = $(this)
            $(this).find('.fa').each(function() {
                if (parseInt($local_star_rating.find('input.rating-value').val()) >= parseInt($(this).data('rating'))) {
                    return $(this).removeClass('fa-star-o').addClass('fa-star');
                } else {
                    return $(this).removeClass('fa-star').addClass('fa-star-o');
                }
            })
        });
    };

    $('.star-rating.editable .fa').on('click', function() {
        $(this).siblings('input.rating-value').val($(this).data('rating'));
        return SetRatingStar(true);
    });

    SetRatingStar();

    $('#my-review-edit').on('click', function() {
        $('#my-review-edit').addClass('d-none')
        $('#my-review-delete').addClass('d-none')
        $('#my-review').addClass('d-none')
        $('#my-review-editing').removeClass('d-none')
        textarea()
    })

    $('#cancel-my-review-editing').on('click', function() {
        $('#my-review-edit').removeClass('d-none')
        $('#my-review-delete').removeClass('d-none')
        $('#my-review').removeClass('d-none')
        $('#my-review-editing').addClass('d-none')
    })

    $('#my-review-delete').on('click', function() {
        let continue_to_delete = confirm('Are you sure you want to delete your review?')
        if (continue_to_delete) {
            $('#my-review-delete-form').submit()
        }
    })

    $('.review-delete').on('click', function() {
        let continue_to_delete = confirm('Are you sure you want to delete this review?')
        if (continue_to_delete) {
            //$('.review-delete-form').submit()
            $(this).siblings('.review-delete-form').submit()
        }
    })
};
