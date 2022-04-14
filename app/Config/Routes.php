<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Login');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Login::index');
$routes->get('/home', 'Home::index', ['as'=> 'home']);

//MENU-SUBMENU
$routes->get('/menu_submenu', 'modAdministracion/MenuSubmenuController::menu_submenu', ['as'=> 'menu_submenu']);
$routes->post('/crear', 'modAdministracion/MenuSubmenuController::crear');
$routes->post('/crearSubmenu', 'modAdministracion/MenuSubmenuController::crearSubmenu');
$routes->get('/eliminar/(:any)', 'modAdministracion/MenuSubmenuController::eliminar/$1');
$routes->get('/editar/(:any)', 'modAdministracion/MenuSubmenuController::editar/$1');
$routes->post('/editMenu', 'modAdministracion/MenuSubmenuController::actualizar');

//ROL-MODULO-MENU
$routes->post('/obtenerRol/(:any)', 'modAdministracion/RolModMenuController::obtenerRol');
$routes->get('/rolModMenu', 'modAdministracion/RolModMenuController::rolModMenu', ['as'=> 'rolModMenu']);
$routes->get('/actualizar/(:any)', 'modAdministracion/RolModMenuController::actualizar/$1');
$routes->post('/editRolMM', 'modAdministracion/RolModMenuController::actualizarRolMM');

//MODULO
$routes->get('/adminModulo', 'modAdministracion/ModuloController::adminModulo', ['as'=> 'adminModulo']);
$routes->post('/crearModulo', 'modAdministracion/ModuloController::crearModulo');
$routes->post('/actualizarModulo', 'modAdministracion/ModuloController::actualizarModulo');
$routes->post('/eliminarModulo', 'modAdministracion/ModuloController::eliminar');

///ROL
$routes->get('/adminRol', 'modAdministracion/RolController::adminRol', ['as'=> 'adminRol']);
$routes->post('/crearRol', 'modAdministracion/RolController::crear');
$routes->post('/actualizarRol', 'modAdministracion/RolController::actualizar');
$routes->post('/eliminarRol', 'modAdministracion/RolController::eliminar');

//CARGO
$routes->get('/cargo', 'modUsuario/CargoController::cargo', ['as'=> 'cargo']);
$routes->post('/crearCargo', 'modUsuario/CargoController::crear');
$routes->post('/actualizarCargo', 'modUsuario/CargoController::actualizar');
$routes->post('/eliminarCargo', 'modUsuario/CargoController::eliminar');

//DEPARTAMENTO
$routes->get('/departamento', 'modUsuario/DepartamentoController::departamento', ['as'=> 'departamento']);
$routes->post('/crearDepartamento', 'modUsuario/DepartamentoController::crear');
$routes->post('/actualizarDepartamento', 'modUsuario/DepartamentoController::actualizar');
$routes->post('/eliminarDepartamento', 'modUsuario/DepartamentoController::eliminar');

//CONTACTO
$routes->get('/contacto', 'modUsuario/ContactoController::contacto', ['as'=> 'contacto']);
$routes->post('/crearContacto', 'modUsuario/ContactoController::crear');
$routes->post('/actualizarDepartamento', 'modUsuario/DepartamentoController::actualizar');
$routes->post('/eliminarDepartamento', 'modUsuario/DepartamentoController::eliminar');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
