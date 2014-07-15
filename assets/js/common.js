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
                if ($_this.hasClass('refresh-on-success')) {
                    location.reload();
                    return;
                }
                if ($_this.data('update-html-for')) {
                    var $replace_html_to = $($_this.data('update-html-for'));
                    if (response.html !== 'undefined') {
                        $replace_html_to.html('');
                        $replace_html_to.html(response.html);
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
                if ($_this.data('update-html-for')) {
                    var $replace_html_to = $($_this.data('update-html-for'));
                    if (response.html !== 'undefined') {
                        $replace_html_to.html('');
                        $replace_html_to.html(response.html);
                    }
                }
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

/**
 * Author: Lht
 * 
 * Styling file inputs with bootstrap 3 input group css
 * Reference: http://getbootstrap.com/components/#input-groups
 * 
 * Required:
 *  - Bootstrap 3
 *  - JQuery ~> 1.7
 *  - Input file has class 'bt-input-file'*  
 *  
 *  Caution: Don't use HTML5 required attribute for the input file
 */
// FIXME: Undone
$(':file.input-file-bt').each(function() {
    var $_this = $(this);
    var default_options = {
        inputGroupClass: 'input-group',
        inputClass: 'form-control',
        inputPlaceholder: 'Choose a file',
        browseButtonClass: 'btn btn-default',
        browseButtonText: 'Browse'
    }

    var userOptions = {};
    if ($_this.attr('placeholder')) {
        userOptions['inputPlaceholder'] = $_this.attr('placeholder');
    }
    if ($_this.data('browse-button-text')) {
        userOptions['browseButtonText'] = $_this.data('browse-button-text');
    }


    var options = $.extend( default_options, userOptions );


    var $inputName = $_this.attr('name');
    var multiple = $(this).attr('multiple');
    var wrapper_html = '<div class="' + options.inputGroupClass + '">' +
      '<input type="text" autocomplete="off" placeholder="' + options.inputPlaceholder + '" class="' + options.inputClass + '" data-for-input-name="' + $inputName + '">' +
      '<span class="input-group-btn">' +
      '<a class="' + options.browseButtonClass + '" data-for-input-name="' + $inputName + '">' + options.browseButtonText + '</a>' + '</span>' +
      +'</div>';
    // Hide the real input
    // $_this.css('display', 'none'); Cannot trigger click on Safari if we do this.
    // Here is alternative solution:
    $_this.css('visibility', 'hidden');
    $_this.css('position', 'absolute');

    // Insert text input after the file input
    $(wrapper_html).insertBefore($_this);
    // Show browse dialog when clicked on to input text or button
    $('[data-for-input-name="' + $inputName + '"]').on('click', function() {
        $_this.trigger('click');
    });

    // Handler change event on file input
    $_this.change(function() {

        var selected_file_path = $_this.val();
        var selectedFiles = '';
        for (var i = 0; i < $_this[0].files.length; i++) {
            var fileName = $_this[0].files[i].name;
            // Get actually the selected file name
            // fileName = fileName.split("\\").pop();
            selectedFiles += fileName;
            if ((i + 1) !== $_this[0].files.length) {
                selectedFiles += ' , ';
            }
        }
        $('input[data-for-input-name="' + $inputName + '"]').val(selectedFiles);
    });
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

//$('.datepicker').datepicker();

/* Toggle loading indicator */
$(document).ajaxStart(function() {
    Helper.togglePageLoadingIndicator(true);
});
$(document).ajaxComplete(function() {
    Helper.togglePageLoadingIndicator(false);
});