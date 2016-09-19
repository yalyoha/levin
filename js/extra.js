(function($) {
    $.fn.levinCms = function() {
        this.each(function() {
            $this = $(this);
            $this.find('> div').each(function(i, e) {
                $(this).attr('data-sr', 'enter top, move 40px, over 0.5s');
                if (i % 2 == 0) $(this).attr('data-sr', 'enter bottom, move 50px, over 0.5s');
            });
            $this.find('> div:first-child').attr('data-sr', 'enter left, move 50px, over 0.5s');
            $this.find('> div:last-child').attr('data-sr', 'enter right, move 50px, over 0.5s');
        });
    };
})(jQuery);

$('.restcruct').levinCms();
