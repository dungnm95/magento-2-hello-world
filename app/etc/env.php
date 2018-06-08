<?php
return [
  'backend' => [
    'frontName' => 'admin'
  ],
  'crypt' => [
    'key' => '9659c395508c60bd4ec49955f1050748'
  ],
  'db' => [
    'table_prefix' => '',
    'connection' => [
      'default' => [
        'host' => 'localhost',
        'dbname' => 'magento24',
        'username' => 'root',
        'password' => '1',
        'active' => '1'
      ]
    ]
  ],
  'resource' => [
    'default_setup' => [
      'connection' => 'default'
    ]
  ],
  'x-frame-options' => 'SAMEORIGIN',
  'MAGE_MODE' => 'developer',
  'session' => [
    'save' => 'files'
  ],
  'cache_types' => [
    'config' => 1,
    'layout' => 1,
    'block_html' => 1,
    'collections' => 1,
    'reflection' => 1,
    'db_ddl' => 1,
    'eav' => 1,
    'customer_notification' => 1,
    'config_integration' => 1,
    'config_integration_api' => 1,
    'full_page' => 1,
    'translate' => 1,
    'config_webservice' => 1
  ],
  'install' => [
    'date' => 'Thu, 07 Jun 2018 04:53:16 +0000'
  ]
];
