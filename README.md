# PHP Todo App #

## Description ##

This is a simple, one-page personal todo list manager.

## Requirements ##

* PHP 5.3+
* Use a PHP MVC framework
* Use a database for storage

## Specification ##

1. The home page should contain an input textbox, and a list displaying the current collection of todos.
2. Entering any text into the input textbox (except all blanks or nothing) should create a new todo and add it to the collection.
3. On double-clicking a todo in the list, the todo should become editable.
4. When the todo is editable, pressing Enter should save it.
5. When a todo is edited and nothing or all blanks is entered, delete that todo from the collection.
6. Each todo should have a small X or similar icon in the list to remove the selected todo from the collection and delete it.
7. Whenever the collection changes, it should be refreshed automatically using Ajax.
8. All saving and retrieving of data should be done via Ajax, using jQuery and any plugins you choose
   (use [jEditable][1], it will make some of this easy).
9. All todo items must be saved in the database so that you can refresh the page and see the same items.

[1]: http://www.appelsiini.net/projects/jeditable    
