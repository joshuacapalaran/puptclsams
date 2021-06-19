<?php

// $routes->group('<path name (sa link)>', ['namespace' => 'Modules\<Module Name>\Controllers'], function($routes){
//   $routes->get('/', '<controller name>::index');
//   $routes->match(['get', 'post'], 'add', '<controller name>::add');
//   $routes->match(['get', 'post'], 'edit/(:num)', '<controller name>::edit/$1');
//   $routes->delete('delete/(:num)', '<controller name>::delete/$1');
// });
//programs
$routes->group('admin/programs', ['namespace' => 'Modules\ProgramManagement\Controllers'], function($routes){
  $routes->get('/', 'Programs::index');
  $routes->match(['get', 'post'], 'add', 'Programs::add');
  $routes->match(['get', 'post'], 'edit/(:num)', 'Programs::edit/$1');
  $routes->get('delete/(:num)', 'Programs::delete/$1');
});

//program_types
$routes->group('admin/programtypes', ['namespace' => 'Modules\ProgramManagement\Controllers'], function($routes){
  $routes->get('/', 'ProgramTypes::index');
  $routes->match(['get', 'post'], 'add', 'ProgramTypes::add');
  $routes->match(['get', 'post'], 'edit/(:num)', 'ProgramTypes::edit/$1');
  $routes->get('delete/(:num)', 'ProgramTypes::delete/$1');
});