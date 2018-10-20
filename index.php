<?php 
// Comunica con la api de la NASA y obtiene un json con imágenes y datos relativos a la imagen.
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $searchWord = 'moon';
    $restultType = 'image';
    $page = '2';
    
    if (isset($_GET['searchWord'])) {
        $searchWord = $_GET['searchWord'];
    }
    
    if (isset($_GET['restultType'])) {
        $restultType = $_GET['restultType'];
    }

    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    }

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => 'https://images-api.nasa.gov/search?description=' . $searchWord . '&media_type=' . $restultType . '&page=' . $page,
        CURLOPT_USERAGENT => 'Codular Sample cURL Request'
    ));

    $resp = curl_exec($curl);

    curl_close($curl);

    //echo json_encode($resp);
    echo $resp;
}
?>