<div class="container">
	<div class="col-md-12">
		<div class="panel panel-primary">
	    	<div class="panel-heading">
	        	<h3 class="panel-title">Usuarios y/o solicitantes</h3>
	      	</div>
	      	<div class="panel-body">
	        	<?php if(!empty($users)): ?>
					<table class="table table-bordered">
				      	<thead>
				        	<tr>
					          	<th>Usuario</th>
					          	<th>Nombre</th>
					          	<th>Correo electrónico</th>
					          	<th>Privilegio</th>
					          	<th>Creada</th>
					          	<th></th>
					        	<th></th>
				        	</tr>
				      	</thead>
				      	<tbody>
				       	<?php foreach ($users as $key => $value): ?>
				       		 <tr>
						        <td><?php echo $value['username']; ?></td>
						        <td><?php echo $value['name']; ?></td>
						 		<td><?php echo $value['email']; ?></td>
						        <td><?php echo $value['privilege']; ?></td>
						        <td><?php echo $value['create_at']; ?></td>
						        <td><a href="backend/usuarios/actualizar/<?php echo $value['slug']; ?>">Actualizar</a></td>
						        <td><a href="backend/usuarios/eliminar/<?php echo $value['slug']; ?>">Eliminar</a></td>
					        </tr>
				       	<?php endforeach; ?>
				     	</tbody>
					</table>
				<?php else: ?>
					<h3>No hay usuarios.</h3>
				<?php endif; ?>
	      	</div>
	    </div>
	</div>
</div>


<div class="col-md-12">
	
</div>