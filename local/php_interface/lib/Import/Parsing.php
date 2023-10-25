<?php

namespace Import;

use Helpers\ArrayHelper;

class Parsing
{
    public static function process($json)
    {
        $errors = [];
        $array_data = json_decode($json, true);
        foreach ($array_data as $data) {
            $product = Goods::find($data['uuid']);
            if($product['ID'] > 0) {
                Goods::updateQuantities($product['ID'], $data['stocks']);
            } else {
                $errors[] = "Товар с ID ".$data['uuid'].' не найден в системе';
            }
        }
        $success = count($errors)==0;
        $response = ['success' => $success];
        if(!$success)
            $response = ['success' => false, 'errors' => $errors];

        return json_encode($response);

    }
}