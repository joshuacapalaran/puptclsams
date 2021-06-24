<?php


$routes->group('admin/roles', ['namespace' => 'Modules\UserManagement\Controllers'], function($routes)
{
    $routes->get('/', 'Roles::index');
    $routes->match(['get', 'post'], 'add', 'Roles::add_role');
    $routes->get('(:num)', 'Roles::index/$1');
    $routes->get('show/(:num)', 'Roles::show_role/$1');
    $routes->match(['get', 'post'], 'edit/(:num)', 'Roles::edit_role/$1');
    $routes->get('delete_role/(:num)', 'Roles::delete_role/$1');
});

$routes->group('admin/permissions', ['namespace' => 'Modules\UserManagement\Controllers'], function($routes)
{
    $routes->get('/', 'Permissions::index');
    $routes->match(['get', 'post'], 'edit', 'Permissions::edit_permission');
});

$routes->group('admin/visitors', ['namespace' => 'Modules\UserManagement\Controllers'], function($routes)
{
    $routes->get('/', 'Visitors::index');
    $routes->match(['get', 'post'], 'logout', 'Visitors::logout_visitor');
    $routes->match(['get', 'post'], 'add', 'Visitors::add_visitor');

});

