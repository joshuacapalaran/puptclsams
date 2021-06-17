<?php

// $routes->group('<path name (sa link)>', ['namespace' => 'Modules\<Module Name>\Controllers'], function($routes){
//   $routes->get('/', '<controller name>::index');
//   $routes->match(['get', 'post'], 'add', '<controller name>::add');
//   $routes->match(['get', 'post'], 'edit/(:num)', '<controller name>::edit/$1');
//   $routes->delete('delete/(:num)', '<controller name>::delete/$1');
// });
//students
  $routes->group('admin/students', ['namespace' => 'Modules\MaintenanceManagement\Controllers'], function($routes){
  $routes->get('/', 'Students::index');
  $routes->match(['get', 'post'], 'add', 'Students::add');
  $routes->match(['get', 'post'], 'edit/(:num)', 'Students::edit/$1');
  $routes->get('delete/(:num)', 'Students::delete/$1');
});

//professors
  $routes->group('admin/professors', ['namespace' => 'Modules\MaintenanceManagement\Controllers'], function($routes){
  $routes->get('/', 'Professors::index');
  $routes->match(['get', 'post'], 'add', 'Professors::add');
  $routes->match(['get', 'post'], 'edit/(:num)', 'Professors::edit/$1');
  $routes->get('delete/(:num)', 'Professors::delete/$1');
});

//subjects
  $routes->group('admin/subjects', ['namespace' => 'Modules\MaintenanceManagement\Controllers'], function($routes){
  $routes->get('/', 'Subjects::index');
  $routes->match(['get', 'post'], 'add', 'Subjects::add');
  $routes->match(['get', 'post'], 'edit/(:num)', 'Subjects::edit/$1');
  $routes->get('delete/(:num)', 'Subjects::delete/$1');
});

//courses
  $routes->group('admin/courses', ['namespace' => 'Modules\MaintenanceManagement\Controllers'], function($routes){
  $routes->get('/', 'Courses::index');
  $routes->match(['get', 'post'], 'add', 'Courses::add');
  $routes->match(['get', 'post'], 'edit/(:num)', 'Courses::edit/$1');
  $routes->get('delete/(:num)', 'Courses::delete/$1');
});

//capacities
  $routes->group('admin/capacities', ['namespace' => 'Modules\MaintenanceManagement\Controllers'], function($routes){
  $routes->get('/', 'Capacities::index');
  $routes->match(['get', 'post'], 'add', 'Capacities::add');
  $routes->match(['get', 'post'], 'edit/(:num)', 'Capacities::edit/$1');
  $routes->get('delete/(:num)', 'Capacities::delete/$1');
});

//categories
  $routes->group('admin/categories', ['namespace' => 'Modules\MaintenanceManagement\Controllers'], function($routes){
  $routes->get('/', 'Categories::index');
  $routes->match(['get', 'post'], 'add', 'Categories::add');
  $routes->match(['get', 'post'], 'edit/(:num)', 'Categories::edit/$1');
  $routes->get('delete/(:num)', 'Categories::delete/$1');
});

//labs
  $routes->group('admin/labs', ['namespace' => 'Modules\MaintenanceManagement\Controllers'], function($routes){
  $routes->get('/', 'Labs::index');
  $routes->match(['get', 'post'], 'add', 'Labs::add');
  $routes->match(['get', 'post'], 'edit/(:num)', 'Labs::edit/$1');
  $routes->get('delete/(:num)', 'Labs::delete/$1');
});


//sections
  $routes->group('admin/sections', ['namespace' => 'Modules\MaintenanceManagement\Controllers'], function($routes){
  $routes->get('/', 'Sections::index');
  $routes->match(['get', 'post'], 'add', 'Sections::add');
  $routes->match(['get', 'post'], 'edit/(:num)', 'Sections::edit/$1');
  $routes->get('delete/(:num)', 'Sections::delete/$1');
});

//semesters
  $routes->group('admin/semesters', ['namespace' => 'Modules\MaintenanceManagement\Controllers'], function($routes){
  $routes->get('/', 'Semesters::index');
  $routes->match(['get', 'post'], 'add', 'Semesters::add');
  $routes->match(['get', 'post'], 'edit/(:num)', 'Semesters::edit/$1');
  $routes->get('delete/(:num)', 'Semesters::delete/$1');
});

//suffixes
  $routes->group('admin/suffixes', ['namespace' => 'Modules\MaintenanceManagement\Controllers'], function($routes){
  $routes->get('/', 'Suffixes::index');
  $routes->match(['get', 'post'], 'add', 'Suffixes::add');
  $routes->match(['get', 'post'], 'edit/(:num)', 'Suffixes::edit/$1');
  $routes->get('delete/(:num)', 'Suffixes::delete/$1');
});

//schoolyears
  $routes->group('admin/schoolyears', ['namespace' => 'Modules\MaintenanceManagement\Controllers'], function($routes){
  $routes->get('/', 'Schoolyears::index');
  $routes->match(['get', 'post'], 'add', 'Schoolyears::add');
  $routes->match(['get', 'post'], 'edit/(:num)', 'Schoolyears::edit/$1');
  $routes->get('delete/(:num)', 'Schoolyears::delete/$1');
});

//schoolyears
  $routes->group('admin/schedlabs', ['namespace' => 'Modules\MaintenanceManagement\Controllers'], function($routes){
  $routes->get('/', 'Schedlabs::index');
  $routes->match(['get', 'post'], 'add', 'Schedlabs::add');
  $routes->match(['get', 'post'], 'edit/(:num)', 'Schedlabs::edit/$1');
  $routes->get('delete/(:num)', 'Schedlabs::delete/$1');
});
