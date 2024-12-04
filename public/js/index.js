$(document).ready(function () {
    $('.form-submit-comment').on('submit', function (e) {
        e.preventDefault();
        let formData = {
            body: $('#input-comment').val(),
            user_id: $('.form-submit-comment').attr('data-id'),
            movie_id: $('.form-submit-comment').attr('data-movie')
        };
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
        $.ajax({
            url: "/MyMovieList/movie/comment/send",
            type: 'POST',
            data: formData,
            success: function (response) {
                $('.anime__details__review').html(response.view);
                $('#input-comment').val('');
                if (response.error) {
                    $('.toast').addClass('show');
                    $('.toast-body').text(response.error);
                }
            },
            error: function (xhr, status, error) {
                console.error(error); // Xử lý lỗi
                $('#input-comment').val();
            }
        });
    })

    $(".follow-btn").click(function (e) {
        e.preventDefault();
        $(this).children('i').toggleClass('fa-heart-o');
        $(this).children('i').toggleClass('fa-heart');
        let formData = {
            user_id: $(this).attr('data-id'),
            movie_id: $(this).attr('data-movie')
        };
        $.ajax({
            url: "/MyMovieList/movie/follow",
            type: 'GET',
            data: formData,
            success: function (response) {
                if (response.error) {
                    $('.toast').addClass('show');
                    $('.toast-body').text(response.error);
                }
            },
            error: function (xhr, status, error) {
                console.error(error); // Xử lý lỗi
                $('#input-comment').val();
            }
        });
    })

    $(".btn-vote").click(function (e) {
        e.preventDefault();
        $(this).children('i').removeClass('fa-star-o');
        $(this).children('i').addClass('fa-star');
        $(this).prevAll('.btn-vote').children('i').removeClass('fa-star-o');
        $(this).prevAll('.btn-vote').children('i').addClass('fa-star');
        $(this).nextAll('.btn-vote').children('i').removeClass('fa-star');
        $(this).nextAll('.btn-vote').children('i').addClass('fa-star-o');
        let formData = {
            user_id: $(this).attr('data-id'),
            movie_id: $(this).attr('data-movie'),
            star: $(this).attr('data-star'),
        };
        $.ajax({
            url: "/MyMovieList/movie/rating",
            type: 'GET',
            data: formData,
            success: function (response) {
                console.log(response.success)
            },
            error: function (xhr, status, error) {
                console.error(error);
                $('#input-comment').val();
            }
        });
    })

    $('.blog__details__content').on('click', '.btn-reply', function (e) {
        e.preventDefault();
        $('.reply-form').hide();
        let comment = $(this).attr('data-comment');
        let user = $(this).attr('data-id');
        let blog = $(this).attr('data-blog');
        formReply = '<div class="blog__details__form reply-form">' +
            '<form action="#" data-comment="' + comment + '" data-id="' + user + '" data-blog="' + blog + '">' +
            '<div class="row">' +
            '<div class="col-lg-12">' +
            '<textarea placeholder="Message"></textarea>' +
            '<button type="submit" class="site-btn">Send</button>' +
            '</div>' +
            '</div>' +
            '</form>' +
            '</div>'
        $(this).parent('.blog__details__comment__item__text').parent('.blog__details__comment__item').append(formReply);
    })

    $('.blog__details__content').on('submit', '.blog__details__form form', function (e) {
        e.preventDefault();
        let formData = {
            user_id: $(this).attr('data-id'),
            blog_id: $(this).attr('data-blog'),
            comment_id: $(this).attr('data-comment'),
            body: $(this).children('.row').children('.col-lg-12').children('textarea').val()
        };
        console.log(formData);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
        $.ajax({
            url: "/MyMovieList/blog/comment",
            type: 'POST',
            data: formData,
            success: function (response) {
                $('.blog__details__comment').html(response.view);
                $('.blog__details__form form textarea').val('');
                if (response.error) {
                    $('.toast').addClass('show');
                    $('.toast-body').text(response.error);
                }
            },
            error: function (xhr, status, error) {
                console.error(error); // Xử lý lỗi
                $('#input-comment').val();
            }
        });
    })

    $('#image').on('change', function (event) {
        var file = event.target.files[0];
        if (file) {
            if (file.type.startsWith('image/')) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#image-preview').attr('src', e.target.result).show();
                };
                reader.readAsDataURL(file);
            } else {
                alert('Please select a valid image file!');
            }
        }
    });

    $('.report').on('click', function (e) {
        e.preventDefault();
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        Swal.fire({
            title: 'Report this content',
            html: `
                <form id="form-data">
                    <textarea class="swal2-textarea" id="report-input" placeholder="Enter report content"></textarea>
                </form>
            `,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Send',
            cancelButtonText: 'Cancel',
            preConfirm: function () {
                var content = $('#report-input').val();
                return { content: content };
            }
        }).then((result) => {
            if (result.isConfirmed) {
                var content = result.value.content;

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    }
                });
                $.ajax({
                    url: '/MyMovieList/report/handle',
                    method: 'POST',
                    data: {
                        reason: content,
                        reportable_id: id,
                        reportable_type: type
                    },
                    success: function (response) {
                        Swal.fire('Success', 'Your report has been submitted.', 'success');
                    },
                    error: function () {
                        Swal.fire('Error!', 'An error occurred, please try again.', 'error');
                    }
                });
            }
        });
    });

    $('#publish').change(function () {
        var status = $(this).prop('checked') ? 1 : 0;

        $.ajax({
            url: '/MyMovieList/user/publish/status/update',
            method: 'GET',
            data: {
                status: status
            },
            success: function (response) {
                console.log(response)
                if (response.error) {
                    $('.toast').addClass('show');
                    $('.toast-body').text(response.error);
                }
            },
            error: function (xhr, status, error) {
                console.error(error);
                alert('Lỗi kết nối tới server!');
            }
        });
    });
})