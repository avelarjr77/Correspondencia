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
$routes->setDefaultController('DocController');
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

$routes->post('/homeModulos', 'Login::login', ['as'=> 'homeModulos']);
$routes->get('/salir', 'Home::salir');


$routes->get('/recuperarContraseña', 'Login::recuperarContraseña' ) ;
$routes->post('/recuperarContraseña', 'Login::recuperarContraseña' ) ;


$routes->group('/',['filter'=>'auth'],function($routes){
    $routes->get('/homeModulos', 'Home::modulo', ['as'=> 'homeModulos']);
    $routes->get('homeMenus', 'HomeMenusController::index');
    $routes->post('homeMenus', 'HomeMenusController::index');
    $routes->get('homeMenu', 'HomeMenusController::homeMenu', ['as'=> 'homeMenu']);
    $routes->get('perfil', 'PerfilController::index');
    $routes->post('nuevaContraseña', 'PerfilController::nuevaContraseña');
    $routes->post('editarPerfil', 'PerfilController::editarPerfil');
});

//MENU
$routes->group('/',['filter'=>'auth'],function($routes){

    $routes->get('menu_submenu', 'modAdministracion/MenuSubmenuController::menu_submenu', ['as'=> 'menu_submenu']);
    $routes->post('crear', 'modAdministracion/MenuSubmenuController::crear');
    $routes->post('eliminarMenu', 'modAdministracion/MenuSubmenuController::eliminar');
    $routes->get('editar/(:any)', 'modAdministracion/MenuSubmenuController::editar/$1');
    $routes->post('editMenu', 'modAdministracion/MenuSubmenuController::actualizar');

});

//SUBMENU
$routes->group('/',['filter'=>'auth'],function($routes){
    $routes->get('submenus', 'modAdministracion/SubMenuController::submenus', ['as'=> 'submenus']);
    $routes->post('agregarSubMenu', 'modAdministracion/SubMenuController::agregarSubMenu');
    $routes->post('actualizarSubmenu', 'modAdministracion/SubMenuController::actualizarSubmenu');
    $routes->post('eliminarSubmenu', 'modAdministracion/SubMenuController::eliminar');

});

//ROL-MODULO-MENU
$routes->group('/',['filter'=>'auth'],function($routes){
    $routes->get('rolModMenu', 'modAdministracion/RolModMenuController::index', ['as'=> 'rolModMenu']);
    $routes->post('crearRMM', 'modAdministracion/RolModMenuController::crearRolModuloMenu');
    $routes->post('actualizarRMM', 'modAdministracion/RolModMenuController::actualizar');
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

//MODULO-MENU
$routes->group('/',['filter'=>'auth'],function($routes){
    $routes->get('moduloMenu', 'modAdministracion/ModuloMenuController::moduloMenu', ['as'=> 'moduloMenu']);
    $routes->post('crearMM', 'modAdministracion/ModuloMenuController::crearModuloMenu');
    $routes->post('actualizarMM', 'modAdministracion/ModuloMenuController::actualizar');
    $routes->post('eliminarMM', 'modAdministracion/ModuloMenuController::eliminar');

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
    $routes->post('crearTipoContacto', 'modUsuario/TipoContactoController::crearTipoContacto');
    $routes->post('actualizarContacto', 'modUsuario/ContactoController::actualizarContacto');
    $routes->post('actualizarTipoContacto', 'modUsuario/TipoContactoController::actualizar');
    $routes->post('eliminarTipoContacto', 'modUsuario/TipoContactoController::eliminar');
    $routes->post('eliminarContacto', 'modUsuario/ContactoController::eliminarContacto');

});

//DIRECCIÓN
$routes->group('/',['filter'=>'auth'],function($routes){
    $routes->get('direccion', 'modUsuario/DireccionController::direccion', ['as'=> 'direccion']);
    $routes->post('crearDireccion', 'modUsuario/DireccionController::crearDireccion');
    $routes->post('actualizarDireccion', 'modUsuario/DireccionController::actualizarDireccion');
    $routes->post('eliminarDireccion', 'modUsuario/DireccionController::eliminarDireccion');
    $routes->match(['get', 'post'],'obtenerMun', 'modUsuario/DireccionController::municipio', ['as'=> 'obtenerMun']);
    $routes->match(['get', 'post'],'obtenerMunA', 'modUsuario/DireccionController::municipioA', ['as'=> 'obtenerMunA']);
    $routes->match(['get', 'post'],'obtenerDepto', 'modUsuario/DireccionController::odepto', ['as'=> 'obtenerDepto']);
    $routes->match(['get', 'post'],'obtenerDeptoList', 'modUsuario/DireccionController::deptoList', ['as'=> 'obtenerDeptoList']);
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
    $routes->post('crearDocumentoImage', 'modUsuario/DocumentoController::crearImage');
    $routes->post('actualizarDocumento', 'modUsuario/DocumentoController::actualizar');
    $routes->match(['get', 'post'],'actualizarDoc', 'modUsuario/DocumentoController::actualizarDoc', ['as'=> 'actualizarDoc']);
    $routes->post('eliminarDocumento', 'modUsuario/DocumentoController::eliminar', ['as'=> 'eliminarDocumento']);
    $routes->post('eliminarDoc', 'modUsuario/DocumentoController::eliminarDoc', ['as'=> 'eliminarDoc']);
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
    $routes->get('personaListC', 'modProceso/ActividadController::personaListC', ['as'=> 'personaListC']);
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
    $routes->get('transaccionConfig', 'modTransaccion/TransaccionConfigController::index', ['as'=> 'transaccionConfig']);
    $routes->post('crearTransaccion', 'modTransaccion/TransaccionConfigController::crear');
    $routes->post('actualizarTransaccion', 'modTransaccion/TransaccionConfigController::actualizar');
    $routes->post('actualizarO', 'modTransaccion/TransaccionConfigController::actualizarO');
    $routes->match(['get', 'post'],'transaccionEtapa', 'modTransaccion/TransaccionConfigController::etapas', ['as'=> 'transaccionEtapa']);
    $routes->match(['get', 'post'],'transaccionEliminar', 'modTransaccion/TransaccionConfigController::eliminarT', ['as'=> 'transaccionEliminar']);
    $routes->match(['get', 'post'],'transaccionObservaciones', 'modTransaccion/TransaccionConfigController::transaccionObservaciones', ['as'=> 'transaccionObservaciones']);
    $routes->match(['get', 'post'],'transaccionEliminarP', 'modTransaccion/TransaccionConfigController::eliminarP', ['as'=> 'transaccionEliminarP']);
    $routes->match(['get', 'post'],'transaccionListado', 'modTransaccion/TransaccionConfigController::transaccionListado', ['as'=> 'transaccionListado']);
    $routes->match(['get', 'post'],'transaccionList', 'modTransaccion/TransaccionConfigController::etapasList', ['as'=> 'transaccionList']);
    $routes->match(['get', 'post'],'transaccionDet', 'modTransaccion/TransaccionConfigController::tDetalle', ['as'=> 'transaccionDet']);    
    $routes->match(['get', 'post'],'transaccionDetId', 'modTransaccion/TransaccionConfigController::tDetId', ['as'=> 'transaccionDetId']);    
    $routes->match(['get', 'post'],'transaccionAcId', 'modTransaccion/TransaccionConfigController::tAcId', ['as'=> 'transaccionAcId']);    
    $routes->match(['get', 'post'],'transaccionActividad', 'modTransaccion/TransaccionConfigController::actividad', ['as'=> 'transaccionActividad']);
    $routes->match(['get', 'post'],'transaccionActList', 'modTransaccion/TransaccionConfigController::actividadList', ['as'=> 'transaccionActList']);
    $routes->match(['get', 'post'],'transaccionActDet', 'modTransaccion/TransaccionConfigController::tActividades', ['as'=> 'transaccionActDet']);    
    
    //TRANSACCION ACTIVIDAD
    $routes->match(['get', 'post'],'transaccionActividades', 'modTransaccion/TransaccionActividadController::index', ['as'=> 'transaccionActividades']);
    $routes->match(['get', 'post'],'actividadF', 'modTransaccion/TransaccionActividadController::finalizarA', ['as'=> 'actividadF']);
    $routes->match(['get', 'post'],'actividadI', 'modTransaccion/TransaccionActividadController::iniciarActividad', ['as'=> 'actividadI']);
    $routes->match(['get', 'post'],'actualizarActO', 'modTransaccion/TransaccionActividadController::actualizarO', ['as'=> 'actualizarActO']);
    $routes->match(['get', 'post'],'actividadDoc', 'modTransaccion/DocController::doc', ['as'=> 'actividadDoc']);
    $routes->match(['get', 'post'],'docLista', 'modTransaccion/TransaccionActividadController::docLista', ['as'=> 'docLista']);
    $routes->match(['get', 'post'],'docVista', 'modTransaccion/TransaccionActividadController::docVista', ['as'=> 'docVista']);

    //TRANSACCION LIST
    $routes->get('transaccionLista', 'modTransaccion/TransaccionListController::list', ['as'=> 'transaccionLista']);

    $routes->post('eliminarTransaccion', 'modTransaccion/TransaccionConfigController::eliminar');

    $routes->get('listadoDocumentos', 'modUsuario/DocumentoController::listadoDocumentos', ['as'=> 'listadoDocumentos']);

});  

//GRAFICAS
$routes->group('/',['filter'=>'auth'],function($routes){
    $routes->get('graficas', 'modGraficas/GraficasController::index', ['as'=> 'graficas']);
    $routes->match(['get', 'post'],'gBarraFecha', 'modGraficas/GraficasController::barraF', ['as'=> 'gBarraFecha']);
    $routes->match(['get', 'post'],'gBarraProceso', 'modGraficas/GraficasController::barraP', ['as'=> 'gBarraProceso']);    
    $routes->match(['get', 'post'],'gBarraPromedio', 'modGraficas/GraficasController::barraProm', ['as'=> 'gBarraPromedio']);    
    $routes->match(['get', 'post'],'gPastelG', 'modGraficas/GraficasController::pastelG', ['as'=> 'gPastelG']);
    $routes->get('graficaLineal', 'modGraficas/GraficasController::line', ['as'=> 'graficaLineal']);
    $routes->get('graficasProceso', 'modGraficas/GraficasController::proceso', ['as'=> 'graficasProceso']);

});

//REPORTES
$routes->group('/',['filter'=>'auth'],function($routes){
    $routes->get('reportes', 'modReportes/ReportesController::index');
    $routes->get('pruebaR', 'modReportes/PruebaController::index', ['as'=> 'pruebaR']);
    $routes->get('promedioActividad', 'modReportes/PromedioActividadController::index', ['as'=> 'promedioActividad']);
    $routes->get('procesoDetalle', 'modReportes/ProcesoDetalleController::index', ['as'=> 'procesoDetalle']);
    $routes->match(['get', 'post'],'vistaDetalle', 'modReportes/VistaController::index', ['as'=> 'vistaDetalle']);
    $routes->match(['get', 'post'],'procesoUnico', 'modReportes/ProcesoUnicoController::index', ['as'=> 'procesoUnico']);
    $routes->match(['get', 'post'],'procesoTiempo', 'modReportes/ProcesoTiempoController::index', ['as'=> 'procesoTiempo']);
    $routes->match(['get', 'post'],'flujoActividad', 'modReportes/FlujoActividadesController::index', ['as'=> 'flujoActividad']);
});

//BITACORA
$routes->group('/',['filter'=>'auth'],function($routes){
    $routes->get('bitacora', 'modAdministracion/BitacoraController::bitacora', ['as'=> 'bitacora']);
    $routes->post('crearUsuario', 'modUsuario/UsuarioController::crear');
    $routes->post('actualizarUsuario', 'modUsuario/UsuarioController::actualizar');
    $routes->post('eliminarUsuario', 'modUsuario/UsuarioController::eliminar');

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