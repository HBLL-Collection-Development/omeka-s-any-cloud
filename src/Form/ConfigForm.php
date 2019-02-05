<?php

namespace AnyCloud\Form;

use Zend\Form\Form;
use Zend\Form\Element;
use Zend\Form\Fieldset;

class ConfigForm extends Form
{
    protected $settings;

    public function setSettings($settings)
    {
        $this->settings = $settings;
    }

    public function init()
    {
        $this->addCsrf();
        $this->addAdapter();
        $this->addAws();
        $this->addAzure();
        $this->addGoogle();
        $this->addDigitalOcean();
        $this->addScaleway();
        $this->addRackspace();
        $this->addDropbox();
    }

    protected function getSetting($name)
    {
        return $this->settings->get($name);
    }

    private function addCsrf()
    {
        $this->add([
            'type' => Element\Csrf::class,
            'name' => 'csrf',
            'options' => [
                'csrf_options' => [
                    'timeout' => 600,
                ],
            ],
        ]);
    }

    private function addAdapter()
    {
        $this->add([
            'name' => 'anycloud_adapter',
            'type' => Fieldset::class,
            'options' => [
                'label' => 'Any Cloud Adapter',
            ],
            'attributes' => [
                'id' => 'adapter-fieldset',
            ],
        ]);
        $adapterFieldset = $this->get('anycloud_adapter');
        $adapterFieldset->add([
            'name' => 'adapter',
            'type' => Element\Select::class,
            'options' => [
                'label' => 'Cloud Service Adapter: ',
                'value_options' => [
                    'default' => 'Omeka Default (local server)',
                    'aws' => 'Amazon S3 Storage',
                    'azure' => 'Microsoft Azure Storage',
                    'google' => 'Google Cloud Storage',
                    'digital_ocean' => 'DigitalOcean Spaces',
                    'scaleway' => 'Scaleway Object Storage',
                    'rackspace' => 'Rackspace Files',
                    'dropbox' => 'Dropbox',
                ],
            ],
            'attributes' => [
                'id' => 'adapter',
            ],
        ]);
    }

    private function addAws()
    {
        $this->add([
            'name' => 'anycloud_aws',
            'type' => Fieldset::class,
            'options' => [
                'label' => 'AmazonS3 Storage',
            ],
            'attributes' => [
                'class' => 'aws fieldset',
            ],
        ]);
        $awsFieldset = $this->get('anycloud_aws');
        $awsFieldset->add([
            'name' => 'aws_key',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'AWS Key',
            ],
            'attributes' => [
                'id' => 'aws_key',
            ],
        ]);
        $awsFieldset->add([
            'name' => 'aws_secret_key',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'AWS Secret Key',
            ],
            'attributes' => [
                'id' => 'aws_secret_key',
                'cols' => '100',
            ],
        ]);
        $awsFieldset->add([
            'name' => 'aws_bucket',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'AWS Bucket',
            ],
            'attributes' => [
                'id' => 'aws_bucket',
            ],
        ]);
        $awsFieldset->add([
            'name' => 'aws_region',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'AWS Region',
            ],
            'attributes' => [
                'id' => 'aws_region',
            ],
        ]);
        $awsFieldset->add([
            'name' => 'aws_endpoint',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'AWS Endpoint',
                'info' => 'Can usually leave blank unless you have a custom endpoint set up. See https://docs.aws.amazon.com/general/latest/gr/rande.html#s3_region',
            ],
            'attributes' => [
                'id' => 'aws_endpoint',
            ],
        ]);
    }

    private function addAzure()
    {
        $this->add([
            'name' => 'anycloud_azure',
            'type' => Fieldset::class,
            'options' => [
                'label' => 'Microsoft Azure Storage',
            ],
            'attributes' => [
                'class' => 'azure fieldset',
            ],
        ]);
        $azureFieldset = $this->get('anycloud_azure');
        $azureFieldset->add([
            'name' => 'azure_account_name',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Azure Account Name',
            ],
            'attributes' => [
                'id' => 'azure_account_name',
            ],
        ]);
        $azureFieldset->add([
            'name' => 'azure_account_key',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Azure Account Key',
            ],
            'attributes' => [
                'id' => 'azure_account_key',
            ],
        ]);
        $azureFieldset->add([
            'name' => 'azure_container_name',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Azure Container Name',
            ],
            'attributes' => [
                'id' => 'azure_container_name',
            ],
        ]);
        $azureFieldset->add([
            'name' => 'azure_endpoint',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Azure Endpoint',
                'info' => 'Can usually leave blank unless you have a custom endpoint set up',
            ],
            'attributes' => [
                'id' => 'azure_endpoint',
            ],
        ]);
    }

    private function addGoogle()
    {
        $this->add([
            'name' => 'anycloud_google',
            'type' => Fieldset::class,
            'options' => [
                'label' => 'Google Cloud Storage',
            ],
            'attributes' => [
                'class' => 'google fieldset',
            ],
        ]);
        $googleFieldset = $this->get('anycloud_google');
        $googleFieldset->add([
            'name' => 'google_project_id',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Google Project ID',
            ],
            'attributes' => [
                'id' => 'google_project_id',
            ],
        ]);
        $googleFieldset->add([
            'name' => 'google_bucket_name',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Google Bucket Name',
            ],
            'attributes' => [
                'id' => 'google_bucket_name',
            ],
        ]);
        $googleFieldset->add([
            'name' => 'google_credentials_path',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Google Credentials Path',
                'info' => 'Replace {CONFIG} with the name of your Google credentials file stored at the listed path',
                'value' => '/src/Service/File/Adapter/Google/{CONFIG}.json',
            ],
            'attributes' => [
                'id' => 'google_credentials_path',
            ],
        ]);
        $googleFieldset->add([
            'name' => 'google_storage_uri',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Google Storage URI',
                'info' => 'You can usually leave this as the default unless you have tweaked other settings',
                'value' => 'https://storage.googleapis.com',
            ],
            'attributes' => [
                'id' => 'google_storage_uri',
            ],
        ]);
    }

    private function addDigitalOcean()
    {
        $this->add([
            'name' => 'anycloud_digital_ocean',
            'type' => Fieldset::class,
            'options' => [
                'label' => 'DigitalOcean Spaces',
            ],
            'attributes' => [
                'class' => 'digital_ocean fieldset',
            ],
        ]);
        $digitaloceanFieldset = $this->get('anycloud_digital_ocean');
        $digitaloceanFieldset->add([
            'name' => 'digital_ocean_key',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'DigitalOcean AWS Key',
            ],
            'attributes' => [
                'id' => 'digital_ocean_key',
            ],
        ]);
        $digitaloceanFieldset->add([
            'name' => 'digital_ocean_secret_key',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'DigitalOcean AWS Secret Key',
            ],
            'attributes' => [
                'id' => 'digital_ocean_secret_key',
            ],
        ]);
        $digitaloceanFieldset->add([
            'name' => 'digital_ocean_bucket',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'DigitalOcean AWS Bucket',
            ],
            'attributes' => [
                'id' => 'digital_ocean_bucket',
            ],
        ]);
        $digitaloceanFieldset->add([
            'name' => 'digital_ocean_region',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'DigitalOcean AWS Region',
            ],
            'attributes' => [
                'id' => 'digital_ocean_region',
            ],
        ]);
        $digitaloceanFieldset->add([
            'name' => 'digital_ocean_endpoint',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'DigitalOcean AWS Endpoint',
            ],
            'attributes' => [
                'id' => 'digital_ocean_endpoint',
            ],
        ]);
    }

    private function addScaleway()
    {
        $this->add([
            'name' => 'anycloud_scaleway',
            'type' => Fieldset::class,
            'options' => [
                'label' => 'Scaleway Object Storage',
            ],
            'attributes' => [
                'class' => 'scaleway fieldset',
            ],
        ]);
        $scalewayFieldset = $this->get('anycloud_scaleway');
        $scalewayFieldset->add([
            'name' => 'scaleway_key',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Scaleway AWS Key',
            ],
            'attributes' => [
                'id' => 'scaleway_key',
            ],
        ]);
        $scalewayFieldset->add([
            'name' => 'scaleway_secret_key',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Scaleway AWS Secret Key',
            ],
            'attributes' => [
                'id' => 'scaleway_secret_key',
            ],
        ]);
        $scalewayFieldset->add([
            'name' => 'scaleway_bucket',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Scaleway AWS Bucket',
            ],
            'attributes' => [
                'id' => 'scaleway_bucket',
            ],
        ]);
        $scalewayFieldset->add([
            'name' => 'scaleway_region',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Scaleway AWS Region',
            ],
            'attributes' => [
                'id' => 'scaleway_region',
            ],
        ]);
        $scalewayFieldset->add([
            'name' => 'scaleway_endpoint',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Scaleway AWS Endpoint',
            ],
            'attributes' => [
                'id' => 'scaleway_endpoint',
            ],
        ]);
    }

    private function addRackspace()
    {
        $this->add([
            'name' => 'anycloud_rackspace',
            'type' => Fieldset::class,
            'options' => [
                'label' => 'Rackspace Files',
            ],
            'attributes' => [
                'class' => 'rackspace fieldset',
            ],
        ]);
        $rackspaceFieldset = $this->get('anycloud_rackspace');
        $rackspaceFieldset->add([
            'name' => 'rackspace_identity_endpoint',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Rackspace Identity Endpoint',
                'info' => 'Valid options include “US_IDENTITY_ENDPOINT” and “UK_IDENTITY_ENDPOINT”',
            ],
            'attributes' => [
                'id' => 'rackspace_identity_endpoint',
            ],
        ]);
        $rackspaceFieldset->add([
            'name' => 'rackspace_username',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Rackspace Username',
            ],
            'attributes' => [
                'id' => 'rackspace_username',
            ],
        ]);
        $rackspaceFieldset->add([
            'name' => 'rackspace_password',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Rackspace Password',
            ],
            'attributes' => [
                'id' => 'rackspace_password',
            ],
        ]);
        $rackspaceFieldset->add([
            'name' => 'rackspace_container',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Rackspace Container Name',
            ],
            'attributes' => [
                'id' => 'rackspace_container',
            ],
        ]);
        $rackspaceFieldset->add([
            'name' => 'rackspace_region',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Rackspace Region',
            ],
            'attributes' => [
                'id' => 'rackspace_region',
            ],
        ]);
    }

    private function addDropbox()
    {
        $this->add([
            'name' => 'anycloud_dropbox',
            'type' => Fieldset::class,
            'options' => [
                'label' => 'Dropbox',
            ],
            'attributes' => [
                'class' => 'dropbox fieldset',
            ],
        ]);
        $dropboxFieldset = $this->get('anycloud_dropbox');
        $dropboxFieldset->add([
            'name' => 'dropbox_access_token',
            'type' => Element\Text::class,
            'options' => [
                'label' => 'Dropbox Access Token',
            ],
            'attributes' => [
                'id' => 'dropbox_access_token',
            ],
        ]);
    }
}
