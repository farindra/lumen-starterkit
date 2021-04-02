<?php 

/* registration */
$router->post('/register','UserController@register');

/* login */
$router->post('/login','UserController@login');

/* restrict route */
$router->group(['middleware' => 'auth'], function () use ($router) {
    
    $router->get('/profile','UserController@profile');


   
});