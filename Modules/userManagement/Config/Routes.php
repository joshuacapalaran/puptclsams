<?php


$routes->group('roles', ['namespace' => 'Modules\UserManagement\Controllers'], function($routes)
{
    $routes->get('/', 'Roles::index');
    $routes->match(['get', 'post'], 'add', 'Roles::add_role');
    $routes->get('(:num)', 'Roles::index/$1');
    $routes->get('show/(:num)', 'Roles::show_role/$1');
    $routes->match(['get', 'post'], 'edit/(:num)', 'Roles::edit_role/$1');
    $routes->delete('delete/(:num)', 'Roles::delete_role/$1');
});

$routes->group('admin/permissions', ['namespace' => 'Modules\UserManagement\Controllers'], function($routes)
{
    $routes->get('/', 'Permissions::index');
    $routes->match(['get', 'post'], 'edit', 'Permissions::edit_permission');
});
