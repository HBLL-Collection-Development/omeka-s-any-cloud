<?php

namespace AnyCloud;

return [
    'view_manager' => [
        'template_path_stack' => [
            dirname(__DIR__) . '/view',
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
            'anycloud_adapter' => 'default',
            'anycloud_aws_key' => null,
            'anycloud_aws_secret_key' => null,
            'anycloud_aws_bucket' => null,
            'anycloud_aws_region' => null,
            'anycloud_aws_endpoint' => null, // can leave blank unless you have set up custom endpoint URLs
            'anycloud_digital_ocean_key' => null,
            'anycloud_digital_ocean_secret_key' => null,
            'anycloud_digital_ocean_bucket' => null,
            'anycloud_digital_ocean_region' => null,
            'anycloud_digital_ocean_endpoint' => null, // can leave blank unless you have set up custom endpoint URLs
            'anycloud_scaleway_object_storage_key' => null,
            'anycloud_scaleway_object_storage_secret_key' => null,
            'anycloud_scaleway_object_storage_bucket' => null,
            'anycloud_scaleway_object_storage_region' => null,
            'anycloud_scaleway_object_storage_endpoint' => null, // can leave blank unless you have set up custom endpoint URLs
            'anycloud_azure_account_name' => null,
            'anycloud_azure_account_key' => null,
            'anycloud_azure_container_name' => null,
            'anycloud_azure_endpoint' => null, // can leave blank unless you have set up custom endpoint URLs
            'anycloud_rackspace_identity_endpoint' => null,
            'anycloud_rackspace_username' => null,
            'anycloud_rackspace_password' => null,
            'anycloud_rackspace_container' => null,
            'anycloud_rackspace_region' => null,
            'anycloud_dropbox_access_token' => null,
            'anycloud_google_project_id' => null,
            'anycloud_google_bucket_name' => null,
            'anycloud_google_credentials_path' => '/src/Service/File/Adapter/Google/{CONFIG}.json',
            'anycloud_google_storage_uri' => 'https://storage.googleapis.com',
        ],
    ],
];
