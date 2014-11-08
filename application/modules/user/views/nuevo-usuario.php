<div class="container">
	<div class="col-md-6">
		<div class="panel panel-primary">
	      <div class="panel-heading">
	        <h3 class="panel-title">Nuevo usuario o solicitante</h3>
	      </div>
	      <div class="panel-body">
	        <form role="form" action="backend/usuarios/crear-usuario" method="POST">
				<div class="form-group">
			    	<label for="exampleInputEmail1">Nombre</label>
			    	<input type="text" class="form-control" name="name" placeholder="Nombre y apellido">
			    	<?php echo form_error('name'); ?>
			  	</div>
			  	<div class="form-group">
			    	<label for="exampleInputPassword1">Cedula</label>
			    	<input type="cedula" class="form-control" name="cedula" placeholder="Cedula">
			    	<?php echo form_error('cedula'); ?>
			  	</div>
			  	<div class="form-group">
			    	<label for="exampleInputPassword1">Usuario</label>
			    	<input type="text" class="form-control" name="username" placeholder="Usuario">
			    	<?php echo form_error('username'); ?>
			  	</div>
			  	<div class="form-group">
			    	<label for="exampleInputPassword1">Correo electronico</label>
			    	<input type="email" class="form-control" name="email" placeholder="Correo electrónico">
			    	<?php echo form_error('email'); ?>
			  	</div>
			  	<div class="form-group">
			    	<label for="exampleInputPassword1">Contraseña</label>
			    	<input type="password" class="form-control" name="password" placeholder="Cotraseña">
			    	<?php echo form_error('password'); ?>
			  	</div>
			  	<div class="form-group">
			    	<label for="exampleInputPassword1">Repita la contraseña</label>
			    	<input type="password" class="form-control" name="repassword" placeholder="Repita la contraseña">
			  		<?php echo form_error('repassword'); ?>
			  	</div>
			  	<div class="form-group">
			    	<label for="exampleInputPassword1">Privilegio</label>
			    	<select name="privilege_id">
			    		<option value="">Seleccione el privilegio</option>
			    		<?php foreach($privileges as $privilege => $value):  ?>
			    			<option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
			    		<?php endforeach; ?>
			    	</select>
			    	<?php echo form_error('privilege_id'); ?>
			  	</div>
			  	<button type="submit" class="btn btn-default">Guardar</button>
			</form>
	      </div>
	    </div>
	</div>
</div>
	