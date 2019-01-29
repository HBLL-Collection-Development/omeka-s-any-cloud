<?php
namespace AnyCloud\Form;

use Zend\Form\Element;
use Zend\Form\Form;

class ConfigForm extends Form
{
    public function setSettings($settings)
    {
        $this->settings = $settings;
    }

    public function init()
    {
        $this->add([
            'name' => 'anycloud_adapter',
            'type' => Element\Select::class,
            'options' => [
                'label' => 'Cloud Service Adapter',
                'value_options' => [
                    'default' => 'Omeka Default (local server)',
                    'aws' => 'Amazon S3 Storage',
                    'azure' => 'Microsoft Azure Storage',
                    'digital_ocean' => 'DigitalOcean Spaces',
                    'dropbox' => 'Dropbox',
                    'google' => 'Google Cloud Storage',
                    'rackspace' => 'Rackspace Files',
                    'scaleway_object_storage' => 'Scaleway Object Storage',
                ],
            ],
            'attributes' => [
                'required' => true,
                'id' => 'anycloud_adapter',
            ]
        ]);

        $this->add([
            'name' => 'anycloud_aws_key',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'AWS Key',
            ],
            'attributes' => [
                'required' => true,
                'id' => 'anycloud_aws_key',
            ]
        ]);

        $this->add([
            'name' => 'anycloud_aws_secret_key',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'AWS Secret Key',
            ],
            'attributes' => [
                'required' => true,
                'id' => 'anycloud_aws_secret_key',
            ]
        ]);

        $this->add([
            'name' => 'anycloud_aws_bucket',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'AWS Bucket',
            ],
            'attributes' => [
                'required' => true,
                'id' => 'anycloud_aws_bucket',
            ]
        ]);

        $this->add([
            'name' => 'anycloud_aws_region',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'AWS Region',
            ],
            'attributes' => [
                'required' => true,
                'id' => 'anycloud_aws_region',
            ]
        ]);

        $this->add([
            'name' => 'anycloud_aws_endpoint',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'AWS Endpoint',
                'info' => 'Can usually leave blank unless you have a custom endpoint set up',
            ],
            'attributes' => [
                'required' => false,
                'id' => 'anycloud_aws_endpoint',
            ]
        ]);

        $this->add([
            'name' => 'anycloud__digital_ocean_key',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'DigitalOcean AWS Key',
            ],
            'attributes' => [
                'required' => true,
                'id' => 'anycloud_digital_ocean_key',
            ]
        ]);

        $this->add([
            'name' => 'anycloud_digital_ocean_secret_key',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'DigitalOcean AWS Secret Key',
            ],
            'attributes' => [
                'required' => true,
                'id' => 'anycloud_digital_ocean_secret_key',
            ]
        ]);

        $this->add([
            'name' => 'anycloud_digital_ocean_bucket',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'DigitalOcean AWS Bucket',
            ],
            'attributes' => [
                'required' => true,
                'id' => 'anycloud_digital_ocean_bucket',
            ]
        ]);

        $this->add([
            'name' => 'anycloud_digital_ocean_region',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'DigitalOcean AWS Region',
            ],
            'attributes' => [
                'required' => true,
                'id' => 'anycloud_digital_ocean_region',
            ]
        ]);

        $this->add([
            'name' => 'anycloud_digital_ocean_endpoint',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'DigitalOcean AWS Endpoint'
            ],
            'attributes' => [
                'required' => true,
                'id' => 'anycloud_digital_ocean_endpoint',
            ]
        ]);

        $this->add([
            'name' => 'anycloud_scaleway_object_storage_key',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Scaleway Object Storage AWS Key',
            ],
            'attributes' => [
                'required' => true,
                'id' => 'anycloud_scaleway_object_storage_key',
            ]
        ]);

        $this->add([
            'name' => 'anycloud_scaleway_object_storage_secret_key',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Scaleway Object Storage AWS Secret Key',
            ],
            'attributes' => [
                'required' => true,
                'id' => 'anycloud_scaleway_object_storage_secret_key',
            ]
        ]);

        $this->add([
            'name' => 'anycloud_scaleway_object_storage_bucket',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Scaleway Object Storage AWS Bucket',
            ],
            'attributes' => [
                'required' => true,
                'id' => 'anycloud_scaleway_object_storage_bucket',
            ]
        ]);

        $this->add([
            'name' => 'anycloud_scaleway_object_storage_region',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Scaleway Object Storage AWS Region',
            ],
            'attributes' => [
                'required' => true,
                'id' => 'anycloud_scaleway_object_storage_region',
            ]
        ]);

        $this->add([
            'name' => 'anycloud_scaleway_object_storage_endpoint',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Scaleway Object Storage AWS Endpoint',
            ],
            'attributes' => [
                'required' => true,
                'id' => 'anycloud_scaleway_object_storage_endpoint',
            ]
        ]);

        $this->add([
            'name' => 'anycloud_azure_account_name',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Azure Account Name',
            ],
            'attributes' => [
                'required' => true,
                'id' => 'anycloud_azure_account_name',
            ]
        ]);

        $this->add([
            'name' => 'anycloud_azure_account_key',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Azure Account Key',
            ],
            'attributes' => [
                'required' => true,
                'id' => 'anycloud_azure_account_key',
            ]
        ]);

        $this->add([
            'name' => 'anycloud_azure_container_name',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Azure Container Name',
            ],
            'attributes' => [
                'required' => true,
                'id' => 'anycloud_azure_container_name',
            ]
        ]);

        $this->add([
            'name' => 'anycloud_azure_endpoint',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Azure Endpoint',
                'info' => 'Can usually leave blank unless you have a custom endpoint set up',
            ],
            'attributes' => [
                'required' => false,
                'id' => 'anycloud_azure_endpoint',
            ]
        ]);

        $this->add([
            'name' => 'anycloud_rackspace_identity_endpoint',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Rackspace Identity Endpoint',
            ],
            'attributes' => [
                'required' => true,
                'id' => 'anycloud_rackspace_identity_endpoint',
            ]
        ]);

        $this->add([
            'name' => 'anycloud_rackspace_username',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Rackspace Username',
            ],
            'attributes' => [
                'required' => true,
                'id' => 'anycloud_rackspace_username',
            ]
        ]);

        $this->add([
            'name' => 'anycloud_rackspace_password',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Rackspace Password',
            ],
            'attributes' => [
                'required' => true,
                'id' => 'anycloud_rackspace_password',
            ]
        ]);

        $this->add([
            'name' => 'anycloud_rackspace_container',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Rackspace Container Name',
            ],
            'attributes' => [
                'required' => true,
                'id' => 'anycloud_rackspace_container',
            ]
        ]);

        $this->add([
            'name' => 'anycloud_rackspace_region',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Rackspace Region',
            ],
            'attributes' => [
                'required' => true,
                'id' => 'anycloud_rackspace_region',
            ]
        ]);

        $this->add([
            'name' => 'anycloud_dropbox_access_token',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Dropbox Access Token',
            ],
            'attributes' => [
                'required' => true,
                'id' => 'anycloud_dropbox_access_token',
            ]
        ]);

        $this->add([
            'name' => 'anycloud_google_project_id',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Google Project ID',
            ],
            'attributes' => [
                'required' => true,
                'id' => 'anycloud_google_project_id',
            ]
        ]);

        $this->add([
            'name' => 'anycloud_google_bucket_name',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Google Bucket Name',
            ],
            'attributes' => [
                'required' => true,
                'id' => 'anycloud_google_bucket_name',
            ]
        ]);

        $this->add([
            'name' => 'anycloud_google_credentials_path',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Google Credentials Path',
                'info' => 'Replace {CONFIG} with the name of your Google credentials file stored at the listed path',
                'value' => '/src/Service/File/Adapter/Google/{CONFIG}.json',
            ],
            'attributes' => [
                'required' => true,
                'id' => 'anycloud_google_credentials_path',
            ]
        ]);

        $this->add([
            'name' => 'anycloud_google_storage_uri',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Google Storage URI',
                'info' => 'You can usually leave this as the default unless you have tweaked other settings',
                'value' => 'https://storage.googleapis.com',
            ],
            'attributes' => [
                'required' => true,
                'id' => 'anycloud_google_storage_uri',
            ]
        ]);

//        $this->add([
//            'name' => 'amazons3_expiration',
//            'type' => Element\Text::class,
//            'options' => [
//                'label' => 'Expiration (minutes)',
//                'info' => 'If an expiration time is set and grater than zero, we’re uploading private files and using signed URLs. If not, we’re uploading public files.',
//            ],
//        ]);

        $inputFilter = $this->getInputFilter();
//        $inputFilter->add([
//            'name' => 'adapter',
//            'required' => true,
//        ]);
//        $inputFilter->add([
//            'name' => 'amazons3_expiration',
//            'required' => false,
//            'filters' => [
//                ['name' => 'Int'],
//            ],
//        ]);
    }

    protected function getSetting($name)
    {
        return $this->settings->get($name);
    }
}