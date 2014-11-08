<!DOCTYPE html>
<html lang="es">
	<head>
		<style>
			div
			{
				margin: 0px;
				padding: 0px;
			}
			#roles_consejo
			{
				padding-right: 150px;
				padding-left: 0px;
				padding-top: 5px;
			}
			#comentario 
			{
				border: 1px solid black;
			}
			#consideracion
			{
				padding-bottom: 5px;
			}
			.resumen
			{
				text-align: justify;
			}
			.titulos
			{
				text-decoration: underline;
				padding-left: 5px;
				text-transform: uppercase;
			}
			.centrar
			{
				text-align: center;
			}
			.resolucion
			{
				border: 1px solid black;
				text-align: justify;
			}
			.punto
			{
				padding: 8px;
				margin: 8px;
				text-align: justify;
			}

		</style>
	</head>
	<body>
		<table align="center" width="100%" border="1" id="membrete">
			<tr>
				<td align="center">
					<img src="assets/back/img/logo_uc.png" alt="" width="100px">
					<h4>Reunión: Ordinaria</h4>
				</td>
				<td style="text-align:center;">
					<h3>Acta Nº 003/2012</h3>
					<p>Departamento de Comuputación</p>
					<p>Reunión Nº 003/2012 del Consejo de Departamento</p>
					<p>Fecha: 24/02/2012</p>
					<p>Hora: 3:34 p.m.</p>
					<p>Lugar: Sala de Reuniones Departamento de Computación</p>
				</td>
				<td>
					<img src="assets/back/img/logo_facyt.png" alt="" width="144px">
				</td>
			</tr>	
		</table>
		<br>
		<h4 class="titulos">ASISTENTES:</h4>
		<table id="asistentes" align="center">
			<tr>
				<td align="left" id="roles_consejo">
					<p>Prof. Amadis MARTÍNEZ</p>
					<p>Prof. Francisca GRIMÓN</p>
					<p>Prof. Joel RIVAS</p>
					<p>Prof. Aldo REYES</p>
					<p>Prof. Johana GUERRERO</p>
				</td>
				<td align="left">
					<p>Director(E) - Presidente</p>
					<p>Representante de los Profesores</p>
					<p>Representante de los Profesores</p>
					<p>Representante de los Profesores</p>
					<p>Representante Suplente de los Profesores</p>
				</td>
			</tr>	
		</table>
		<br>
		<div class="consideracion">
			<p>Consideración de las actas Nro. 001-002-003-004 de Consejo Extraordinario y Actas Nro. 001 y 002 del Consejo Ordinario.</p>
			<p id="comentario">Enviar por correo electronico de diez en diez desde la última aprobada.</p>
		</div>
		<?php $categoria = array(
			 1 => "Asuntos Profesorales",
			 2 => "ASUNTOS ESTUDIANTILES",
			 3 => "COORDINACION DE PREPARADORES"
		);
		foreach ($categoria as $key => $cat) { ?>
			<h4 class="titulos centrar"> <?php echo $cat; ?> </h4>
			<table class="categoria">
				<tr>
					<td>
						<?php $punto = array(
					 		"1. Comunicación Nro. DC-013-2012, de fecha 26/01/2012, recibida en esta Secretaría el 27/01/2012, emitido por el <strong>Prof. Amadis Martínez - Director(E)</strong> remitiendo la Propuesta de Plan de Desarrollo Académico Permanente del dpto. de Computación."
							=> "Aprobado. Remitir a la dirección de Asuntos Profesorales de la FaCyT.",
							"2. Comunicación S/N de fecha 14/02/2012, recibida en esta Secretaría el 14/02/2012, emitido por la <strong>Prof. Elsa Tovar</strong>, solicitando el plan de aprobación de pasantía de la Br. Gabriela Sánchez, C.I. V-20.082.517" => 
							"Aprobado el plan de trabajo de pasantía. Informar a la tutor y a la Br."
						); ?>
						<?php foreach ($punto as $res => $resol){ ?>
							<table class="punto" cellspacing="0" cellpadding="0">
								<tr>
									<tr>
										<td>
											<p> <?php echo $res; ?></p>
										</td>	
									</tr>
									<tr>
										<td>
											<p class="resolucion"><strong>Resolución:</strong> <?php echo $resol; ?> </p>
										</td>
									</tr>
								</tr>
							</table >
						<?php } ?>
					</td>	
				</tr>	
			</table>
		<?php } ?>
	</body>
</html>