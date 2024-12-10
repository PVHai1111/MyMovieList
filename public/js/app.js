$(document).ready(function () {

    if ($('.slim-select').length > 0) {
        $('.slim-select').each(function () {
            new SlimSelect({
                select: this,
                allowDeselect: true,
                closeOnSelect: false,
                showSearch: true,
            });
        })
    }

    if ($('#editor').length > 0) {
        // Khởi tạo Quill nếu #editor tồn tại
        var quill = new Quill('#editor', {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{ 'font': [] }],
                    [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'color': [] }, { 'background': [] }],
                    [{ 'script': 'sub' }, { 'script': 'super' }],
                    [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                    [{ 'indent': '-1' }, { 'indent': '+1' }],
                    [{ 'align': [] }],
                    ['link', 'image', 'video'],
                    ['clean']
                ]
            }
        });

        var biography = $('.text-editor').val();

        quill.clipboard.dangerouslyPasteHTML(biography);

        quill.on('text-change', function () {
            var content = quill.root.innerHTML;
            $('.text-editor').val(content);
        });
    }

    $('.nav-link.active .sub-menu').slideDown();

    $('#sidebar-menu .arrow').click(function () {
        $(this).parents('li').children('.sub-menu').stop().slideToggle();
        $(this).toggleClass('fa-angle-right fa-angle-down');
    });

    $("input[name='checkall']").click(function () {
        var checked = $(this).is(':checked');
        $('.table-checkall tbody tr td input:checkbox').prop('checked', checked);
    });

    $('.btn-close-toast').click(function () {
        $(this).parent('.toast-header').parent('.toast').removeClass('show')
    })

    $(document).on('click', '.delete-link', function (event) {
        event.preventDefault();
        const href = $(this).attr('href');

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = href;
            }
        });
    });

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
                $('#image-preview').hide();
            }
        } else {
            $('#image-preview').hide();
        }
    });
});