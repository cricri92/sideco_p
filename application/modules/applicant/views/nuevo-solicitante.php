<div class="container">
	<div class="col-md-6">
		<div class="panel panel-primary">
	      <div class="panel-heading">
	        <h3 class="panel-title">Nuevo solicitante</h3>
	      </div>
	      <div class="panel-body">
	        <form role="form" action="backend/solicitantes/crear-solicitante" method="POST">
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
			  	<button type="submit" class="btn btn-default">Guardar</button>
			</form>
	      </div>
	    </div>
	</div>
</div>
	