(function($) {
    $.fn.levinCms = function() {
        $this = $(this);
        var htmlId = $this.attr('id');
        var rowurl = window.location.href.toString().replace("http://" + window.location.host, ''),
            arrurl = rowurl.split('access='),
            access = arrurl[1];
        $this.wrap('<div class="admin-restruct"></div>');
        var options = '';
        for (var i = 1; i < 7; i++) {
            if (i == $this.children().length) selected = ' selected="selected"';
            else selected = '';
            options += '<option value="' + i + '"' + selected + '>' + i + '</option>';
        }
        $this.before('<select id="admin-restruct-select-' + htmlId + '" class="admin-restruct-select" name="recount">' + options + '</select>');
        $('#admin-restruct-select-' + htmlId + '').change(function() {
            window.location.href = '/?htmlId=' + htmlId + '&recount=' + $(this).val() + '&access=' + access;
        });
    };
    $('.restcruct').each(function() {
        var id = $(this).attr('id');
        $('#' + id).levinCms();
    });
    $('.admin[data]').click(function() {
        window.location.href = $(this).attr('data');
    });
    $('#control').click(function() {
        window.location.href = '/admin/control.php';
    });
    $('#exit').click(function() {
        window.location.href = '/';
    });
})(jQuery);