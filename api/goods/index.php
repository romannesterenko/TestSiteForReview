<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$auth_result = \Auth\BasicAuth::check();
if(!$auth_result['success']){
    header('HTTP/1.0 401 Unauthorized');
    echo json_encode($auth_result);
    exit;
}
$json = '[
    {
        "uuid": "317",
        "stocks": [
            {
                "uuid": 1,
                "quantity":10000
            },
            {
                "uuid": 2,
                "quantity":100
            },
            {
                "uuid": 32,
                "quantity":90001
            }
        ]
    }                    
]';
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    echo \Import\Parsing::process($json);
} else {
    echo json_encode(["success" => false, "errors" => ["Invalid request method"]]);
}