<div class="container">
	<div class="col-md-4">
		<div class="panel panel-primary">
	      	<div class="panel-heading">
	        	<h3 class="panel-title">Nuevo consejero</h3>
	      	</div>
	      	<div class="panel-body">
	        	<form action="backend/consejeros/crear-consejero" method="POST">
					<div class="form-group">
						<label for="">Nombre</label>
						<input type="text" name="name" value="<?php echo set_value('name'); ?>"/>
						<?php echo form_error('name'); ?>
					</div>
					<div class="form-group">
						<label for="">Apellido</label>
						<input type="text" name="lastname" value="<?php echo set_value('lastname'); ?>"/>
						<?php echo form_error('lastname'); ?>
					</div>
					<div id="counselor" class="form-group" >
				    	<label for="exampleInputPassword1">Tipo de Consejero</label>
				    	<select name="counselor_type_id">
				    		<option value="0">Seleccione</option>
				    		<?php foreach($counselor_type as $key => $value):  ?>
				    			<option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
				    		<?php endforeach; ?>
				    	</select>
				    	<?php echo form_error('counselor_type_id'); ?>
		  			</div>
					<div class="form-group">
						<input class="btn btn-default" type="submit" name="submit" value="Crear"> 
					</div>
				</form>
	      	</div>
	    </div>
	</div>
</div>