/*
 * Author Lht
 * Helper to help you display flash messages, scrolling body, simple modal(updating)
 * 
 * Required Bootstrap3 , jquery ~> 1.7
 */
Helper = {
    scroll_to: function(element, delay_time, container, offset) {
        if (!element)
            element = 'html';
        if (!container)
            container = 'html, body';
        if (!delay_time)
            delay_time = 400;
        if (!offset)
            offset = 10;
        $(container).animate({scrollTop: $(element).offset().top - offset}, delay_time);
    },
    create_message_panel: function(type, message) {
        var div = $('<div data-alert="alert" class="alert alert-dismissable fade in">' +
          '<button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>');
        $(div).addClass("alert-" + type);

        // Fix for compatibility with frontend css
        if (type == 'error') {
            $(div).addClass('alert-warning');
        } else if (type == 'success') {
            $(div).addClass('alert-success');
        }
        $(div).append(message);
        return $(div);
    },
    flash_message: function(type, message, container, delay_time, append) {
        var msg_panel = this.create_message_panel(type, message);
        if (!container)
            container = ".alert-page"; // Fixed
        if (append)
            $(container).append(msg_panel);
        else
            $(container).html(msg_panel);
        if (typeof (delay_time) !== "undefined" && delay_time && !isNaN(delay_time)) {
            setTimeout(function() {
                $(msg_panel).fadeOut(function() {
                    $(msg_panel).remove();
                    $(container).show();
                });
            }, delay_time);
        }
    },
    scoll_to_top: function() {
        this.scroll_to('html');
    },
    togglePageLoadingIndicator: function(state) {
        if (state) {
            var html = '<div id="page-loading">' +
              '<div id="loading-wrap">' +
              '<div class="loading_block" id="loading_block_1">' +
              '</div>' +
              '<div class="loading_block" id="loading_block_2">' +
              '</div>' +
              '<div class="loading_block" id="loading_block_3">' +
              '</div>' +
              '</div>' +
              '</div>';
            html += '<div id="loading-backdrop"></div>';
            $('body').prepend(html);
        } else {
            if ($('#page-loading').length !== 0) {
                $('#page-loading').remove();
                if ($('#loading-backdrop').length !== 0) {
                    $('#loading-backdrop').remove();
                }
            }
        }

    }
};
