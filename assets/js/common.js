/**
 * Author: Lht
 * 
 * Submit forms has class 'form-ajax'
 * 
 * JSON response structure
 * {
 *   'sucess': true|false
 *   'message': '...'
 *   'html': '<p>...</p>'
 * }
 * 
 * If you need to update html for a specify element after server responsed,
 * add attribute with name is 'data-update-html-for' and value is selector of that element.
 * The html return from server will be replace to the specified element.
 * 
 * If your form has a element with class '.form-messages'. The messages from server
 * will be append to it.
 * 
 */

$('body').on('submit', '.form-ajax', function() {
    var $_this = $(this);
    var options = {
        url: $_this.attr('action'),
        type: $_this.attr('method'),
        dataType: 'JSON',
        beforeSend: function() {
            // Disable submitter
            $_this.find('[type=submit]').attr('disabled', true);
            // Clear old messages
            if ($_this.find('.form-messages').length !== 0) {
                $_this.find('.form-messages').html('');
            }
        },
        success: function(response) {
            if (response.success) {
                if ($_this.data('update-html-for')) {
                    var $replace_html_to = $($_this.data('update-html-for'));
                    if (response.html !== 'undefined') {
                        $replace_html_to.html('');
                        $replace_html_to.html(response.html);
                    }
                } else {
                    if ($_this.hasClass('refresh-on-success')) {
                        location.reload();
                    }
                }
                if ($_this.hasClass('resetable')) {
                    $_this[0].reset();
                }

                // Close modal if the current form wrapp by a modal
                if (!$_this.hasClass('refresh-on-success')) {
                    Helper.flash_message('success', response.message, null, 7000);
                }
                if ($_this.closest('.modal').length !== 0) {
                    $_this.closest('.modal').modal('hide');
                } 

            } else {
                if ($_this.find('.form-messages').length !== 0) {
                    Helper.flash_message('error', response.message, $_this.find('.form-messages'));
                    if ($_this.closest('.modal').length === 0) {
                        Helper.scroll_to($_this.find('.form-messages'), 500);
                    }
                }
            }
        },
        complete: function() {
            // Enable submitter
            $_this.find('[type=submit]').attr('disabled', false);
        }
    };
    var formData = null;
    // Process form with file inputs
    if ($_this.attr('enctype') === 'multipart/form-data') {
        formData = new FormData(this);
        options['contentType'] = false;
        options['processData'] = false;
    } else {
        formData = $_this.serialize();
    }

    options['data'] = formData;
    $.ajax(options);
    return false;
});

$(document).on('change', '.select-as-link', function() {
    var $_checkedElmt = $(this).find('option:checked');
    if ($_checkedElmt.data('url')) {
        location.href = $_checkedElmt.data('url');
    }
});

$(document).on('change', '.submit-on-change', function() {
    $(this).closest('form').submit();
});