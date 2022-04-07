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
$routes->get('/planEstudio', 'modPlanEstudio/PlanEstudioController::planEstudio', ['as'=> 'planEstudio']);

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
$routes->get('/editar/(:any)', 'modAdministracion/RolModMenuController::obtenerId/$1');
$routes->post('/editRolMM', 'modAdministracion/RolModMenuController::actualizarRolMM');

//MODULO
$routes->get('/adminModulo', 'modAdministracion/ModuloController::adminModulo', ['as'=> 'adminModulo']);
$routes->post('/crearModulo', 'modAdministracion/ModuloController::crearModulo');
$routes->get('/obtenerModulo/(:any)', 'modAdministracion/ModuloController::obtenerModulo/$1');
$routes->post('/actualizarModulo', 'modAdministracion/ModuloController::actualizarModulo');
$routes->get('/eliminar/(:any)', 'modAdministracion/ModuloController::eliminar/$1');

///ROL
$routes->get('/adminRol', 'modAdministracion/RolController::adminRol', ['as'=> 'adminRol']);
$routes->post('/crearRol', 'modAdministracion/RolController::crear');
$routes->get('/obtenerRol/(:any)', 'modAdministracion/RolController::obtenerRol/$1');
$routes->post('/actualizar', 'modAdministracion/RolController::actualizar');
$routes->get('/eliminar/(:any)', 'modAdministracion/RolController::eliminar/$1');

$routes->get('/expedientesGraduandos', 'modExpedientesGraduandos/ExpedientesGraduandosController::expedientesGraduandos', ['as'=> 'expedientesGr']);
$routes->get('/entidadesExternas', 'modEntidadesExternas/EntidadesExternasController::entidadesExternas', ['as'=> 'entidadesEx']);


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
