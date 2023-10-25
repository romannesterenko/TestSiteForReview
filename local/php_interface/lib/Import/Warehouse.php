<?php

namespace Import;

class Warehouse
{
    public static function getAll():array {
        $rsStore = \Bitrix\Catalog\StoreTable::getList([
                'filter' => ['ACTIVE'>='Y']
        ]);
        $array = [];
        while($arStore=$rsStore->fetch()) {
            $array[] = $arStore;
        }

        return $array;
    }
    public static function find($storeId) {
        return \Bitrix\Catalog\StoreTable::getById($storeId)->fetch();
    }

    public static function isExists($uuid):bool
    {
        $stock = self::find($uuid);
        return $stock['ID']>0;
    }
}