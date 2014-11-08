<div class="container">
	<div class="col-md-6">
		<div class="panel panel-primary">
		   	<div class="panel-heading">
		  		<h3 class="panel-title">Nueva solicitud</h3>
		   	</div>
		    <div class="panel-body">
		    	<form role="form" action="backend/solicitudes/crear-solicitud" method="POST" enctype="multipart/form-data">
					<div class="form-group">
				    	<label for="exampleInputPassword1">Rol</label>
				    	<select class="form-control" id="type_applicant_id" name="type_applicant_id">
				    		<option value="">Seleccione</option>
				    		<?php foreach($typeApplicant as $key => $value):  ?>
				    			<option value="<?php echo $value['id']; ?>"> <?php echo $value['name']; ?> </option>
				    		<?php endforeach; ?>
				    	</select>
						    <?php echo form_error('type_applicant_id'); ?>
				  	</div>
				  	<div class="form-group" >
				    	<label for="exampleInputPassword1">Dependencia</label>
				    	<select class="form-control" name="dependence_id" id="dependence_id">
				    		<option value="">Seleccione</option>
				    		<?php foreach($dependences as $key => $value):  ?>
				    			<option value= <"?php echo $value['id']; ?>"> <?php echo $value['name']; ?> </option>
				    		<?php endforeach; ?>
				    	</select>
			    			<?php echo form_error('dependence_id'); ?>
			  		</div>
					<input type="hidden" name="status_id" value="5">
					<div class="form-group">
						<label for="exampleInputEmail1" class="control-label">Nombre</label>
						<input class="form-control" name="nombre">
						<?php echo form_error('nombre') ?>
					</div>
					<div class="form-group">
				    	<label class="control-label" for="exampleInputEmail1">Cedula</label>
				    	<input class="form-control" name="cedula">
				    	<?php echo form_error('cedula'); ?>
				  	</div>
					<div class="form-group">
				    	<label for="exampleInputPassword1">Tipo de solicitud</label>
			    		<select class="form-control" name="type_request_id">
				    		<option value="">Seleccione</option>
				    		<?php foreach($typeRequest as $key => $value):  ?>
				    			<option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
				    		<?php endforeach; ?>
				    	</select>
					    <?php echo form_error('type_request_id'); ?>
				    </div>
					<div class="form-group">
				    	<label for="exampleInputEmail1">Descripción</label>
				    	<br>
				    	<textarea class="form-control" name="description"><?php echo set_value('description'); ?></textarea>
				    	<?php echo form_error('description'); ?>
				  	</div>
				  	<div class="form-group">
	                    <label class="">Adjuntos</label>
	                     <div class="">
	                        <input id="adjuntos" type="file" class="form-control" name="attachment[]" value="<?php echo set_value('attachment'); ?>" multiple/>
	                        <?php echo form_error('attachment'); ?>
	                    </div>
	                </div>
				  	
				  	<button type="submit" class="btn btn-default">Guardar</button>
				</form>
		    </div>
		</div>
	</div>
</div>