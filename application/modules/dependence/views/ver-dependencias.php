<?php $i = 1; ?>
<div class="container">
    <div class="col-md-12">
        <h4>Dependencias</h4>
        <?php if(isset($dependences) && !empty($dependences)): ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Creado</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($dependences as $key => $value):  ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $value['name']; ?></td>
                            <td><?php echo $value['slug']; ?></td>
                            <td><?php echo substr($value['create_at'], 11)?></td>
                            <td><a href="backend/dependencias/actualizar/<?php echo $value['slug']; ?>">Actualizar</a></td>
                            <td><a href="backend/dependencias/eliminar-dependencia/<?php echo $value['slug']; ?>">Eliminar</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-info" role="alert">
                Lo sentimos no existen dependencias a mostrar.
            </div>
        <?php endif; ?>
    </div>
</div>