jQuery(document).ready(function($) {

    $('ul.nav-tabs li a').each(function() {
        if ($(this).attr('href') == location.hash)
        {
            $(this).click();
            $("html, body").animate({ scrollTop: 0 }, "slow");
        }
    });
});