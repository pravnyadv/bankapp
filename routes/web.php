<?php


$router->get('/', 'LoginController@index');
$router->post('/login', 'LoginController@login');

$router->group(['middleware' => 'auth'], function () use ($router) {
    $router->get('branch', 'BranchController@index');
    $router->get('add', 'BranchController@add');
    $router->get('search', 'BranchController@search');
    $router->post('search/branch', 'BranchController@searchBranch');
    $router->post('add/branch', 'BranchController@addBranch');
    $router->get('branch/delete/{id}', 'BranchController@deleteBranch');
});

$router->get('test', 'LoginController@test');
