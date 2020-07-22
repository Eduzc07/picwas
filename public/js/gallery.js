// ====== Galeria =======
let modalId = $('#image-gallery');

$(document).ready(function () {

    loadGallery(true, 'a.thumbnail');

    //This function disables buttons when needed
    function disableButtons(counter_max, counter_current) {
        $('#show-previous-image, #show-next-image').show();
        if (counter_max === counter_current) {
            $('#show-next-image').hide();
        } else if (counter_current === 1) {
            $('#show-previous-image').hide();
        }

        // Hide Both in case album has only one photo
        if (counter_max === 1) {
          $('#show-previous-image').hide();
          $('#show-next-image').hide();
        }
    }

    /**
     *
     * @param setIDs        Sets IDs when DOM is loaded. If using a PHP counter, set to false.
     * @param setClickAttr  Sets the attribute for the click handler.
     */
    function loadGallery(setIDs, setClickAttr) {
        let current_image, selector, counter = 0;

        $('#show-next-image, #show-previous-image').click(function () {
            if ($(this).attr('id') === 'show-previous-image') {
                current_image--;
            } else {
                current_image++;
            }

            selector = $('[data-image-id="' + current_image + '"]');
            updateGallery(selector);

        });

        function updateGallery(selector) {
            let $sel = selector;
            current_image = $sel.data('image-id');

            $('#image-gallery-title').text($sel.data('title'));
            $('#image-gallery-image').attr('src', $sel.data('image'));
            $('#image-gallery-image').attr('reference', $sel.data('reference'));
            $('#image-gallery-image').attr('in-cart', $sel.data('in-cart'));

            console.log('<a href="' + $sel.data('route') + '">carrito</a>');

            if ($sel.data('in-cart')) {
                $('#modal-gallery-footer').addClass('d-none');
                $("#cart-result").html('<p class="text-success mb-0 text-right py-2 pr-3" style="font-size: 1.2rem; z-index: 1; position: relative;">Añadido al <a href="' + $sel.data('route') + '">carrito</a></p>');
                $('#modal-gallery-footer').html('');
            } else {
                $('#modal-gallery-footer').removeClass('d-none');
                $("#cart-result").html("");
                $('#modal-gallery-footer').html($sel.data('test'));
            }

            disableButtons(counter, $sel.data('image-id'));
        }

        if (setIDs == true) {
            $('[data-image-id]').each(function () {
                counter++;
                $(this).attr('data-image-id', counter);
            });
        }

        $(setClickAttr).on('click', function () {
            updateGallery($(this));
        });
    }
});

// build key actions
$(document).keydown(function (e) {
    switch (e.which) {
        case 37: // left
            if ((modalId.data('bs.modal') || {})._isShown && $('#show-previous-image').is(":visible")) {
                $('#show-previous-image').click();
            }
            break;

        case 39: // right
            if ((modalId.data('bs.modal') || {})._isShown && $('#show-next-image').is(":visible")) {
                $('#show-next-image').click();
            }
            break;

        default:
            return; // exit this handler for other keys
    }
    e.preventDefault(); // prevent the default action (scroll / move caret)
});
// ====== Galeria =======
