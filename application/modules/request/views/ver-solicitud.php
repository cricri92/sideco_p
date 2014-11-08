<br/>
<div class="col-md-6">
	<div class="panel panel-primary">
	   	<div class="panel-heading">
	  		<h3 class="panel-title">Solicitud #<?php echo $request['id']; ?></h3>
	   	</div>
	    <div class="panel-body">
	  		<form role="form" action="backend/solicitudes/dar-veredicto" method="POST">
	  			<input type="hidden" name="request_id" value="<?php echo $request['id']; ?>">
				<input type="hidden" name="status_id" value="5">
				<div class="form-group">
					<label for="exampleInputPassword1">Nombre:</label>
					<p><?php echo $request['name']; ?></p>
				</div>
				<div class="form-group">
			    	<label for="exampleInputPassword1">Cédula:</label>
					<p><?php echo $request['cedula']; ?></p>
			  	</div>
			  	<div class="form-group">
			  		<label for="exampleInputPassword1">En rol de:</label>
					<p><?php echo $request['role']; ?></p>
			  	</div>
			  	<div class="form-group">
			    	<label for="exampleInputPassword1">Tipo de Solicitud:</label>
					<p><?php echo $request['type_request']; ?></p>
			  	</div>
			  	<div class="form-group">
			  		<label for="exampleInputPassword1">Proveniente de Dependencia:</label>
					<p><?php echo $request['dependence']; ?></p>
			  	</div>
			  	<div class="form-group">
			    	<label><strong>Descripcion: </strong></label>
			    	<p><?php echo $request['description']; ?></p>
			  	</div>
			  	<div class="form-group">
			  		Adjuntos...
			  	</div>
			  	<div class="form-group">
			  		<label for="exampleInputPassword1">Veredicto:</label> <br>
			    	<p><input type="radio" name="option" value="agenda"> Agregar a la Agenda</p>
					<p><input type="radio" name="option" value="rechazar"> Descartar</p>
			  	</div>
			  	<button type="submit" class="btn btn-default">Guardar</button>
			</form>
	    </div>
	</div>
	
</div>