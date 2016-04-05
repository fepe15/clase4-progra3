<?php

/*	1- si es un ingreso lo guardo en ticket.txt
 	2- si es salida leo el archivo:
 	leer del archivo todos los datos, guardarlos en un array
	si la patente existe en el archivo .
	 sobreescribo el archivo con todas las patentes
	 y su horario si la patente solicitada
	... calculo el costo de estacionamiento a 
	20$ el segundo y lo muestro.
	si la patente no existe mostrar mensaje y 
	el boton que me redirija al index  
	3- guardar todo lo facturado en facturado.txt*/


/* var_dump($_POST['estacionar']); */

$accion=$_POST["estacionar"];
$patente=$_POST["patente"];
$ahora=date("y-m-d h:y:s");
$listadeautos=array();
$listaaux=array();

if ($accion=="ingreso") {
	echo "Se guardo la patente: $patente";
	$archivo=fopen("ticket.txt", "a"); //crea el archivo en la raiz 
	fwrite($archivo, $patente. "|".$ahora. PHP_EOL); // escribe el archivo con los datos que ingreso el usuario
	fclose($archivo); // cierra el archivo
}
else
{
	$archivo=fopen("ticket.txt", "r");
	while (!feof($archivo)) { //lee el archivo hasta el final
		$renglon=fgets($archivo);
		$auto=explode("|", $renglon); // devuelve un array con la patente y la fecha con el delimitado que yo seleccione que es ""|"" 
		$listadeautos[]=$auto;
	}
	//var_dump($listadeautos);
	fclose($archivo);
	$esta=false;
		foreach ($listadeautos as $auto) 
	{
		if ($auto[0] == $patente) 
		{
			$esta=true;
			$fechainicio=$auto[1];
			$diferencia=strtotime($ahora)-strtotime($fechainicio);
			echo "el tiempo transcurrido es $diferencia";
		}
		else
		{
			if ($auto[0] != "") {
				$listaaux[]=$auto;
			}


		}

	}
		if ($esta) 
		{
			echo "el auto esta";
			$archivo=fopen("ticket.txt", "w");
			foreach ($listaaux as $auto) 
			{
				fwrite($archivo, $auto[0]. "|". $auto[1] . PHP_EOL);	
				}
			fclose($archivo);
		}
		else
		{
			echo "el auto no esta";
		}
		
}


?>
<br>
<br>
<a href="index.php">volver</a>
