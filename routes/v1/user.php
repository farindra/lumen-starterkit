<?php 

/* registration */
$router->post('/register','UserController@register');

/* restrict route */
$router->group(['middleware' => 'auth'], function () use ($router) {
    
    $router->get('/profile','UserController@profile');


   
});