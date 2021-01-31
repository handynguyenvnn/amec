$(document).ready(function () {
    $('#update_coma').on('click', function() {
        var comaId = $('#id_chapter_coma').val();
        var url = '/chapter/update-coma/'+comaId;
        var comaName = $('#name_chapter_coma').val();
        var comaCategoryId = $('#coma_category_id').val();
        var chapterId = $(this).attr("chapter-id");
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: url,
            type: 'post',
            data: {'_token': $('input[name=_token]').val(), 'name': comaName,'chapter_id':chapterId, 'coma_category_id':comaCategoryId},
            success: function(response) {
                console.log(response);
            },
            headers: {'X-Requested-With': 'XMLHttpRequest'},
            dataType: 'json',

        });
        window.location="/chapters/"+chapterId+"/edit";
    });
});