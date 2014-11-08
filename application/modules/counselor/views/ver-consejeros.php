<div class="container">
	<div class="col-md-12">
		<div class="panel panel-primary">
	    	<div class="panel-heading">
	        	<h3 class="panel-title">Consejeros</h3>
	      	</div>
	      	<div class="panel-body">
	        	<?php if(!empty($consejeros)): ?>
					<table class="table table-bordered">
				      	<thead>
				        	<tr>
					          	<th>Nombre</th>
					          	<th>Apellido</th>
					          	<th>Tipo</th>
					          	<th></th> <!--Ver consejos en los que ha estado el consejero-->
					          	<th></th>
					        	<th></th>
				        	</tr>
				      	</thead>
				      	<tbody>
				       	<?php foreach ($consejeros as $key => $value): ?>
				       		 <tr>
						        <td><?php echo $value['name']; ?></td>
						        <td><?php echo $value['lastname']; ?></td>
						        <td><?php echo $value['counselor_type_id']; ?></td>
						 		<td><a href=""></a>Consejos</td>
						        <!--<td><a href="backend/solicitantes/actualizar/<?php echo $value['slug']; ?>">Actualizar</a></td>
						        <td><a href="backend/solicitantes/eliminar/<?php echo $value['slug']; ?>">Eliminar</a></td>-->
					        </tr>
				       	<?php endforeach; ?>
				     	</tbody>
					</table>
				<?php else: ?>
					<h3>No hay consejeros.</h3>
				<?php endif; ?>
	      	</div>
	    </div>
	</div>
</div>
