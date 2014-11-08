<div class="container">
	<div class="col-md-6">
		<div class="panel panel-primary">
		 	<div class="panel-heading">
		    	<h3 class="panel-title">Actualizar información de usuario</h3>
		   	</div>
		   	<div class="panel-body">
		   		<form role="form" action="backend/usuarios/actualizar-usuario" method="POST">
					<input type="hidden" class="form-control" name="user_id" value="<?php echo $user['id'];?>">
					<div class="form-group">
				    	<label for="exampleInputEmail1">Nombre</label>
				    	<?php if(!empty(set_value('name'))):?>
				    		<input type="text" class="form-control" name="name" placeholder="Nombre y apellido" value="<?php echo set_value('name'); ?>">
				    	<?php else: ?>
							<input type="text" class="form-control" name="name" placeholder="Nombre y apellido" value="<?php echo $user['name']; ?>">
				    	<?php endif; ?>
				    	<?php echo form_error('name'); ?>
				  	</div>
				  	<div class="form-group">
				    	<label for="exampleInputPassword1">Usuario</label>
				    	<?php if(!empty(set_value('username'))):?>
				    		<input type="text" class="form-control" name="username" placeholder="Usuario" value="<?php echo set_value('username');?>">
				    	<?php else: ?>
							<input type="text" class="form-control" name="username" placeholder="Usuario" value="<?php echo $user['username'];?>">
				    	<?php endif; ?>
				    	
				    	<?php echo form_error('username'); ?>
				  	</div>
				  	<div class="form-group">
				    	<label for="exampleInputPassword1">Email</label>
				    	<?php if(!empty(set_value('email'))):?>
				    		<input type="email" class="form-control" name="email" placeholder="Correo electrónico" value="<?php echo set_value('email');?>">
				    	<?php else: ?>
							<input type="email" class="form-control" name="email" placeholder="Usuario" value="<?php echo $user['email'];?>">
				    	<?php endif; ?>
				    	<?php echo form_error('email'); ?>
				  	</div>
				  	<div class="form-group">
				    	<label for="exampleInputPassword1">Contraseña</label>
				    	<input type="password" class="form-control" name="password" placeholder="Contraseña">
				    	<?php echo form_error('password'); ?>
				  	</div>
				  	<div class="form-group">
				    	<label for="exampleInputPassword1">Repita la contraseña</label>
				    	<input type="password" class="form-control" name="repassword" placeholder="Repita la contraseña">
				  		<?php echo form_error('repassword'); ?>
				  	</div>
				  	<?php if($userData['privilege_id'] == 1): ?>
					  	<div class="form-group">
					    	<label for="exampleInputPassword1">Privilegio</label>
					    	<select name="privilege_id">
					    		<?php foreach($privileges as $privilege => $value):  ?>
					    			<?php if($value['id'] == $user['privilege_id']): ?>
						    			<option value="<?php echo $value['id']; ?>" selected><?php echo $value['name']; ?></option>
						    		<?php else: ?>
						    			<option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
						    		<?php endif; ?>
					    		<?php endforeach; ?>
					    	</select>
					    	<?php echo form_error('privilege_id'); ?>
					  	</div>
				  	<?php else: ?>
				  		<div class="form-group">
					    	<label for="exampleInputPassword1">Privilegio</label>
					    	<select disabled="disabled">
					    		<?php foreach($privileges as $privilege => $value):  ?>
					    			<?php if($user['privilege_id'] == $value['id']): ?>
					    				<?php if($value['id'] == $user['privilege_id']): ?>
						    				<option value="<?php echo $value['id']; ?>" selected><?php echo $value['name']; ?></option>
						    			<?php endif; ?>
					    			<?php endif; ?>
					    		<?php endforeach; ?>
					    	</select>
					    	<input type="hidden" name="privilege_id" value="<?php echo $user['privilege_id']; ?>" readonly>
					    	<?php echo form_error('privilege_id'); ?>
					  	</div>
				  	<?php endif; ?>
				  	<button type="submit" class="btn btn-default">Actualizar</button>
				</form>
		    </div>
		</div>
	</div>
</div>