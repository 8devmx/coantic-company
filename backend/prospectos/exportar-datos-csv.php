<?PHP 
include("../includes/_funciones.php");

	$res = $db->query($_SESSION["sqlSess"])->fetchAll(PDO::FETCH_ASSOC);

	$info = array(); //los datos se guardaran en este arreglo
	foreach($res as $rows){
		$idpros = str_pad($rows['id_pros'], 6, 0, STR_PAD_LEFT);
		$idland = str_pad($rows['idprod_pros'], 6, 0, STR_PAD_LEFT);

			$info[] = array(
				//'id_pros' => "P".$idpros,
				'nom_pros' => $rows["nom_pros"],
				'tel_pros' => $rows["tel_pros"],
				'correo_pros' => $rows["correo_pros"],
				'nom_prod' => $rows["nom_prod"],
				//'empresa_pros' => $rows["empresa_pros"],
				//'proyecto_pros' => $rows["proyecto_pros"],
				//'mensaje_pros' => $rows["mensaje_pros"],
				'fechareg_pros' => $rows["fechareg_pros"],
				//'idprod_pros' => "C".$idland,
				
			); //guardo cada resultado en este arreglo
	}
//print_r(json_encode($info));
	$file = "../../uploads/prospectos_csv/prospectos_".time().".csv"; //le doy un nombre al archivo
	file_put_contents($file, "Nombre, Teléfono, Correo, Interés en, Fecha".PHP_EOL); //creamos el archivo
	for($i = 0; $i < count($info); $i++){

		file_put_contents($file, implode(",", $info[$i]), FILE_APPEND); //escribo en el archivo separando el arreglo con comas
		file_put_contents($file, PHP_EOL, FILE_APPEND); //agrego un salto de linea

	}

	if (file_exists($file)) { //verifico que el archivo haya sido creado
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename='.basename($file));
			header('Content-Transfer-Encoding: binary');
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize($file));
			ob_clean();
			flush();
			readfile($file);
	}else{
		//en caso no se haya creado el archivo, muestro un mensaje
		echo "Hubo un error al momento de crear el archivo, verifique los permisos de las carpetas del servidor.";
	}

?>