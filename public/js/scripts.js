function preventMultipleSubmit(button, loader, position = 'center') {
    $(button).addClass('d-none');
    $(button).after('<div class="loader" align="'+position+'"><img id="espera_icon" align="'+position+'" src="'+loader+'" style="max-width: 60px; width: 100%;"/></div>');
}

function preventMultipleSubmitForm(form, loader, position = 'center') {
    formId = form.id;
    $('#'+formId+' button[type=submit]').addClass('d-none');
    $('#'+formId+' button[type=submit]').after('<div class="loader" align="'+position+'"><img id="espera_icon" align="'+position+'" src="'+loader+'" style="max-width: 60px; width: 100%;"/></div>');
}