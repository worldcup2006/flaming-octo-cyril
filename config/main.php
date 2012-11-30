<?php
return array(
    //'basepath' => dirname(dirname(__FILE__)),
    //'viewdir' => 'bro',
    'layoutdir' => 'layout',
    //'layoutFile' => 'layout.php',
    'errorController' => 'error',
    'notFoundAction' => 'notfound',
    'auth' => true,
    'authUserModel' => 'User',
    'components' => array(
        'db' => array(
            'adapter' => 'mysql',
            'dsn' => 'mysql:host=localhost;dbname=test;charset=utf8',
            'username' => 'root',
            'password' => 'bygaga',
        ),
        'acl' => '../config/acl.php',               //realtes on include path in index.php
        'routing' => array(
            'posts' => array(
                'pattern' => 'posts',    //defaults required for this notation!
                'defaults' => array(
                    'controller' => 'index',
                    'action' => 'index',
                )
            ),
            'post' => array(
                'pattern' => 'post/:id',    //defaults required for this notation!
                'defaults' => array(
                    'controller' => 'index',
                    'action' => 'show',
                    'id' => 0
                )
            ),
            'about' => array(
                'pattern' => 'about',
                'defaults' => array(
                    'controller' => 'static',
                    'action' => 'about',
                )
            ),
            'contacts' => array(
                'pattern' => 'contacts',
                'defaults' => array(
                    'controller' => 'static',
                    'action' => 'contacts',
                )
            )
        ),
    ),
);
