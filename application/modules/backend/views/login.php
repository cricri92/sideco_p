<!DOCTYPE html>
<html lang="es">
<head>
    <base href="<?php echo base_url(); ?>">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Oriana Ruiz">
    <link rel="icon" href="../../favicon.ico">

    <title><?php echo $title; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="assets/back/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/back/css/signinback.css" rel="stylesheet">

</head>
<body>
    <div class="container">
        <img src="assets/back/img/banner.png" margin="0" width="100%" border="none">
        <form class="form-signin" action="backend/login" method="POST" role="form">
            <h2 class="form-signin-heading">Por favor inicie sesión</h2>
            <input type="text" class="form-control" name="username" placeholder="Usuario" required autofocus>
            <?php echo form_error('username'); ?>
            <input type="password" class="form-control" name="password" placeholder="Contraseña" required>
            <?php echo form_error('password'); ?>
            <button type="submit" class="btn btn-lg btn-primary btn-block" href="panel.html">Iniciar sesión</button>
        </form>
    </div> <!-- /container -->
</body>
</html>