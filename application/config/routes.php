<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "";

//<----------------------------- BACKEND ROUTES ---------------------->

//USUARIOS
$route['backend/login']										= 'user/login';
$route['backend/logout']		 							= 'user/logout';
$route['backend/usuarios/nuevo-usuario'] 					= 'user/newUser';
$route['backend/usuarios/crear-usuario']  					= 'user/createUser';
$route['backend/usuarios']									= 'user/showUsers';
$route['backend/usuarios/actualizar/(.*)']					= 'user/updateUser/$1';
$route['backend/usuarios/actualizar-usuario'] 				= 'user/userUpdate';
$route['backend/usuarios/eliminar/(.*)']					= 'user/deleteUser/$1';
$route['backend/usuarios/eliminando/(.*)']					= 'user/userDelete/$1';

//SOLICITANTES
$route['backend/solicitantes/nuevo-solicitante']			= 'applicant/newApplicant';
$route['backend/solicitantes/crear-solicitante']			= 'applicant/createApplicant';
$route['backend/solicitantes']								= 'applicant/showApplicants';
$route['backend/solicitantes/actualizar/(.*)']				= 'applicant/updateApplicant/$1'; 
$route['backend/solicitantes/eliminar/(.*)']				= 'applicant/deleteApplicant/$1';
$route['backend/solicitantes/actualizar-solicitante']		= 'applicant/applicantUpdate';
$route['backend/solcitantes/eliminar-solicitante/(.*)']		= 'applicant/applicantDelete/$1';
$route['backend/solicitantes/nuevo-rol-solicitante']		= 'applicant_role/newApplicantRole';
$route['backend/solicitantes/crear-rol-solicitante']		= 'applicant_role/createApplicantRole';
$route['backend/solicitantes/roles-solicitantes']		    = 'applicant_role/showApplicantRoles';

//SOLICITUDES
$route['backend/solicitudes/nuevo-tipo-solicitud'] 			= 'type_request/newTypeRequest';
$route['backend/solicitudes/crear-nuevo-tipo-solicitud'] 	= 'type_request/createTypeRequest';
$route['backend/solicitudes/nueva-solicitud']				= 'request/newRequest';
$route['backend/solicitudes/crear-solicitud']				= 'request/createRequest';
$route['backend/solicitudes'] 								= 'request/showAllRequests';
$route['backend/solicitudes/veredicto/(.*)']				= 'request/changeVeredict/$1';
$route['backend/solicitudes/dar-veredicto']					= 'request/veredict';

//AGENDA
$route['backend/agendas/nueva-agenda']						= 'diary/newDiary';
$route['backend/agendas/crear-agenda']						= 'diary/createDiary';
$route['backend/agendas/agregar-solicitudes']				= 'diary/addRequests';
$route['backend/agendas/agregar-solicitud']					= 'diary/addRequest';

//DEPENDENCIAS
$route['backend/dependencias/nueva-dependencia']			= 'dependence/newDependence';
$route['backend/dependencias/crear-dependencia']			= 'dependence/createDependence';
$route['backend/dependencias']								= 'dependence/showDependences';
$route['backend/dependencias/actualizar/(.*)']				= 'dependence/updateDependence/$1';
$route['backend/dependencias/actualizar']					= 'dependence/dependenceUpdate';
$route['backend/dependencias/eliminar-dependencia/(.*)']	= 'dependence/deleteDependence/$1';
$route['backend/dependencias/eliminar/(.*)']				= 'dependence/dependenceDelete/$1';

//CONSEJEROS
$route['backend/consejeros/nuevo-consejero']				= 'counselor/newCounselor';
$route['backend/consejeros/crear-consejero']				= 'counselor/createCounselor';
$route['backend/consejeros/consejeros']						= 'counselor/showCounselors';
$route['backend/consejeros/nuevo-tipo-consejero']			= 'counselor_type/newCounselorType';
$route['backend/consejeros/crear-tipo-consejero']			= 'counselor_type/createCounselorType';


//<---------------------------- /BACKEND ROUTES ---------------------->

$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */