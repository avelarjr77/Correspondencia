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
$routes->get('/submenus', 'modAdministracion/SubMenuController::submenus', ['as'=> 'submenus']);
$routes->post('/crear', 'modAdministracion/MenuSubmenuController::crear');
$routes->post('/agregarSubMenu', 'modAdministracion/SubMenuController::agregarSubMenu');
$routes->get('/eliminar/(:any)', 'modAdministracion/MenuSubmenuController::eliminar/$1');
$routes->get('/editar/(:any)', 'modAdministracion/MenuSubmenuController::editar/$1');
$routes->post('/editMenu', 'modAdministracion/MenuSubmenuController::actualizar');
$routes->post('/actualizarSubmenu', 'modAdministracion/SubMenuController::actualizarSubmenu');

//ROL-MODULO-MENU
$routes->get('/rolModMenu', 'modAdministracion/RolModMenuController::index', ['as'=> 'rolModMenu']);
$routes->get('/actualizar', 'modAdministracion/RolModMenuController::actualizar');
$routes->match(['get', 'post'], '/editRolMM', 'modAdministracion/RolModMenuController::editar', ['as'=> 'editRolMM']);
$routes->match(['get', 'post'], '/menuList', 'modAdministracion/RolModMenuController::menu', ['as'=> 'menuList']);
$routes->match(['get', 'post'], '/editRol', 'modAdministracion/RolModMenuController::editR', ['as'=> 'editRol']);
$routes->get('/eliminarR', 'modAdministracion/RolModMenuController::eliminar', ['as'=> 'eliminarR']);
//$routes->get('/editarRolModMenu/(:any)/(:any)', 'EditarRolMController::editar/$1/$2', ['as'=> 'editarRolModMenu']);
$routes->match(['get', 'post'], '/editarRolModMenu', 'EditarRolMController::editar', ['as'=> 'editarRolModMenu']);


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

//TIPO DE ENVIO
$routes->get('/tipoEnvio', 'modUsuario/TipoEnvioController::tipoEnvio', ['as'=> 'tipoEnvio']);
$routes->post('/crearTipoEnvio', 'modUsuario/TipoEnvioController::crear');
$routes->post('/eliminarTipoEnvio', 'modUsuario/TipoEnvioController::eliminar');
$routes->post('/actualizarTipoEnvio', 'modUsuario/TipoEnvioController::actualizar');

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

//INSTITUCION
$routes->get('/institucion', 'modProceso/InstitucionController::institucion', ['as'=> 'institucion']);
$routes->post('/crearInstitucion', 'modProceso/InstitucionController::crear');
$routes->post('/actualizarInstitucion', 'modProceso/InstitucionController::actualizar');
$routes->post('/eliminarInstitucion', 'modProceso/InstitucionController::eliminar');

//TIPO DOCUMENTO
$routes->get('/tipoDocumento', 'modProceso/TipoDocumentoController::tipoDocumento', ['as'=> 'tipoDocumento']);
$routes->post('/crearTipoDocumento', 'modProceso/TipoDocumentoController::crear');
$routes->post('/actualizarTipoDocumento', 'modProceso/TipoDocumentoController::actualizar');
$routes->post('/eliminarTipoDocumento', 'modProceso/TipoDocumentoController::eliminar');

///TRANSACCION
$routes->get('/transaccion', 'modTransaccion/TransaccionController::index', ['as'=> 'transaccion']);
$routes->post('/crearTransaccion', 'modTransaccion/TransaccionController::crear');
$routes->post('/actualizarTransaccion', 'modTransaccion/TransaccionController::actualizar');
$routes->post('/eliminarTransaccion', 'modTransaccion/TransaccionController::eliminar');


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
