$(document).ready(function() {
    var coma_indx = localStorage.getItem('TR_SELECT_COMA');
    if (coma_indx == null || coma_indx == '') {
        coma_indx = 0;
    }
    $('#select_small_test_questions tr').removeClass("active");
    $('.tr_select_coma_'+coma_indx).addClass('active');
    loadComa($('.tr_select_coma_'+coma_indx).attr('data-id'));
    $('.table').on('click', '#tr_select_coma', function() {
        $('#select_coma tr').removeClass("active");
        $(this).addClass('active');
        var id = $(this).attr("data-id");
        var number = $(this).attr("data-number");
        localStorage.setItem('TR_SELECT_COMA',number);
        loadComa(id);
    });
});
function loadComa(id){
    var url = '/chapter/get-coma-by-ajax/' + id;
    $.get(url, function (response) {
        console.log(response);
        $('#id_chapter_coma').val(response.id);
        $('#name_chapter_coma').val(response.name);
        $('#coma_category_id').val(response.coma_category_id);
        arrLang = $('#arrLang').val().split(',');
        arrLang.forEach(function(lang_code) {
            $('#' + lang_code + '_description').val(response[lang_code + '_description']);
            $('#' + lang_code + '_coma_language_id').val(response[lang_code + '_coma_language_id']);
            if (response[lang_code + '_coma_language_id']) {
                $('#' + lang_code + '_delete_image').attr('data-id', response[lang_code + '_coma_language_id']);
                $('#' + lang_code + '_delete_audio').attr('data-id', response[lang_code + '_coma_language_id']);
                $('#' + lang_code + '_delete_video').attr('data-id', response[lang_code + '_coma_language_id']);
            }else{
                $('#' + lang_code + '_delete_image').attr('data-id', '');
                $('#' + lang_code + '_delete_audio').attr('data-id', '');
                $('#' + lang_code + '_delete_video').attr('data-id', '');
            }
            $('#'+ lang_code + '_checkbox').prop('checked', false);

            $('.'+ lang_code + '_image_path6 img').attr("src", "");

            $('.'+ lang_code + '_audio_path6 audio').attr("src", "");

            $('.'+ lang_code + '_video_path6 video').attr("src", "");
            if (response[lang_code + '_image_path']) {
                $('.'+ lang_code + '_image_path6 img').attr("src", response[lang_code + '_image_path']);
            }
            if (response[lang_code + '_music_path']) {
                $('.' + lang_code + '_audio_path6 audio').attr("src", response[lang_code + '_music_path']);
            }
            if (response[lang_code + '_video_path']) {
                $('.'+ lang_code + '_video_path6 video').attr("src", response[lang_code + '_video_path']);
            }
            if (response[lang_code + '_priority_check'] == 1) {
                $('#'+ lang_code + '_checkbox').prop('checked', true);
            }
        });
    });
}
function priorityCheck(ck, current_lang) {
    var isMsg = false;
    if (ck) {
        arrLang = $('#arrLang').val().split(',');
        arrLang.forEach(function(lang_code) {
            if (lang_code != current_lang) {
                if ($('#' + lang_code + '_checkbox').is(':checked')) {
                    isMsg = true;
                }
            }
        });
    }
    if (isMsg) {
        $('#' + current_lang + '_priority_check').css('display', 'block');
        $('#' + current_lang + '_checkbox').prop('checked', false);
    }
}