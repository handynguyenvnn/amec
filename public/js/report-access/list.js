$(document).ready(function () {
    morrisYear();

    $('.detailButton').on('click', function () {
        // Get the record's ID via attribute
        var id = $(this).attr('data-id');

        $('.detailButton').addClass('display-none');

        $.ajax({
            url: 'http://amec.adnet.space//users/' + id,
            method: 'GET'
        }).complete(function (response) {
            // Show the dialog
            bootbox
                .dialog({
                    // title: '受講者数（授業1）',
                    message: $('#detailForm'),
                    show: false, // We will show it manually later
                    onEscape: function () {
                        // you can do anything here you want when the user dismisses dialog
                        $('.detailButton').removeClass('display-none');
                    }
                })
                .on('shown.bs.modal', function () {
                    $('#detailForm')
                        .show();                             // Show the login form
                    // .formValidation('resetForm'); // Reset form
                    morrisYear();
                })
                .on('hide.bs.modal', function (e) {
                    // Bootbox will remove the modal (including the body which contains the login form)
                    // after hiding the modal
                    // Therefor, we need to backup the form
                    $('#detailForm').hide().appendTo('body');
                })
                .modal('show');
        });
    });

    $('.period').on('change', function (e) {
        if ($(period).val() == 0) {
            morrisYear();
        } else  {
            morrisMonth();
        }

    })
});


function morrisYear() {
    $('#line-chart .morris-hover').remove()

    $(window).off('resize');
    window.morrisObj = NaN;
    if (typeof(Morris) != "undefined") {
        window.morrisObj = new Morris.Line({
            // ID of the element in which to draw the chart.
            element: 'line-chart',
            // Chart data records -- each entry in this array corresponds to a point on
            // the chart.
            // the chart.
            // data: [
            //     {year: '1970', value: 20},
            //     {year: '1980', value: 200},
            //     {year: '1990', value: 200},
            //     {year: '2000', value: 200},
            //     {year: '2010', value: 200}
            // ],
            data: yearReport,
            // hoverCallback: function (index, options, content) {
            //     return (content);
            // },
            // The name of the data record attribute that contains x-values.
            xkey: 'year',
            // A list of names of data record attributes that contain y-values.
            ykeys: ['value'],
            // Labels for the ykeys -- will be displayed when you hover over the
            // chart.
            labels: ['Value'],
            resize: true,
            parseTime: false,
            hideHover: 'auto',
            stacked: true
        });
    }
}
function morrisMonth() {
    $('#line-chart .morris-hover').remove();

    $(window).off('resize');
    window.morrisObj = NaN;

    window.morrisObj = new Morris.Line({
        // ID of the element in which to draw the chart.
        element: 'line-chart',
        // Chart data records -- each entry in this array corresponds to a point on
        // the chart.
        // the chart.
        // data: [
        //     {month: '1', value: 20},
        //     {month: '2', value: 10},
        //     {month: '3', value: 100},
        //     {month: '4', value: 40},
        //     {month: '5', value: 20},
        //     {month: '6', value: 20},
        //     {month: '7', value: 20},
        //     {month: '8', value: 20},
        //     {month: '9', value: 200},
        //     {month: '10', value: 20},
        //     {month: '11', value: 200},
        //     {month: '12', value: 20}
        // ],
        data: monthReport,
        hoverCallback: function (index, options, content) {
            return (content);
        },
        // The name of the data record attribute that contains x-values.
        xkey: 'month',
        // A list of names of data record attributes that contain y-values.
        ykeys: ['value'],
        // Labels for the ykeys -- will be displayed when you hover over the
        // chart.
        labels: ['Value'],
        resize: true,
        parseTime: false,
        hideHover: 'auto',
        stacked: true
    });

}