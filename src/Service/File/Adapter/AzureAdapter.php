<?php

namespace AnyCloud\Service\File\Adapter;

use League\Flysystem\AzureBlobStorage\AzureBlobStorageAdapter;
use MicrosoftAzure\Storage\Blob\BlobRestProxy;
use Omeka\File\Exception\ConfigException;

class AzureAdapter implements AdapterInterface
{
    use Common;

    protected $options;
    private $client;

    /**
     * {@inheritDoc}
     */
    public function createAdapter($options)
    {
        $this->options = $options;
        $this->createClient();

        return new AzureBlobStorageAdapter($this->client, $options['azure_container_name']);
    }

    /**
     * Find the public base URL for the resource
     *
     * return string Base URL for the resource
     */
    public function getUri()
    {
        if (empty($this->Uri)) {
            $this->createClient();
        }
        return empty($options['azure_endpoint']) ? 'https://'.$options['azure_account_name'].'.blob.core.windows.net/'.$options['azure_container_name'] : $options['azure_endpoint'];
    }

    /**
     * Create client
     */
    private function createClient()
    {
        $this->optionExists('azure_account_name');
        $this->optionExists('azure_account_key');
        $this->optionExists('azure_container_name');

        try {
            $this->client = BlobRestProxy::createBlobService('DefaultEndpointsProtocol=https;AccountName='.$this->options['azure_account_name'].';AccountKey='.$this->options['azure_account_key'].';');
        } catch (ConfigException $e) {
            echo 'Azure Error: '.$e->getMessage()."\n";
        }
    }
}
