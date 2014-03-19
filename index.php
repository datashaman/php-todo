<?php
if (preg_match('/\.(?:css|js|png|jpg|jpeg|gif)$/', $_SERVER["REQUEST_URI"])) {
    return false;  
}

require __DIR__ . '/vendor/autoload.php';

ORM::configure('sqlite:./storage/example.db');
 
// Your App
$app = new Bullet\App(
    array(
        'template' => array(
            'path' => __DIR__ . '/templates/',
            'path_layouts' => __DIR__ . '/templates/',
            'auto_layout' => 'layout'
        )
    )
);

$app->path(
    '/', function () use ($app) {
        return $app->template('todos');
    }
);

$app->path(
    '/save', function ($request) use ($app) {
    }
);

$app->path(
    '/todos', function () use ($app) {
        $app->get(
            function () use ($app) {
                $todos = ORM::for_table('todos')->find_many();
                return implode(
                    "\n", array_map(
                        function ($todo) {
                            return '<li class="todo"><span id="todo-'.$todo->id.'">'.$todo->text.'</span> <a href="#">X</a></li>';
                        },
                        $todos
                    )
                );
            }
        );

        $app->post(
            function ($request) use ($app) {
                $text = $request->post('text');
                if (!empty($text)) {
                    $todo = ORM::for_table('todos')->create();
                    $todo->text = $text;
                    $todo->save();
                    return $app->response(201, $todo->as_array());
                }
            }
        );

        $app->param(
            'int', function($request, $todoId) use ($app) {
                $todo = ORM::for_table('todos')->find_one($todoId);

                $app->put(function ($request) use ($app, $todo) {
                    $text = $request->post('value');

                    if (empty($text)) {
                        $todo->delete();
                        return $app->response(200, $todo->as_array());
                    } else {
                        $todo->text = $text;
                        $todo->save();
                        return $todo->text;
                    }
                });

                $app->delete(function ($request) use ($app, $todo) {
                    $todo->delete();
                    return $app->response(200, $todo->as_array());
                });
            }
        );
    }
); 

// Run the app! (takes $method, $url or Bullet\Request object)
echo $app->run(new Bullet\Request());
