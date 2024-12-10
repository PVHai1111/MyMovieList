$(document).ready(function(){
    $('.btn-close-toast').click(function(){
        $(this).parent('.toast-header').parent('.toast').removeClass('show')
    })
})