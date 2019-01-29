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
        // ADAPTER
        //////////
        $this->add([
            'name' => 'anycloud_adapter',
            'type' => Element\Select::class,
            'options' => [
                'label' => 'Cloud Service Adapter: ',
                'value_options' => [
                    'default' => 'Omeka Default (local server)',
                    'aws' => 'Amazon S3 Storage',
                    'azure' => 'Microsoft Azure Storage',
                    'google' => 'Google Cloud Storage',
                    'digital_ocean' => 'DigitalOcean Spaces',
                    'scaleway_object_storage' => 'Scaleway Object Storage',
                    'rackspace' => 'Rackspace Files',
                    'dropbox' => 'Dropbox',
                ],
            ],
            'attributes' => [
                'id' => 'anycloud_adapter',
            ],
        ]);

        // AMAZON S3
        ////////////
        $this->add([
            'name' => 'anycloud_aws_key',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'AWS Key',
            ],
            'attributes' => [
                'id' => 'anycloud_aws_key',
            ],
        ]);
        $this->add([
            'name' => 'anycloud_aws_secret_key',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'AWS Secret Key',
            ],
            'attributes' => [
                'id' => 'anycloud_aws_secret_key',
                'cols' => '100',
            ],
        ]);
        $this->add([
            'name' => 'anycloud_aws_bucket',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'AWS Bucket',
            ],
            'attributes' => [
                'id' => 'anycloud_aws_bucket',
            ],
        ]);
        $this->add([
            'name' => 'anycloud_aws_region',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'AWS Region',
            ],
            'attributes' => [
                'id' => 'anycloud_aws_region',
            ],
        ]);
        $this->add([
            'name' => 'anycloud_aws_endpoint',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'AWS Endpoint',
                'info' => 'Can usually leave blank unless you have a custom endpoint set up. See https://docs.aws.amazon.com/general/latest/gr/rande.html#s3_region',
            ],
            'attributes' => [
                'id' => 'anycloud_aws_endpoint',
            ],
        ]);

        // MICROSOFT AZURE
        //////////////////
        $this->add([
            'name' => 'anycloud_azure_account_name',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Azure Account Name',
            ],
            'attributes' => [
                'id' => 'anycloud_azure_account_name',
            ],
        ]);
        $this->add([
            'name' => 'anycloud_azure_account_key',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Azure Account Key',
            ],
            'attributes' => [
                'id' => 'anycloud_azure_account_key',
            ],
        ]);
        $this->add([
            'name' => 'anycloud_azure_container_name',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Azure Container Name',
            ],
            'attributes' => [
                'id' => 'anycloud_azure_container_name',
            ],
        ]);
        $this->add([
            'name' => 'anycloud_azure_endpoint',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Azure Endpoint',
                'info' => 'Can usually leave blank unless you have a custom endpoint set up',
            ],
            'attributes' => [
                'id' => 'anycloud_azure_endpoint',
            ],
        ]);

        // GOOGLE CLOUD
        ///////////////
        $this->add([
            'name' => 'anycloud_google_project_id',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Google Project ID',
            ],
            'attributes' => [
                'id' => 'anycloud_google_project_id',
            ],
        ]);
        $this->add([
            'name' => 'anycloud_google_bucket_name',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Google Bucket Name',
            ],
            'attributes' => [
                'id' => 'anycloud_google_bucket_name',
            ],
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
                'id' => 'anycloud_google_credentials_path',
            ],
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
                'id' => 'anycloud_google_storage_uri',
            ],
        ]);

        // DIGITALOCEAN SPACES
        //////////////////////
        $this->add([
            'name' => 'anycloud_digital_ocean_key',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'DigitalOcean AWS Key',
            ],
            'attributes' => [
                'id' => 'anycloud_digital_ocean_key',
            ],
        ]);
        $this->add([
            'name' => 'anycloud_digital_ocean_secret_key',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'DigitalOcean AWS Secret Key',
            ],
            'attributes' => [
                'id' => 'anycloud_digital_ocean_secret_key',
            ],
        ]);
        $this->add([
            'name' => 'anycloud_digital_ocean_bucket',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'DigitalOcean AWS Bucket',
            ],
            'attributes' => [
                'id' => 'anycloud_digital_ocean_bucket',
            ],
        ]);
        $this->add([
            'name' => 'anycloud_digital_ocean_region',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'DigitalOcean AWS Region',
            ],
            'attributes' => [
                'id' => 'anycloud_digital_ocean_region',
            ],
        ]);
        $this->add([
            'name' => 'anycloud_digital_ocean_endpoint',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'DigitalOcean AWS Endpoint',
            ],
            'attributes' => [
                'id' => 'anycloud_digital_ocean_endpoint',
            ],
        ]);

        // SCALEWAY OBJECT STORAGE
        //////////////////////////
        $this->add([
            'name' => 'anycloud_scaleway_object_storage_key',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Scaleway Object Storage AWS Key',
            ],
            'attributes' => [
                'id' => 'anycloud_scaleway_object_storage_key',
            ],
        ]);
        $this->add([
            'name' => 'anycloud_scaleway_object_storage_secret_key',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Scaleway Object Storage AWS Secret Key',
            ],
            'attributes' => [
                'id' => 'anycloud_scaleway_object_storage_secret_key',
            ],
        ]);
        $this->add([
            'name' => 'anycloud_scaleway_object_storage_bucket',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Scaleway Object Storage AWS Bucket',
            ],
            'attributes' => [
                'id' => 'anycloud_scaleway_object_storage_bucket',
            ],
        ]);
        $this->add([
            'name' => 'anycloud_scaleway_object_storage_region',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Scaleway Object Storage AWS Region',
            ],
            'attributes' => [
                'id' => 'anycloud_scaleway_object_storage_region',
            ],
        ]);
        $this->add([
            'name' => 'anycloud_scaleway_object_storage_endpoint',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Scaleway Object Storage AWS Endpoint',
            ],
            'attributes' => [
                'id' => 'anycloud_scaleway_object_storage_endpoint',
            ],
        ]);

        // RACKSPACE FILE
        /////////////////
        $this->add([
            'name' => 'anycloud_rackspace_identity_endpoint',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Rackspace Identity Endpoint',
            ],
            'attributes' => [
                'id' => 'anycloud_rackspace_identity_endpoint',
            ],
        ]);
        $this->add([
            'name' => 'anycloud_rackspace_username',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Rackspace Username',
            ],
            'attributes' => [
                'id' => 'anycloud_rackspace_username',
            ],
        ]);
        $this->add([
            'name' => 'anycloud_rackspace_password',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Rackspace Password',
            ],
            'attributes' => [
                'id' => 'anycloud_rackspace_password',
            ],
        ]);
        $this->add([
            'name' => 'anycloud_rackspace_container',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Rackspace Container Name',
            ],
            'attributes' => [
                'id' => 'anycloud_rackspace_container',
            ],
        ]);
        $this->add([
            'name' => 'anycloud_rackspace_region',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Rackspace Region',
            ],
            'attributes' => [
                'id' => 'anycloud_rackspace_region',
            ],
        ]);

        // DROPBOX
        //////////
        $this->add([
            'name' => 'anycloud_dropbox_access_token',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Dropbox Access Token',
            ],
            'attributes' => [
                'id' => 'anycloud_dropbox_access_token',
            ],
        ]);

//        $this->add([
//            'name' => 'amazons3_expiration',
//            'type' => Element\Text::class,
//            'options' => [
//                'label' => 'Expiration (minutes)', // @translate
//                'info' => $this->translate("If an expiration time is set and grater than zero, we're uploading private files and using signed URLs. If not, we're uploading public files."), // @translate
//            ],
//        ]);
        $inputFilter = $this->getInputFilter();
//        $inputFilter->add([
//            'name' => 'amazons3_access_key_id',
//            'required' => true,
//        ]);
//        $inputFilter->add([
//            'name' => 'amazons3_secret_access_key',
//            'required' => true,
//        ]);
//        $inputFilter->add([
//            'name' => 'amazons3_bucket',
//            'required' => true,
//        ]);
//        $inputFilter->add([
//            'name' => 'amazons3_endpoint',
//            'required' => false,
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
