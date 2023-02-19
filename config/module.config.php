<?php

namespace AnyCloud;

return [
    'view_manager' => [
        'template_path_stack' => [
            dirname(__DIR__).'/view',
        ],
    ],
    'form_elements' => [
        'factories' => [
            Form\ConfigForm::class => Service\Form\ConfigFormFactory::class,
        ],
    ],
    'service_manager' => [
        'factories' => [
            File\Store\AnyCloud::class => Service\File\Store\AnyCloudFactory::class,
        ],
    ],
    'anycloud' => [
        'config' => [
            'anycloud_adapter'       => ['adapter' => 'default'],
            'anycloud_aws'           => [],
            'anycloud_wasabi'        => [],
            'anycloud_digital_ocean' => [],
            'anycloud_scaleway'      => [],
            'anycloud_azure'         => [],
            'anycloud_dropbox'       => [],
            'anycloud_google'        => [
                'google_credentials_path' => '/src/Service/File/Adapter/Google/{CONFIG}.json',
                'google_storage_uri'      => 'https://storage.googleapis.com',
            ],
        ],
    ],
];
