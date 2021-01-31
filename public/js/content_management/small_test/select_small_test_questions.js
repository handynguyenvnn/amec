$(document).ready(function() {
    $("#select_small_test_questions tbody").sortable({
        axis: 'y',
        group: 'serialization',
        delay: 100,
        helper: fixHelper,
        update: handleUpdate,
        stop: handleStop
    }).disableSelection();
    $(".tabs-right li a").bind( "click", function() {

        $('.tab-pane').removeClass('active');
        $('.tab-pane').hide();

        tabId = $(this).attr('href');
        if (tabId == '#common-v') {
            $('#common-v').show();
            $('#question-answer-body').hide();
            $('#question-answer-body').css('border-bottom', '');
        } else {
            $('#' + tabId.replace('#', '')).show();
            $('#question-answer-body').show();
            $('#question-answer-body').css('border-bottom', '#DDD solid 1px');
        }
        addDvQuestionChoice();
    });
    $( "#search_small_test_questions" ).bind( "click", function() {
        loadSmallTestQuestion(0);
        $('#add_small_test_question').on('click');
        $('.priority_check').prop('checked', false);
    });
    var test_question_indx = localStorage.getItem('TR_SELECT_SMALL_TEST_QUESTION');
    if (test_question_indx == null || test_question_indx == '') {
        test_question_indx = 0;
    }
    //
    $('#select_small_test_questions tr').removeClass("active");
    $('.tr_select_small_test_question_'+test_question_indx).addClass('active');
    loadSmallTestQuestion($('.tr_select_small_test_question_'+test_question_indx).attr("data-id"));

    $('.table').on('click', '#tr_select_small_test_question',function() {
        var validator = $("#createForm").validate();
        validator.resetForm();
        $('#select_small_test_questions tr').removeClass("active");
        $('#save_small_test_question').hide();
        $('#update_small_test_question').show();
        $(this).addClass('active');
        var id = $(this).attr("data-id");
        var number = $(this).attr("data-number");
        console.log(number);
        localStorage.setItem('TR_SELECT_SMALL_TEST_QUESTION',number);

        loadSmallTestQuestion(id);
    });

});
function addDvQuestionChoice() {
    arrLang = $('#arrLang').val().split(',');

    var maxTotal = 0;
    arrLang.forEach(function(lang_code) {
        var _t = parseInt($('#totalChoice-' + lang_code).val());
        maxTotal =  _t < maxTotal ? maxTotal : _t;
    });
    arrLang.forEach(function(lang_code) {
        var _t = parseInt($('#totalChoice-' + lang_code).val());
        for (var indx = _t; indx < maxTotal; indx++) {
            AddNewChoice(lang_code, indx);
        }
    });
}
function validateForm() {

    $('.tab-pane').removeClass('active');
    $('.tab-pane').hide();

    tabId = $(this).attr('href');

    var pass_score_rate = $('#pass_score_rate').val();
    var title_small_test_question = $('#title_small_test_question').val();
    var score = $('#score').val();
    if (pass_score_rate == '' ) {
        $('#common-v').show();
        $('#question-answer-body').hide();

        $('.tabs-right li').removeClass('active');
        $('.tabs-right li').first().addClass('active');
        $('#question-answer-body').css('border-bottom', '');
    }
    else if (pass_score_rate != '' || title_small_test_question == '') {
        $('#question-answer-body').show();

        $('.tabs-right li').removeClass('active');
        $('.tabs-right li:nth-child(2)').addClass('active');
        $('#ja-v').show();
        $('#question-answer-body').css('border-bottom', '#DDD solid 1px');
    }
}
function loadSmallTestQuestion(id) {
    var url = '/small_test_question/get-by-ajax/' + id;
    $('#submit-button').attr('data-id',id);
    var response = JSON.parse(localStorage.getItem('SMALL_TEST_' + id));
    if (!!response) {
        console.log('localStorage');
        $('#score').val(response.score);
        var isMsg = false;
        arrLang = $('#arrLang').val().split(',');
        arrLang.forEach(function (lang_code) {
            $('#' + lang_code + '_problem_statement').val(response[lang_code + '_problem_statement']);
            $('#' + lang_code + '_small_test_problem_id').val(response[lang_code + '_small_test_problem_id']);
            $('#' + lang_code + '_delete_image_question').attr('data-id', response[lang_code + '_small_test_problem_id']);
            $('#' + lang_code + '_delete_video_question').attr('data-id', response[lang_code + '_small_test_problem_id']);
            if (response[lang_code + '_image_path']) {
                $('#' + lang_code + '_image_preview').children().addClass(lang_code + '_image_path1');
                $('.' + lang_code + '_image_path1').children().addClass(lang_code + '_image_path2');
                $('.' + lang_code + '_image_path2').children().addClass(lang_code + '_image_path3');
                $('.' + lang_code + '_image_path3').children().addClass(lang_code + '_image_path4');
                $('.' + lang_code + '_image_path4').children().addClass(lang_code + '_image_path5');
                $('.' + lang_code + '_image_path5').children().addClass(lang_code + '_image_path6');
                $('.' + lang_code + '_image_path6 img').attr("src", response[lang_code + '_image_path']);
            } else {
                $('#' + lang_code + '_image_preview').children().addClass(lang_code + '_image_path1');
                $('.' + lang_code + '_image_path1').children().addClass(lang_code + '_image_path2');
                $('.' + lang_code + '_image_path2').children().addClass(lang_code + '_image_path3');
                $('.' + lang_code + '_image_path3').children().addClass(lang_code + '_image_path4');
                $('.' + lang_code + '_image_path4').children().addClass(lang_code + '_image_path5');
                $('.' + lang_code + '_image_path5').children().addClass(lang_code + '_image_path6');
                $('.' + lang_code + '_image_path6 img').attr("src", "");
            }
            if (response[lang_code + '_video_path']) {
                $('#' + lang_code + '_video_preview').children().addClass(lang_code + '_video_path1');
                $('.' + lang_code + '_video_path1').children().addClass(lang_code + '_video_path2');
                $('.' + lang_code + '_video_path2').children().addClass(lang_code + '_video_path3');
                $('.' + lang_code + '_video_path3').children().addClass(lang_code + '_video_path4');
                $('.' + lang_code + '_video_path4').children().addClass(lang_code + '_video_path5');
                $('.' + lang_code + '_video_path5').children().addClass(lang_code + '_video_path6');
                $('.' + lang_code + '_video_path6 video').attr("src", response[lang_code + '_video_path']);
            } else {
                $('#' + lang_code + '_video_preview').children().addClass(lang_code + '_video_path1');
                $('.' + lang_code + '_video_path1').children().addClass(lang_code + '_video_path2');
                $('.' + lang_code + '_video_path2').children().addClass(lang_code + '_video_path3');
                $('.' + lang_code + '_video_path3').children().addClass(lang_code + '_video_path4');
                $('.' + lang_code + '_video_path4').children().addClass(lang_code + '_video_path5');
                $('.' + lang_code + '_video_path5').children().addClass(lang_code + '_video_path6');
                $('.' + lang_code + '_video_path6 video').attr("src", "");
            }
            if (typeof response[lang_code] === 'undefined' || !response[lang_code]) {
                $('#dv-choice-' + lang_code).html('<div class="form-group" id="dvAddNewChoice-' + lang_code + '"></div>');
                $('#totalChoice-' + lang_code).val(0);
                $('#question_fomat_questions option[value="0"]').prop("selected", true);

                for (var indx = 0; indx < 4; indx++) {
                    AddNewChoice(lang_code, indx);
                }
                return '';
            }

            var true_or_false = response[lang_code]['true_or_false'];
            var choices_image_path = response[lang_code]['choices_image_path'];
            var small_test_choice_id = response[lang_code]['small_test_choice_id'];
            var total_choice = parseInt(response[lang_code]['total_choice']);
            for (var indx = 0; indx < total_choice; indx++) {
                if ($('#choice-' + lang_code + '-' + indx).length == 0) {
                    AddNewChoice(lang_code, indx);
                }
                $('#' + lang_code + '_small_test_choice_' + indx + '_id').val(small_test_choice_id[indx]);
                $('#' + lang_code + '_delete_image_choice_' + indx).attr('data-id', small_test_choice_id[indx]);
                $('#' + lang_code + '_description_' + indx).html(response[lang_code]['description'][indx]);
                $('#preview_' + indx + '_' + lang_code + '_choices_image_path').children().addClass(lang_code + indx + '_preview_image_path1');
                $('.' + lang_code + indx + '_preview_image_path1').children().addClass(lang_code + indx + '_preview_image_path2');
                $('.' + lang_code + indx + '_preview_image_path2').children().addClass(lang_code + indx + '_preview_image_path3');
                $('.' + lang_code + indx + '_preview_image_path3').children().addClass(lang_code + indx + '_preview_image_path4');
                $('.' + lang_code + indx + '_preview_image_path4').children().addClass(lang_code + indx + '_preview_image_path5');
                $('.' + lang_code + indx + '_preview_image_path5').children().addClass(lang_code + indx + '_preview_image_path6');
                if (choices_image_path[indx]) {
                    $('.' + lang_code + indx + '_preview_image_path6 img').attr('src', choices_image_path[indx]);
                } else {
                    $('.' + lang_code + indx + '_preview_image_path6 img').attr('src', '');

                }

                if (true_or_false[indx] == 1) {
                    $('#' + lang_code + '_true_false_' + indx).prop("checked", true);
                }
                else {
                    $('#' + lang_code + '_true_false_' + indx).prop("checked", false);
                }

            }
            for (var indx_choice = total_choice + 10; indx_choice > total_choice; indx_choice--) {
                if ($('#choice-' + lang_code + '-' + indx_choice).length != 0) {
                    $('#choice-' + lang_code + '-' + indx_choice).remove();
                }
            }

            if (response[lang_code + '_priority_check'] == 1 && isMsg == false) {
                isMsg = true;
                $('#' + lang_code + '_priority_check').prop("checked", true);
            } else {
                $('#' + lang_code + '_priority_check').prop("checked", false);
            }
        });
        $('#id_small_test_question').val(response.id);
        $('#title_small_test_question').val(response.title);
        $('#coma_category_id').val(response.coma_category_id);

        $('#question_fomat_questions option[value="' + response.question_format_questions + '"]').prop("selected", true);

        addDvQuestionChoice();
    } else {
        $.get(url, function (response) {
            console.log('AJAX');
            localStorage.setItem('SMALL_TEST_' + id, JSON.stringify(response));
            $('#score').val(response.score);
            var isMsg = false;
            arrLang = $('#arrLang').val().split(',');
            arrLang.forEach(function (lang_code) {

                $('#' + lang_code + '_problem_statement').val(response[lang_code + '_problem_statement']);
                $('#' + lang_code + '_small_test_problem_id').val(response[lang_code + '_small_test_problem_id']);
                $('#' + lang_code + '_delete_image_question').attr('data-id', response[lang_code + '_small_test_problem_id']);
                $('#' + lang_code + '_delete_video_question').attr('data-id', response[lang_code + '_small_test_problem_id']);
                if (response[lang_code + '_image_path']) {
                    $('#' + lang_code + '_image_preview').children().addClass(lang_code + '_image_path1');
                    $('.' + lang_code + '_image_path1').children().addClass(lang_code + '_image_path2');
                    $('.' + lang_code + '_image_path2').children().addClass(lang_code + '_image_path3');
                    $('.' + lang_code + '_image_path3').children().addClass(lang_code + '_image_path4');
                    $('.' + lang_code + '_image_path4').children().addClass(lang_code + '_image_path5');
                    $('.' + lang_code + '_image_path5').children().addClass(lang_code + '_image_path6');
                    $('.' + lang_code + '_image_path6 img').attr("src", response[lang_code + '_image_path']);
                } else {
                    $('#' + lang_code + '_image_preview').children().addClass(lang_code + '_image_path1');
                    $('.' + lang_code + '_image_path1').children().addClass(lang_code + '_image_path2');
                    $('.' + lang_code + '_image_path2').children().addClass(lang_code + '_image_path3');
                    $('.' + lang_code + '_image_path3').children().addClass(lang_code + '_image_path4');
                    $('.' + lang_code + '_image_path4').children().addClass(lang_code + '_image_path5');
                    $('.' + lang_code + '_image_path5').children().addClass(lang_code + '_image_path6');
                    $('.' + lang_code + '_image_path6 img').attr("src", "");
                }
                if (response[lang_code + '_video_path']) {
                    $('#' + lang_code + '_video_preview').children().addClass(lang_code + '_video_path1');
                    $('.' + lang_code + '_video_path1').children().addClass(lang_code + '_video_path2');
                    $('.' + lang_code + '_video_path2').children().addClass(lang_code + '_video_path3');
                    $('.' + lang_code + '_video_path3').children().addClass(lang_code + '_video_path4');
                    $('.' + lang_code + '_video_path4').children().addClass(lang_code + '_video_path5');
                    $('.' + lang_code + '_video_path5').children().addClass(lang_code + '_video_path6');
                    $('.' + lang_code + '_video_path6 video').attr("src", response[lang_code + '_video_path']);
                } else {
                    $('#' + lang_code + '_video_preview').children().addClass(lang_code + '_video_path1');
                    $('.' + lang_code + '_video_path1').children().addClass(lang_code + '_video_path2');
                    $('.' + lang_code + '_video_path2').children().addClass(lang_code + '_video_path3');
                    $('.' + lang_code + '_video_path3').children().addClass(lang_code + '_video_path4');
                    $('.' + lang_code + '_video_path4').children().addClass(lang_code + '_video_path5');
                    $('.' + lang_code + '_video_path5').children().addClass(lang_code + '_video_path6');
                    $('.' + lang_code + '_video_path6 video').attr("src", "");
                }
                if (typeof response[lang_code] === 'undefined' || !response[lang_code]) {
                    $('#dv-choice-' + lang_code).html('<div class="form-group" id="dvAddNewChoice-' + lang_code + '"></div>');
                    $('#totalChoice-' + lang_code).val(0);
                    $('#question_fomat_questions option[value="0"]').prop("selected", true);

                    for (var indx = 0; indx < 4; indx++) {
                        AddNewChoice(lang_code, indx);
                    }
                    return '';
                }

                var true_or_false = response[lang_code]['true_or_false'];
                var choices_image_path = response[lang_code]['choices_image_path'];
                var small_test_choice_id = response[lang_code]['small_test_choice_id'];
                var total_choice = parseInt(response[lang_code]['total_choice']);
                for (var indx = 0; indx < total_choice; indx++) {
                    if ($('#choice-' + lang_code + '-' + indx).length == 0) {
                        AddNewChoice(lang_code, indx);
                    }
                    $('#' + lang_code + '_small_test_choice_' + indx + '_id').val(small_test_choice_id[indx]);
                    $('#' + lang_code + '_delete_image_choice_' + indx).attr('data-id', small_test_choice_id[indx]);
                    $('#' + lang_code + '_description_' + indx).html(response[lang_code]['description'][indx]);
                    $('#preview_' + indx + '_' + lang_code + '_choices_image_path').children().addClass(lang_code + indx + '_preview_image_path1');
                    $('.' + lang_code + indx + '_preview_image_path1').children().addClass(lang_code + indx + '_preview_image_path2');
                    $('.' + lang_code + indx + '_preview_image_path2').children().addClass(lang_code + indx + '_preview_image_path3');
                    $('.' + lang_code + indx + '_preview_image_path3').children().addClass(lang_code + indx + '_preview_image_path4');
                    $('.' + lang_code + indx + '_preview_image_path4').children().addClass(lang_code + indx + '_preview_image_path5');
                    $('.' + lang_code + indx + '_preview_image_path5').children().addClass(lang_code + indx + '_preview_image_path6');
                    if (choices_image_path[indx]) {
                        $('.' + lang_code + indx + '_preview_image_path6 img').attr('src', choices_image_path[indx]);
                    } else {
                        $('.' + lang_code + indx + '_preview_image_path6 img').attr('src', '');

                    }

                    if (true_or_false[indx] == 1) {
                        $('#' + lang_code + '_true_false_' + indx).prop("checked", true);
                    }
                    else {
                        $('#' + lang_code + '_true_false_' + indx).prop("checked", false);
                    }

                }
                for (var indx_choice = total_choice + 10; indx_choice > total_choice; indx_choice--) {
                    if ($('#choice-' + lang_code + '-' + indx_choice).length != 0) {
                        $('#choice-' + lang_code + '-' + indx_choice).remove();
                    }
                }

                if (response[lang_code + '_priority_check'] == 1 && isMsg == false) {
                    isMsg = true;
                    $('#' + lang_code + '_priority_check').prop("checked", true);
                } else {
                    $('#' + lang_code + '_priority_check').prop("checked", false);
                }
            });
            $('#id_small_test_question').val(response.id);
            $('#title_small_test_question').val(response.title);
            $('#coma_category_id').val(response.coma_category_id);

            $('#question_fomat_questions option[value="' + response.question_format_questions + '"]').prop("selected", true);

            addDvQuestionChoice();
        });
    }
}
function resetChoiceNum(langCode) {
    $('.span-' + langCode + '-indx-choice').each(function(indx, element) {
        $(this).html(indx + 1);
    });
    if ($('#' + langCode + '_RemoveChoice_0').length > 0) {
        $('#' + langCode + '_RemoveChoice_0').remove();
    }
    if ($('#' + langCode + '_RemoveChoice_1').length  > 0 ) {
        $('#' + langCode + '_RemoveChoice_1').remove();
    }
}
function priorityCheck(ck, current_lang) {
    var isMsg = false;
    if (ck) {
        arrLang = $('#arrLang').val().split(',');
        arrLang.forEach(function(lang_code) {
            if (lang_code != current_lang) {
                if ($('#' + lang_code + '_priority_check').is(':checked')) {
                    isMsg = true;
                }
            }
        });
    }
    if (isMsg) {
        $('#' + current_lang + '_show_message_duplicate').css('display','block');
        $('#' + current_lang + '_priority_check').prop('checked', false);
    }
}
String.prototype.replaceAll = function(search, replacement) {
    var target = this;
    return target.replace(new RegExp(search, 'g'), replacement);
};


