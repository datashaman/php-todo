jQuery(document).ready(function($) {
    var loadTodos = function() {
        $('#todos').load('/todos', function() {
            $('.todo span').each(function() {
                $(this).editable('/save', {
                    event: 'dblclick'
                });
            });
        });
    };

    loadTodos();

    $('#todo').keypress(function(e) {
        // Enter is pressed
        if(e.which == 13) {
            $.post('/todos', {
                text: $(this).val()
            }, loadTodos);
        }
    });

    $(document).on('click', '.todo a', function(e) {
        var attr = $(this).prev().attr('id'),
            re = /^todo-([0-9]*)$/,
            match = re.exec(attr),
            id = match[1];

        $.ajax({
            type: 'DELETE',
            url: '/todos/' + id,
            success: loadTodos
        });
    });
});
