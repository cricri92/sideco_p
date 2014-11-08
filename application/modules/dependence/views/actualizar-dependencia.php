<div class="container">
	<div class="col-md-4">
		<div class="panel panel-primary">
	      	<div class="panel-heading">
	        	<h3 class="panel-title">Actualizar dependencia</h3>
	      	</div>
	      	<div class="panel-body">
	        	<form action="backend/dependencias/actualizar" method="POST">
	        		<input type="hidden" name="dependence_id" value="<?php echo $dependence['id']; ?>">
					<div class="form-group">
						<label for="">Nombre</label>
						<input type="text" name="name" value="<?php echo $dependence['name']; ?>"/>
						<?php echo form_error('name'); ?>
					</div>
					<input class="btn btn-default" type="submit" name="submit" value="Actualizar"> 
				</form>
	      	</div>
	    </div>
	</div>
</div>