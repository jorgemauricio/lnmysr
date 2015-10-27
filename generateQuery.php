<?php
for ($i=1; $i < 33 ; $i++) { 
	echo 'select estaciones.numero, estaciones.nombre, estaciones.estadoid, estaciones.municipioid, estaciones.latitud, estaciones.longitud, estaciones.inicio, estaciones.activa, estado'.$i.'.fecha, estado'.$i.'.prec, estado'.$i.'.temt, estado'.$i.'.dirv, estado'.$i.'.velv, estado'.$i.'.radg, estado'.$i.'.humr, estado'.$i.'.humh, estado'.$i.'.eto  from estaciones inner join estado'.$i.' on estaciones.numero=estado'.$i.'.numero where datediff(minute, estado'.$i.'.fecha, getdate()) between 0 and 14 union <br>';
}
?>