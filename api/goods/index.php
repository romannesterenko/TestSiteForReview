<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$auth_result = \Auth\BasicAuth::check();
if(!$auth_result['success']){
    header('HTTP/1.0 401 Unauthorized');
    echo json_encode($auth_result);
    exit;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $requestData = file_get_contents('php://input');
    echo \Import\Parsing::process($requestData);
} else {
    echo json_encode(["success" => false, "errors" => ["Invalid request method"]]);
}