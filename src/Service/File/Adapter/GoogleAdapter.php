<?php

namespace AnyCloud\Service\File\Adapter;

use AnyCloud\Traits\CommonTrait;
use Google\Cloud\Storage\StorageClient;
use Superbalist\Flysystem\GoogleStorage\GoogleStorageAdapter;
use Omeka\File\Exception\ConfigException;

class GoogleAdapter implements AdapterInterface
{
    use CommonTrait;

    protected $options;
    private $client;

    /**
     * {@inheritDoc}
     */
    public function createAdapter($options)
    {
        $this->options = $options;
        $this->createClient();
        $bucket = $this->client->bucket($this->getSetting('bucket_name'));

        return new GoogleStorageAdapter($this->client, $bucket);
    }

    /**
     * Find the public base URL for the resource
     *
     * return string Base URL for the resource
     */
    public function getUri()
    {
        return $this->getSetting('storage_uri').'/'.$this->getSetting('bucket_name');
    }

    /**
     * Create client
     */
    private function createClient()
    {
        $this->optionExists('project_id');
        $this->optionExists('bucket_name');
        $this->optionExists('credentials_path');
        $this->optionExists('storage_uri');
        $path = realpath("").'/modules/AnyCloud'.$this->getSetting('credentials_path');
        try {
            $this->client = new StorageClient([
                'projectId' => $this->getSetting('project_id'),
                'keyFilePath' => $path,
            ]);
        } catch (ConfigException $e) {
            echo 'Google Error: '.$e->getMessage()."\n";
        }
    }
}
