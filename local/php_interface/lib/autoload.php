<?php try {
    Bitrix\Main\Loader::registerAutoLoadClasses(null, [
        'Import\Goods' => '/local/php_interface/lib/Import/Goods.php',
        'Auth\BasicAuth' => '/local/php_interface/lib/Auth/BasicAuth.php',
        'Import\Warehouse' => '/local/php_interface/lib/Import/Warehouse.php',
        'Import\Parsing' => '/local/php_interface/lib/Import/Parsing.php',
        'Helpers\ArrayHelper' => '/local/php_interface/lib/Helpers/ArrayHelper.php',
    ]);
} catch (\Bitrix\Main\LoaderException $e) {

}