<?php 
require 'gestionDatabase.php';

$busqueda = 'earth';

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'http://localhost/api_fotos_nasa/index.php?searchWord=' . $busqueda . '&restultType=image&page=1',
    CURLOPT_USERAGENT => 'Codular Sample cURL Request'
));

$resp = curl_exec($curl);

curl_close($curl);

$data = json_decode($resp);

foreach ($data->collection->items as $element) {
    $object = json_decode(json_encode($element));

    foreach ($object->links as $fin) {
        $urlImagenNASA = $fin->href;
        
        $posInicioId = strpos($urlImagenNASA, 'image/') + 6;
        $idImagen = substr($urlImagenNASA, $posInicioId);
        $posFinId = strpos($idImagen, '/');
        $idImagen = substr($idImagen, 0, $posFinId);
        $nombreImagen = $idImagen . '.jpg';
        $rutaCompleta = 'Images/' . $nombreImagen;

        file_put_contents($rutaCompleta, file_get_contents($urlImagenNASA));

        $consulta = "INSERT INTO imagen (idNASA, nombreImagen, rutaCompleta, urlImagenNASA) VALUES (" . 
            "'$idImagen', '$nombreImagen', '$rutaCompleta', '$urlImagenNASA'" .
            ")";

        $comando = Database::getInstance()->getDb()->prepare($consulta);
		$comando -> execute();
    }

    foreach($object->data as $fin) {
        $nasa_id = $fin->nasa_id;
        $descImagen = $fin->description;
        $descImagen = str_replace("'", "´", $descImagen);
        $tipo = $busqueda;
        $titulo = $fin->title;
        $titulo = str_replace("'", "´", $titulo);
        $fotografo = 'Unknown';

        if (isset($fin->photographer)) {
            $fotografo = $fin->photographer;
        }

        $consulta = "UPDATE imagen SET " .
            "descImagen = '$descImagen', tipo = '$tipo', tituloImagen = '$titulo', fotografo = '$fotografo' " .
            "WHERE idNASA = '$nasa_id'";

        $comando = Database::getInstance()->getDb()->prepare($consulta);
		$comando -> execute();
    }
}
?>