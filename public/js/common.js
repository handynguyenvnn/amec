function preventMultipleFormSubmission() {
    $('.btn-submit').click(function () {
        $(this).prop('disabled', true);
        $(this).closest('form').submit();
        return true;
    });
}

$(document).ready(function () {

    // Forms double click multiple submission
    preventMultipleFormSubmission();

});