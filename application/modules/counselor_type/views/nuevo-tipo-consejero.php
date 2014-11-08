<div class="container">
	<div class="col-md-4">
		<div class="panel panel-primary">
	      	<div class="panel-heading">
	        	<h3 class="panel-title">Nuevo tipo de Consejero</h3>
	      	</div>
	      	<div class="panel-body">
	        	<form action="backend/consejeros/crear-tipo-consejero" method="POST">
					<div class="form-group">
						<label for="">Nombre</label>
						<input type="text" name="name" value="<?php echo set_value('name'); ?>"/>
						<?php echo form_error('name'); ?>
					</div>
					<input class="btn btn-default" type="submit" name="submit" value="Crear"> 
				</form>
	      	</div>
	    </div>
	</div>
</div>