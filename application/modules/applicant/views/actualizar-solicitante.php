<div class="container">
	<div class="col-md-6">
		<div class="panel panel-primary">
	      <div class="panel-heading">
	        <h3 class="panel-title">Actualizar solicitante</h3>
	      </div>
	      <div class="panel-body">
	        <form role="form" action="backend/solicitantes/actualizar-solicitante" method="POST">
	        	<input type="hidden" name="applicant_id" value="<?php echo $applicant['id']; ?>"/>
				<div class="form-group">
			    	<label for="exampleInputPassword1">Tipo solicitante</label>
			    	<select id="type_applicant_id" name="type_applicant_id">
			    		<?php foreach($typeApplicant as $key => $value):  ?>
			    			<?php if($value['id'] == $applicant['type_applicant_id']): ?>
								<option value="<?php echo $value['id']; ?>" selected><?php echo $value['name']; ?></option>
			    			<?php else: ?>
								<option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
			    			<?php endif; ?>
			    		<?php endforeach; ?>
			    	</select>
			    	<?php echo form_error('type_applicant_id'); ?>
			  	</div>
			  	
			  	<div id="dependence" class="form-group" >
			    	<label for="exampleInputPassword1">Dependencia</label>
			    	<select name="dependence_id">
			    		<?php foreach($dependences as $key => $value):  ?>
			    			<?php if($value['id'] == $applicant['dependence_id']): ?>
								<option value="<?php echo $value['id']; ?>" selected><?php echo $value['name']; ?></option>
							<?php else: ?>
								<option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
			    			<?php endif; ?>
			    		<?php endforeach; ?>
			    	</select>
			    	<?php echo form_error('dependence_id'); ?>
			  	</div>
			  	
				<div class="form-group">
			    	<label for="exampleInputEmail1">Nombre</label>
			    	<input type="text" class="form-control" name="name" placeholder="Nombre y apellido" value="<?php echo $applicant['name']; ?>">
			    	<?php echo form_error('name'); ?>
			  	</div>
			  	<div class="form-group">
			    	<label for="exampleInputPassword1">Cedula</label>
			    	<input type="text" class="form-control" name="cedula" placeholder="Cedula" value="<?php echo $applicant['cedula']; ?>">
			    	<?php echo form_error('cedula'); ?>
			  	</div>
			   	<div class="form-group">
			    	<label for="exampleInputPassword1">Correo electronico</label>
			    	<input type="email" class="form-control" name="email" placeholder="Correo electrónico" value="<?php echo $applicant['email']; ?>">
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
			  	<button type="submit" class="btn btn-default">Actualizar</button>
			</form>
	      </div>
	    </div>
	</div>
</div>
	