<?php $i = 1; ?>
<div class="container">
    <div class="col-md-12">
        <div class="alert alert-info" role="alert">
            Bienvenido <?php echo $userData['name']." ".date("Y-m-d H:i:s"); ?>
        </div>
        <center>
            <div id="opciones">
                <?php if(isset($message) && !empty($message)): ?>
                  <p><?php echo $message; ?></p>
                <?php endif; ?>

                <div class="col-md-12 sidebar-offcanvas" role="navigation">
                    <div class="list-group">
                        <a href="solicitudes.html" class="list-group-item active"><span class="glyphicon glyphicon-list-alt"></span><strong> Ultimas diez(10) solicitudes.</strong></a>
                        <?php if(isset($solicitudes10)): ?>
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
                                  <?php foreach($solicitudes10 as $key => $value):  ?>
                                      <tr>
                                          <td><?php echo $i++; ?></td>
                                          <td><?php echo $value['cedula']; ?></td>
                                          <td><?php echo $value['nombre']; ?></td>
                                          <td><?php echo $value['type_request']; ?></td>
                                          <td><?php echo $value['date']; ?></td>
                                          <td><?php echo substr($value['create_at'], 11)?></td>
                                          <td><?php echo $value['status']; ?></td>
                                          <td><a href="backend/solicitudes/veredicto/<?php echo $value['id']; ?>">Ver solicitud</a></td>
                                      </tr>
                                  <?php endforeach; ?>
                              </tbody>
                          </table>
                        <?php endif; ?>
                    </div>
                </div>
            </div> 
        </center>
    </div>
</div>


