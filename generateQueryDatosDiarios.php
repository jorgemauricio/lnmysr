<?php
for ($i=1; $i < 33 ; $i++) { 
	echo 'select estaciones.numero, estaciones.nombre, estaciones.estadoid, estaciones.municipioid, estaciones.latitud, estaciones.longitud, estaciones.inicio, estaciones.activa, estado'.$i.'diarios.fecha, estado'.$i.'diarios.prec, estado'.$i.'diarios.tmax, estado'.$i.'diarios.tmin, estado'.$i.'diarios.tmed, estado'.$i.'diarios.velvmax, estado'.$i.'diarios.velv, estado'.$i.'diarios.dirvvmax, estado'.$i.'diarios.dirv, estado'.$i.'diarios.radg, estado'.$i.'diarios.humr, estado'.$i.'diarios.humr, estado'.$i.'diarios.et, estado'.$i.'diarios.ep from estaciones inner join estado'.$i.'diarios on estaciones.numero=estado'.$i.'diarios.numero where datediff(day, estado'.$i.'diarios.fecha, getdate()) between 0 and 1 union<br>';
}
?>