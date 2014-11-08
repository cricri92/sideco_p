<div class="container">
    <center><h2>Revisar solicitudes</h2></center>
    <div class="col-md-12">
        <h4>Nuevas solicitudes</h4>
        <?php if(isset($requestsRecibidas)): ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Cédula</th>
                        <th>Nombre</th>
                        <th>Tipo</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Estatus</th>
                        <th>Revisión</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($requestsRecibidas as $key => $value):  ?>
                            <td><?php echo $value['id']; ?></td>
                            <td><?php echo $value['nombre']; ?></td>
                            <td><?php echo $value['cedula']; ?></td>
                            <td><?php echo $value['type_request']; ?></td>
                            <td><?php echo $value['date']; ?></td>
                            <td><?php echo substr($value['create_at'], 11)?></td>
                            <td><?php echo $value['status']; ?></td>
                            <td><a href="backend/solicitudes/veredicto/<?php echo $value['id']; ?>">Ver solicitud</a></td>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
    <div class="col-md-12">
        <h4>Solicitudes revisadas</h4>
        <select id="status_id" name="status_id">
            <option value="0">Todas</option>
            <?php foreach($status as $key => $value): ?>
                <option value="<?php echo $value['id']?>"><?php echo $value['name']; ?></option>
            <?php endforeach; ?>
        </select>
        <?php if(isset($requests)): ?>
            <table  class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Cédula</th>
                        <th>Nombre</th>
                        <th>Tipo</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Revisión</th>
                    </tr>
                </thead>
                <tbody id="tabla_body">
                    <?php foreach($requests as $key => $value):  ?>
                        <tr>
                            <td><?php echo $value['id']; ?></td>
                            <td><?php echo $value['cedula']; ?></td>
                            <td><?php echo $value['nombre']; ?></td>
                            <td><?php echo $value['type_request']; ?></td>
                            <td><?php echo $value['date']; ?></td>
                            <td><?php echo substr($value['create_at'], 11)?></td>
                            <td><a href="backend/solicitudes/veredicto/<?php echo $value['id']; ?>">Ver solicitud</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>