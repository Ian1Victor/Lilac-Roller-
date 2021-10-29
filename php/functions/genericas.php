<?php 
function getBaseURL() {
    $protocol = explode('/', $_SERVER['SERVER_PROTOCOL'])[0];
    $protocol = strtolower($protocol);
    $host = $_SERVER['HTTP_HOST'];
    return $protocol . '://' . $host;
}

function formatToBRL($valor){
    return number_format($valor, 2, ',' , '.');


}