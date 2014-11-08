<div class="container">
	<div class="col-md-6">
		<div class="panel panel-primary">
		    <div class="panel-heading">
		        <h3 class="panel-title"> Agregar nuevo tipo de solicitud</h3>
		    </div>
		    <div class="panel-body">
		        <form role="form" action="backend/solicitudes/crear-nuevo-tipo-solicitud" method="POST">
			        <div class="form-group">
			        	<input type="text" class="form-control" name="name" placeholder="Nuevo tipo">
						   	<?php echo form_error('name'); ?>
							<button type="submit" class="btn btn-default btn-group">Guardar</button>
			        </div>
		        </form>
		    </div>
		</div>
	</div>	
</div>
