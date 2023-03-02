<?php

defined('BOOTSTRAP') or die('Access denied');

$schema['/ecl_instagram_update'] = array(
    'dispatch' => 'ecl_instagram.update'
);

return $schema;