<br/>
<div class="col-md-6">
	<div class="panel panel-primary">
	   	<div class="panel-heading">
	  		<h3 class="panel-title">Nueva agenda</h3>
	   	</div>
	    <div class="panel-body">
	  		<form role="form" action="backend/agendas/crear-agenda" method="POST" >
				<input type="hidden" name="status_id" value="5">
				<div class="form-group">
			    	<label for="exampleInputEmail1">Numero de acta</label>
			    	<input type="text" name="num_acta"></input>
			    	<?php echo form_error('num_acta'); ?>
			  	</div>
			  	<!--
				<div class="form-group">
			    	<label for="exampleInputPassword1">Fecha</label>
			    	<input type="text" name="date" value="<?php echo date('')?>"></input>
			    	<?php echo form_error('type_request_id'); ?>
			  	</div>
			  	-->
				<div class="form-group">
			    	<label for="exampleInputEmail1">Consideración</label>
			    	<textarea name="consideration"><?php echo set_value('consideration'); ?></textarea>
			    	<?php echo form_error('consideration'); ?>
			  	</div>
			  	
			  	<button type="submit" class="btn btn-default">Guardar</button>
			</form>
	    </div>
	</div>
	
</div>