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

                                    //['filter'=> 'auth']
$routes->get('/', 'Login::index' ) ;

$routes->post('/homeUser', 'HomeUser::index');

$routes->post('/homeModulos', 'Home::login', ['as'=> 'homeModulos']);
$routes->get('/salir', 'Home::salir');

$routes->get('/homeModulos', 'Home::modulo', ['as'=> 'homeModulos']);

$routes->get('/recuperarContraseña', 'Login::recuperarContraseña' ) ;
$routes->post('/recuperarContraseña', 'Login::recuperarContraseña' ) ;

$routes->get('homeMenus', 'HomeMenusController::index', ['as'=> 'homeMenus']);

$routes->get('admin_template', 'MenuController::menus', ['as'=> 'admin_template']);


$routes->get('perfil', 'PerfilController::index', ['as'=> 'perfil']);

//MENU
$routes->group('/',['filter'=>'auth'],function($routes){

    $routes->get('menu_submenu', 'modAdministracion/MenuSubmenuController::menu_submenu', ['as'=> 'menu_submenu']);
    $routes->post('crear', 'modAdministracion/MenuSubmenuController::crear');
    $routes->get('eliminar/(:any)', 'modAdministracion/MenuSubmenuController::eliminar/$1');
    $routes->get('editar/(:any)', 'modAdministracion/MenuSubmenuController::editar/$1');
    $routes->post('editMenu', 'modAdministracion/MenuSubmenuController::actualizar');

});

//SUBMENU
$routes->group('/',['filter'=>'auth'],function($routes){
    $routes->get('submenus', 'modAdministracion/SubMenuController::submenus', ['as'=> 'submenus']);
    $routes->post('agregarSubMenu', 'modAdministracion/SubMenuController::agregarSubMenu');
    $routes->post('actualizarSubmenu', 'modAdministracion/SubMenuController::actualizarSubmenu');
    $routes->get('eliminarSubmenu/(:any)', 'modAdministracion/SubMenuController::eliminarSubmenu/$1');

});

//ROL-MODULO-MENU
$routes->group('/',['filter'=>'auth'],function($routes){
    $routes->get('rolModMenu', 'modAdministracion/RolModMenuController::index', ['as'=> 'rolModMenu']);
    $routes->get('actualizar', 'modAdministracion/RolModMenuController::actualizar');
    $routes->match(['get', 'post'], 'editRolMM', 'modAdministracion/RolModMenuController::editar', ['as'=> 'editRolMM']);
    $routes->match(['get', 'post'], 'menuList', 'modAdministracion/RolModMenuController::menu', ['as'=> 'menuList']);
    $routes->match(['get', 'post'], 'editRol', 'modAdministracion/RolModMenuController::editR', ['as'=> 'editRol']);
    $routes->post('eliminarR', 'modAdministracion/RolModMenuController::eliminar', ['as'=> 'eliminarR']);
    //$routes->match(['get', 'post'], '/eliminarR/(:any)', 'modAdministracion/RolModMenuController::eliminar/$1', ['as'=> 'eliminarR']);
    $routes->match(['get', 'post'], 'editarRolModMenu', 'EditarRolMController::editar', ['as'=> 'editarRolModMenu']);

});

//MODULO-MENU
$routes->group('/',['filter'=>'auth'],function($routes){
    $routes->get('moduloMenu', 'modAdministracion/ModuloMenuController::moduloMenu', ['as'=> 'moduloMenu']);
    $routes->post('crearMM', 'modAdministracion/ModuloMenuController::crearModuloMenu');
    $routes->post('actualizarMM', 'modAdministracion/ModuloMenuController::actualizar');
    $routes->post('eliminarMM', 'modAdministracion/ModuloMenuController::eliminar');

});

//MODULO
$routes->group('/',['filter'=>'auth'],function($routes){
    $routes->get('adminModulo', 'modAdministracion/ModuloController::adminModulo', ['as'=> 'adminModulo']);
    $routes->post('crearModulo', 'modAdministracion/ModuloController::crearModulo');
    $routes->post('actualizarModulo', 'modAdministracion/ModuloController::actualizarModulo');
    $routes->post('eliminarModulo', 'modAdministracion/ModuloController::eliminar');

});

///ROL
$routes->group('/',['filter'=>'auth'],function($routes){
    $routes->get('adminRol', 'modAdministracion/RolController::adminRol', ['as'=> 'adminRol']);
    //$routes->get('/adminRol', 'modAdministracion/RolController::adminRol', ['as'=> 'adminRol', 'filter'=> 'auth:usuario,user']);
    $routes->post('crearRol', 'modAdministracion/RolController::crear');
    $routes->post('actualizarRol', 'modAdministracion/RolController::actualizar');
    $routes->post('eliminarRol', 'modAdministracion/RolController::eliminar');

});

//CARGO
$routes->group('/',['filter'=>'auth'],function($routes){
    $routes->get('cargo', 'modUsuario/CargoController::cargo', ['as'=> 'cargo']);
    $routes->post('crearCargo', 'modUsuario/CargoController::crear');
    $routes->post('actualizarCargo', 'modUsuario/CargoController::actualizar');
    $routes->post('eliminarCargo', 'modUsuario/CargoController::eliminar');

});

//DEPARTAMENTO
$routes->group('/',['filter'=>'auth'],function($routes){
    $routes->get('departamento', 'modUsuario/DepartamentoController::departamento', ['as'=> 'departamento']);
    $routes->post('crearDepartamento', 'modUsuario/DepartamentoController::crear');
    $routes->post('actualizarDepartamento', 'modUsuario/DepartamentoController::actualizar');
    $routes->post('eliminarDepartamento', 'modUsuario/DepartamentoController::eliminar');

});

//CONTACTO
$routes->group('/',['filter'=>'auth'],function($routes){
    $routes->get('contacto', 'modUsuario/ContactoController::contacto', ['as'=> 'contacto']);
    $routes->post('crearContacto', 'modUsuario/ContactoController::crearContacto');
    $routes->post('crearTipoContacto', 'modUsuario/ContactoController::crearTipoContacto');
    $routes->post('actualizarContacto', 'modUsuario/ContactoController::actualizarContacto');
    $routes->post('actualizarTipoContacto', 'modUsuario/ContactoController::actualizar');
    $routes->post('eliminarTipoContacto', 'modUsuario/ContactoController::eliminar');
    $routes->post('eliminarContacto', 'modUsuario/ContactoController::eliminarContacto');

});

//DIRECCIÓN
$routes->group('/',['filter'=>'auth'],function($routes){
    $routes->get('direccion', 'modUsuario/DireccionController::direccion', ['as'=> 'direccion']);
    $routes->post('crearDireccion', 'modUsuario/DireccionController::crearDireccion');
    $routes->post('actualizarDireccion', 'modUsuario/DireccionController::actualizarDireccion');
    $routes->post('eliminarDireccion', 'modUsuario/DireccionController::eliminarDireccion');

});

//PERSONA
$routes->group('/',['filter'=>'auth'],function($routes){
    $routes->get('persona', 'modUsuario/PersonaController::persona', ['as'=> 'persona']);
    $routes->post('crearPersona', 'modUsuario/PersonaController::crear');
    $routes->post('actualizarPersona', 'modUsuario/PersonaController::actualizar');
    $routes->post('eliminarPersona', 'modUsuario/PersonaController::eliminar');

});

//USUARIO
$routes->group('/',['filter'=>'auth'],function($routes){
    $routes->get('usuario', 'modUsuario/UsuarioController::usuario', ['as'=> 'usuario']);
    $routes->post('crearUsuario', 'modUsuario/UsuarioController::crear');
    $routes->post('actualizarUsuario', 'modUsuario/UsuarioController::actualizar');
    $routes->post('eliminarUsuario', 'modUsuario/UsuarioController::eliminar');

});

//TIPO DE ENVIO
$routes->group('/',['filter'=>'auth'],function($routes){
    $routes->get('tipoEnvio', 'modUsuario/TipoEnvioController::tipoEnvio', ['as'=> 'tipoEnvio']);
    $routes->post('crearTipoEnvio', 'modUsuario/TipoEnvioController::crear');
    $routes->post('eliminarTipoEnvio', 'modUsuario/TipoEnvioController::eliminar');
    $routes->post('actualizarTipoEnvio', 'modUsuario/TipoEnvioController::actualizar');

});

//DOCUMENTO
$routes->group('/',['filter'=>'auth'],function($routes){
    $routes->get('documento', 'modUsuario/DocumentoController::documento', ['as'=> 'documento']);
    $routes->post('crearDocumento', 'modUsuario/DocumentoController::crear');
    $routes->post('actualizarDocumento', 'modUsuario/DocumentoController::actualizar');
    $routes->post('eliminarDocumento', 'modUsuario/DocumentoController::eliminar');

});

//CONFIGURACIÓN DE PROCESO

//PROCESO
$routes->group('/',['filter'=>'auth'],function($routes){
    $routes->get('proceso', 'modProceso/ProcesoController::proceso', ['as'=> 'proceso']);
    $routes->post('crearProceso', 'modProceso/ProcesoController::crear');
    $routes->post('actualizarProceso', 'modProceso/ProcesoController::actualizar');
    $routes->post('eliminarProceso', 'modProceso/ProcesoController::eliminar');

});

//TIPO PROCESO
$routes->group('/',['filter'=>'auth'],function($routes){
    $routes->get('tipoProceso', 'modProceso/TipoProcesoController::tipoProceso', ['as'=> 'tipoProceso']);
    $routes->post('crearTipoProceso', 'modProceso/TipoProcesoController::crear');
    $routes->post('actualizarTipoProceso', 'modProceso/TipoProcesoController::actualizar');
    $routes->post('eliminarTipoProceso', 'modProceso/TipoProcesoController::eliminar');

});

//ETAPA
$routes->group('/',['filter'=>'auth'],function($routes){
    $routes->get('etapa', 'modProceso/EtapaController::etapa', ['as'=> 'etapa']);
    $routes->get('etapaC', 'modProceso/EtapaController::etapaC', ['as'=> 'etapaC']);
    $routes->get('etapaLN', 'modProceso/EtapaController::etapa', ['as'=> 'etapaLN']);
    $routes->get('etapaLNA', 'modProceso/EtapaController::etapa', ['as'=> 'etapaLNA']);
    $routes->get('etapaList', 'modProceso/EtapaController::etapaList', ['as'=> 'etapaList']);
    $routes->get('listEtapa', 'modProceso/EtapaController::listEtapa', ['as'=> 'listEtapa']);
    $routes->match(['get', 'post'], 'crearEtapa', 'modProceso/EtapaController::crear', ['as'=> 'crearEtapa']);
    $routes->match(['get', 'post'], 'actualizarEtapa', 'modProceso/EtapaController::actualizar', ['as'=> 'actualizarEtapa']);
    $routes->match(['get', 'post'],'eliminarEtapa', 'modProceso/EtapaController::eliminar', ['as'=> 'eliminarEtapa']);
});

//ACTIVIDADES
$routes->group('/',['filter'=>'auth'],function($routes){
    $routes->get('actividad', 'modProceso/ActividadController::actividad', ['as'=> 'actividad']);
    $routes->get('actividadC', 'modProceso/ActividadController::actividad', ['as'=> 'actividadC']);
    $routes->get('actividadLN', 'modProceso/ActividadController::actividad', ['as'=> 'actividadLN']);
    $routes->get('actividadLNA', 'modProceso/ActividadController::actividad', ['as'=> 'actividadLNA']);
    $routes->get('actList', 'modProceso/ActividadController::actList', ['as'=> 'actList']);
    $routes->get('personaList', 'modProceso/ActividadController::personaList', ['as'=> 'personaList']);
    $routes->get('personaListA', 'modProceso/ActividadController::personaListA', ['as'=> 'personaListA']);
    $routes->get('personaListC', 'modProceso/ActividadController::personaListA', ['as'=> 'personaListC']);
    $routes->get('etapaL', 'modProceso/ActividadController::etapaL', ['as'=> 'etapaL']);
    $routes->match(['get', 'post'], 'crearActividad', 'modProceso/ActividadController::crear', ['as'=> 'crearActividad']);
    $routes->match(['get', 'post'], 'actualizarActividad', 'modProceso/ActividadController::actualizar', ['as'=> 'actualizarActividad']);
    $routes->match(['get', 'post'],'eliminarActividad', 'modProceso/ActividadController::eliminar', ['as'=> 'eliminarActividad']);

});

//INSTITUCION
$routes->group('/',['filter'=>'auth'],function($routes){
    $routes->get('institucion', 'modProceso/InstitucionController::institucion', ['as'=> 'institucion']);
    $routes->post('crearInstitucion', 'modProceso/InstitucionController::crear');
    $routes->post('actualizarInstitucion', 'modProceso/InstitucionController::actualizar');
    $routes->post('eliminarInstitucion', 'modProceso/InstitucionController::eliminar');

});

//TIPO DOCUMENTO
$routes->group('/',['filter'=>'auth'],function($routes){
    $routes->get('tipoDocumento', 'modProceso/TipoDocumentoController::tipoDocumento', ['as'=> 'tipoDocumento']);
    $routes->post('crearTipoDocumento', 'modProceso/TipoDocumentoController::crear');
    $routes->post('actualizarTipoDocumento', 'modProceso/TipoDocumentoController::actualizar');
    $routes->post('eliminarTipoDocumento', 'modProceso/TipoDocumentoController::eliminar');

});

///TRANSACCION
$routes->group('/',['filter'=>'auth'],function($routes){
    $routes->get('transaccion', 'modTransaccion/TransaccionController::index', ['as'=> 'transaccion']);
    $routes->post('crearTransaccion', 'modTransaccion/TransaccionController::crear');
    $routes->post('actualizarTransaccion', 'modTransaccion/TransaccionController::actualizar');
    $routes->post('eliminarTransaccion', 'modTransaccion/TransaccionController::eliminar');

});    

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
