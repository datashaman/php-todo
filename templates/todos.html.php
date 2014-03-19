<input type="text" id="todo" /><br />

<ol id="todos">
</ol>

<?php $view->block('js')->content(function () { ?>
    <script type="text/javascript" src="js/todos.js"></script>
<?php }); ?>
