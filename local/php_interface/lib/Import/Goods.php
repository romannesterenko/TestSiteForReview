<?php

namespace Import;

use Helpers\ArrayHelper;

class Goods
{

    public static function find(mixed $uuid)
    {
        return \CCatalogProduct::GetByID($uuid);
    }

    public static function updateQuantities($product_id, $stocks): void
    {
        foreach ($stocks as $stock_info){
            if((int)$stock_info['quantity']>0) {
                if (Warehouse::isExists($stock_info['uuid'])) {
                    self::setQuantityToStock($product_id, $stock_info['uuid'], (int)$stock_info['quantity']);
                } else {
                    self::setCommonQuantity($product_id, (int)$stock_info['quantity']);
                }
            }
        }
    }

    private static function setQuantityToStock($product_id, $stock_id, $quantity): void
    {
        $rsStore = \CCatalogStoreProduct::GetList(array(), array('PRODUCT_ID' =>$product_id, 'STORE_ID' => $stock_id), false, false, ['ID', 'AMOUNT']);
        if ($arStore = $rsStore->Fetch()){
            if($arStore['ID']>0) {
                \CCatalogStoreProduct::Update($arStore['ID'], [
                    "PRODUCT_ID" => $product_id,
                    "STORE_ID" => $stock_id,
                    "AMOUNT" => $quantity,
                ]);
            }
        }
    }

    private static function setCommonQuantity($product_id, $quantity): void
    {
        $product = self::find($product_id);
        $new_quantity = (int)$product['QUANTITY'] + $quantity;
        if($product['ID']>0 && $new_quantity>0) {
            \CCatalogProduct::Update($product_id, ['QUANTITY' => $new_quantity]);
        }
    }
}