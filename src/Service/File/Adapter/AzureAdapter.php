<?php

namespace AnyCloud\Service\File\Adapter;

use AnyCloud\Traits\CommonTrait;
use League\Flysystem\AzureBlobStorage\AzureBlobStorageAdapter;
use MicrosoftAzure\Storage\Blob\BlobRestProxy;
use Omeka\File\Exception\ConfigException;

class AzureAdapter implements AdapterInterface
{
    use CommonTrait;

    protected $options;
    private $client;

    /**
     * {@inheritdoc}
     */
    public function createAdapter($options): AzureBlobStorageAdapter
    {
        $this->options = $options;
        $this->createClient();

        return new AzureBlobStorageAdapter($this->client, $this->getSetting('container_name'));
    }

    /**
     * Find the public base URL for the resource.
     *
     * @return string
     */
    public function getUri(): string
    {
        if (empty($this->Uri)) {
            $this->createClient();
        }

        return empty($this->getSetting('endpoint')) ? 'https://'.$this->getSetting('account_name').'.blob.core.windows.net/'.$this->getSetting('container_name') : (string) $this->getSetting('endpoint');
    }

    /**
     * Create client.
     */
    private function createClient(): void
    {
        $this->optionExists('account_name');
        $this->optionExists('account_key');
        $this->optionExists('container_name');

        try {
            $this->client = BlobRestProxy::createBlobService('DefaultEndpointsProtocol=https;AccountName='.$this->getSetting('account_name').';AccountKey='.$this->getSetting('account_key').';');
        } catch (ConfigException $e) {
            echo 'Azure Error: '.$e->getMessage()."\n";
        }
    }
}
