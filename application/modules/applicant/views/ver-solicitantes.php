<div class="container">
	<div class="col-md-12">
		<div class="panel panel-primary">
	    	<div class="panel-heading">
	        	<h3 class="panel-title">Solicitantes</h3>
	      	</div>
	      	<div class="panel-body">
	        	<?php if(!empty($applicants)): ?>
					<table class="table table-bordered">
				      	<thead>
				        	<tr>
					          	<th>Nombre</th>
					          	<th>Cédula</th>
					          	<th>Correo electrónico</th>
					          	<th>Creada</th>
					          	<th></th>
					        	<th></th>
				        	</tr>
				      	</thead>
				      	<tbody>
				       	<?php foreach ($applicants as $key => $value): ?>
				       		 <tr>
						        <td><?php echo $value['name']; ?></td>
						        <td><?php echo $value['cedula']; ?></td>
						 		<td><?php echo $value['email']; ?></td>
						        <td><?php echo $value['create_at']; ?></td>
						        <td><a href="backend/solicitantes/actualizar/<?php echo $value['slug']; ?>">Actualizar</a></td>
						        <td><a href="backend/solicitantes/eliminar/<?php echo $value['slug']; ?>">Eliminar</a></td>
					        </tr>
				       	<?php endforeach; ?>
				     	</tbody>
					</table>
				<?php else: ?>
					<h3>No hay solicitantes.</h3>
				<?php endif; ?>
	      	</div>
	    </div>
	</div>
</div>
