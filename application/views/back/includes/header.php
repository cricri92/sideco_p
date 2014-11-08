<!DOCTYPE html>
<html lang="en">
    <head>
        <base href="<?php echo base_url(); ?>">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../../favicon.ico">

        <title><?php echo $title; ?></title>

        <!-- Bootstrap core CSS -->
        <link href="assets/back/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="assets/back/css/offcanvas.css" rel="stylesheet">

        <link rel="stylesheet" href="assets/back/css/styles.css"/>

    </head>
    <body>
        <header>
            <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
                <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                      </button>
                      <a class="navbar-brand" href="backend" style="color:black"><span class="glyphicon glyphicon-home"></span> SIDeCo</a>
                    </div>
                        <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color:black">Dependencias <span class="caret" ></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="backend/dependencias/nueva-dependencia">Nueva dependencia</a></li>
                                    <li><a href="backend/dependencias">Ver dependencias</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color:black">Solicitantes <span class="caret" ></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="backend/solicitantes/nuevo-solicitante">Nuevo solicitante</a></li>
                                    <li><a href="backend/solicitantes">Ver solicitantes</a></li>
                                    <li><a href="backend/solicitantes/nuevo-rol-solicitante">Crear un rol de solicitante</a></li>
                                    <li><a href="backend/solicitantes/roles-solicitantes">Ver roles de solicitantes</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color:black">Solicitudes <span class="caret" ></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="backend/solicitudes/nueva-solicitud">Crear Solicitud</a></li>
                                    <li><a href="solicitudes.html">Habilitar Solicitudes</a></li>
                                    <li><a href="backend/solicitudes">Revisar Solicitudes</a></li>
                                    <li><a href="backend/solicitudes/nuevo-tipo-solicitud">Nuevo tipo de solicitud</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color:black">Agenda<span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="backend/agendas/nueva-agenda">Crear Agenda</a></li>
                                    <li><a href="agenda.html">Ver Agenda Actual</a></li>
                                    <li><a href="backend/agendas/agregar-solicitudes">Agregar solicitudes</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color:black">Actas<span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="acta.html">Generar Acta</a></li>
                                    <li><a href="acta.html">Ver Acta Actual</a></li>
                                    <li><a href="acta.html">Ver Actas Publicadas</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color:black">Consejeros<span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="backend/consejeros/nuevo-consejero">Crear consejero</a></li>
                                    <li><a href="backend/consejeros/consejeros">Ver consejeros</a></li>
                                    <li><a href="backend/consejeros/nuevo-tipo-consejero">Nuevo tipo de consejeros</a></li>
                                </ul>
                            </li>
                            <?php if($userData['privilege_id'] == 1): ?>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color:black">Usuarios<span class="caret"></span></a>
                                    <ul class="dropdown-menu" role="menu">
                                       <li><a href="backend/usuarios/nuevo-usuario">Nuevo usuario</a></li>
                                        
                                        <li><a href="backend/usuarios">Ver usuarios</a></li>
                                    </ul>
                                </li>
                            <?php endif; ?>
                        </ul> <!-- navbar nav-->
                        <ul class="nav navbar-nav navbar-right">
                            <!--<form class="navbar-form" role="search">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Ingrese su bùsqueda">
                                </div>
                                <button type="submit" class="btn btn-default">Buscar</button>
                            </form>-->
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color:black"><span class="glyphicon glyphicon-user"></span> <?php echo $userData['name']; ?></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="backend/usuarios/actualizar/<?php echo $userData['slug']; ?>">Actualizar perfil</a></li>
                                    <li><a href="backend/logout">Cerrar Sesión</a></li>
                                </ul>
                            </li>           
                        </ul>           
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
             </nav>
            <img src="assets/back/img/banner.png" alt="" width="100%">
        </header>