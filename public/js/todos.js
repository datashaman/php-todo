jQuery(document).ready(function($) {
    var extractId = function(attr) {
            var re = /^todo-([0-9]*)$/,
                match = re.exec(attr),
                id = match[1];
            return id;
        },
        loadTodos = function() {
            $('#todos').load('/todos', function() {
                $('.todo span').each(function() {
                    var attr = $(this).attr('id');

                    $(this).editable('/todos/' + extractId(attr), {
                        method: 'PUT',
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
        var attr = $(this).prev().attr('id');

        $.ajax({
            type: 'DELETE',
            url: '/todos/' + extractId(attr),
            success: loadTodos
        });
    });
});
