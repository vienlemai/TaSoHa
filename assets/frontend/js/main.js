$(document).ready(function() {
    $('#form-login').on('submit', function() {
        var $_this = $(this);
        $.ajax({
            type: $_this.attr('method'),
            url: $_this.attr('action'),
            data: $_this.serialize(),
            success: function(response) {
                if (response.success) {
                    location.reload();
                } else {
                    console.log(response.message);
                }
            }
        });
        return false;
    });

    $('#go-top').on('click', function() {
        Helper.scoll_to_top();
        return false;
    });
    $("ul.marquee").liScroll();
   
});