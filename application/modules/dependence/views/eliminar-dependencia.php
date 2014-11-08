<div class="container">
	<div class="col-md-12">
		<div class="panel panel-danger">
	    	<div class="panel-heading">
	        	<h3 class="panel-title">Eliminar dependencia</h3>
	      	</div>
	      	<div class="panel-body">
	        	<p>
	        		¿Esta seguro que desea eliminar la dependencia <strong><?php echo $dependence['name']; ?></strong>, 
	        		esto podria eliminar todas las informaciones asociadas a esta ?
	        	</p>
				<a class="btn btn-default" href="backend/dependencias">No</a>
				<a class="btn btn-default" href="backend/dependencias/eliminar/<?php echo $dependence['slug']?>">Si</a>
	      	</div>
	    </div>
	</div>
</div>