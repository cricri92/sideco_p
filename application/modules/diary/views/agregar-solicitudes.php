<div class="container">
    <center><h2>Solicitudes de agenda</h2></center>
    <div class="col-md-12">
        <h4>Solicitudes habilitadas</h4>
        <form role="form" action="backend/agendas/agregar-solicitud" method="POST" >
            <?php if(isset($requests)): ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tipo</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>CI Solicitante</th>
                            <th>Estatus</th>
                            <th>Agregar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($requests as $key => $value):  ?>
                            <tr>
                                <td><?php echo $value['id']; ?></td>
                                <td><?php echo $value['type_request']; ?></td>
                                <td><?php echo $value['date']; ?></td>
                                <td><?php echo substr($value['create_at'], 11)?></td>
                                <td><?php echo $value['cedula']; ?></td>
                                <td><?php echo $value['status']; ?></td>
                                <!-- checked -->
                                <td><input type="radio" name="agregar[]" value="<?php echo $value['id']; ?>"></td>
                                <td><input type="radio" name="eliminar[]" value="<?php echo $value['id']; ?>"></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
            <input type="submit" value="Guardar">
        </form>
    </div>
</div>