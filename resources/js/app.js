import './bootstrap';

window.checkRequiredFields = function(formId) {
    let isFormValid = true;

    $(`#${formId} [required]`).each(function() {
        const fieldType = $(this).attr('type');

        if (fieldType === 'radio' || fieldType === 'checkbox') {
            if (!$(`input[name="${$(this).attr('name')}"]:checked`).length) {
                isFormValid = false;
            }
        } else if ($(this).is('select')) {
            if ($(this).val() === null || $(this).val() === '') {
                isFormValid = false;
            }
        } else {
            if ($(this).is(':invalid') || $(this).val() === '') {
                isFormValid = false;
            }
        }
    });

    return isFormValid;
}

window.checkFormValidity = function(formId) {
    let isFormValid = checkRequiredFields(formId);
    $(`#${formId} #submit-button`).prop('disabled', !isFormValid);

    if (isFormValid) {
        $(`#${formId} #submit-button`).removeClass('bg-gray cursor-not-allowed').addClass('bg-primary hover:bg-accent cursor-pointer');
    } else {
        $(`#${formId} #submit-button`).removeClass('bg-primary hover:bg-accent cursor-pointer').addClass('bg-gray cursor-not-allowed');
    }
}