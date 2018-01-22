$( document ).ready(function() {
    var page = 'transactions';
    $('#content_type').html('<h3>Transactions</h3><div id="section">' + page + '</div>');

    <!--handle nav links-->
    $('li#route').click (function(){
        alert($(this).attr('name'));
        page = $(this).attr('name');
        if(page == 'transactions')
            title = 'Transactions'
        else if (page == 'accountstatement')
            title = 'Account Statement'
        $('#content_type').html('<h3>' + title + '</h3><div id="section" >' + page + '</div>');
    });

    //$('#main_content').html('<?php include "app/' + page + '.php"; ?>');

    //css
    //$('#section').css( "display","none"  );
    $('.page-header').css( "margin","0 0 0 0"  );


});
