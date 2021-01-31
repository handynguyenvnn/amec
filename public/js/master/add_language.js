$(document).ready(function () {
    validateConfig.rules = {
        lang: {
            required: true,
            maxlength: 32
        },
        lang_code: {
            required: true,
            maxlength: 32
        }
    };
    $("#formLanguage").validate(validateConfig);
});