<?php

$schema['export_fields']['Details'] = [
            'table'       => 'product_descriptions',
            'db_field'    => 'details',
            'multilang'   => true,
            'process_get' => ['fn_export_product_descr', '#key', '#this', '#lang_code', 'details'],
            'process_put' => ['fn_import_product_descr', '#this', '#key', 'details'],
        ];

return $schema;

