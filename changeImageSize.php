<?php
// Recorre todas las imágenes sin procesar de la base de datos y les cambia el tamaño recortándolas

require 'gestionDatabase.php';
require 'imageResize.php';

$consulta = "SELECT * FROM imagen WHERE procesada = 0 LIMIT 500";

try {
    $comando = Database::getInstance()->getDb()->prepare($consulta);
    $comando -> execute();
    
    while($row = $comando->fetch( PDO::FETCH_ASSOC )){ 
        $filename = $row['rutaCompleta'];   
        $idFila = $row['Id'];
        
        $image = new \Gumlet\ImageResize($filename);
        $image->crop(300, 300);
        $image->save($filename);

        $consulta2 = "UPDATE imagen SET procesada = 1 WHERE Id = '$idFila'";

        $comando2 = Database::getInstance()->getDb()->prepare($consulta2);
        $comando2 -> execute();
    }
} catch (PDOException $e) {		
    echo $e . '<br>';
    return 0;
}
?>