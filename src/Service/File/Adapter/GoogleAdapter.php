<?php

namespace AnyCloud\Service\File\Adapter;

use AnyCloud\Traits\CommonTrait;
use Google\Cloud\Storage\StorageClient;
use League\Flysystem\GoogleCloudStorage\GoogleCloudStorageAdapter;
use Omeka\File\Exception\ConfigException;

class GoogleAdapter implements AdapterInterface
{
    use CommonTrait;

    protected $options;
    private $client;

    /**
     * {@inheritdoc}
     */
    public function createAdapter($options): GoogleCloudStorageAdapter
    {
        $this->options = $options;
        $this->createClient();
        $bucket = $this->client->bucket($this->getSetting('bucket_name'));

        return new GoogleCloudStorageAdapter($bucket);
    }

    /**
     * Find the public base URI for the resource.
     *
     * @return string Base URI for the resource
     */
    public function getUri(): string
    {
        return $this->getSetting('storage_uri').'/'.$this->getSetting('bucket_name');
    }

    /**
     * Create client.
     */
    private function createClient(): void
    {
        $this->optionExists('project_id');
        $this->optionExists('bucket_name');
        $this->optionExists('credentials_path');
        $this->optionExists('storage_uri');
        $path = realpath('').'/modules/AnyCloud'.$this->getSetting('credentials_path');

        try {
            $this->client = new StorageClient([
                'projectId'   => $this->getSetting('project_id'),
                'keyFilePath' => $path,
            ]);
        } catch (ConfigException $e) {
            echo 'Google Error: '.$e->getMessage()."\n";
        }
    }
}
