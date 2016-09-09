$('span.admin[data]').click(function() {
    window.location.href = $(this).attr('data');
});

$('.main-menu li').width( 100 / $('.main-menu').children().length + '%' );