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
$routes->post('/home', 'Home::login', ['as'=> 'home']);

//MENU-SUBMENU
$routes->get('/menu_submenu', 'modAdministracion/MenuSubmenuController::menu_submenu', ['as'=> 'menu_submenu']);
$routes->post('/crear', 'modAdministracion/MenuSubmenuController::crear');;
$routes->get('/eliminar/(:any)', 'modAdministracion/MenuSubmenuController::eliminar/$1');
$routes->get('/editar/(:any)', 'modAdministracion/MenuSubmenuController::editar/$1');
$routes->post('/editMenu', 'modAdministracion/MenuSubmenuController::actualizar');

$routes->get('/submenus', 'modAdministracion/SubMenuController::submenus', ['as'=> 'submenus']);
$routes->post('/agregarSubMenu', 'modAdministracion/SubMenuController::agregarSubMenu');
$routes->post('/actualizarSubmenu', 'modAdministracion/SubMenuController::actualizarSubmenu');
$routes->get('/eliminarSubmenu/(:any)', 'modAdministracion/SubMenuController::eliminarSubmenu/$1');

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
$routes->post('/crearContacto', 'modUsuario/ContactoController::crearContacto');
$routes->post('/crearTipoContacto', 'modUsuario/ContactoController::crearTipoContacto');
$routes->post('/actualizarContacto', 'modUsuario/ContactoController::actualizarContacto');
$routes->post('/actualizarTipoContacto', 'modUsuario/ContactoController::actualizar');
$routes->post('/eliminarTipoContacto', 'modUsuario/ContactoController::eliminar');
$routes->post('/eliminarContacto', 'modUsuario/ContactoController::eliminarContacto');

//DIRECCIÓN
$routes->get('/direccion', 'modUsuario/DireccionController::direccion', ['as'=> 'direccion']);
$routes->post('/crearDireccion', 'modUsuario/DireccionController::crearDireccion');
$routes->post('/actualizarDireccion', 'modUsuario/DireccionController::actualizarDireccion');
$routes->post('/eliminarDireccion', 'modUsuario/DireccionController::eliminarDireccion');

//PERSONA
$routes->get('/persona', 'modUsuario/PersonaController::persona', ['as'=> 'persona']);
$routes->post('/crearPersona', 'modUsuario/PersonaController::crear');
$routes->post('/actualizarPersona', 'modUsuario/PersonaController::actualizar');
$routes->post('/eliminarPersona', 'modUsuario/PersonaController::eliminar');

//USUARIO
$routes->get('/usuario', 'modUsuario/UsuarioController::usuario', ['as'=> 'usuario']);
$routes->post('/crearUsuario', 'modUsuario/UsuarioController::crear');
$routes->post('/actualizarUsuario', 'modUsuario/UsuarioController::actualizar');
$routes->post('/eliminarUsuario', 'modUsuario/UsuarioController::eliminar');

//PROCESO
$routes->get('/proceso', 'modProceso/ProcesoController::proceso', ['as'=> 'proceso']);
$routes->post('/crearProceso', 'modProceso/ProcesoController::crear');
$routes->post('/actualizarProceso', 'modProceso/ProcesoController::actualizar');
$routes->post('/eliminarProceso', 'modProceso/ProcesoController::eliminar');

//TIPO PROCESO
$routes->get('/tipoProceso', 'modProceso/TipoProcesoController::tipoProceso', ['as'=> 'tipoProceso']);
$routes->post('/crearTipoProceso', 'modProceso/TipoProcesoController::crear');
$routes->post('/actualizarTipoProceso', 'modProceso/TipoProcesoController::actualizar');
$routes->post('/eliminarTipoProceso', 'modProceso/TipoProcesoController::eliminar');

//ETAPA
$routes->get('/etapa', 'modProceso/EtapaController::etapa', ['as'=> 'etapa']);
$routes->post('/crearEtapa', 'modProceso/EtapaController::crear');
$routes->post('/actualizarEtapa', 'modProceso/EtapaController::actualizar');
$routes->post('/eliminarEtapa', 'modProceso/EtapaController::eliminar');

//ACTIVIDADES
$routes->get('/actividad', 'modProceso/ActividadController::actividad', ['as'=> 'actividad']);
$routes->post('/crearActividad', 'modProceso/ActividadController::crear');
$routes->post('/actualizarActividad', 'modProceso/ActividadController::actualizar');
$routes->post('/eliminarActividad', 'modProceso/ActividadController::eliminar');


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
