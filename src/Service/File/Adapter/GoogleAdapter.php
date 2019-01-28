<?php

namespace AnyCloud\Service\File\Adapter;

use Google\Cloud\Storage\StorageClient;
use Superbalist\Flysystem\GoogleStorage\GoogleStorageAdapter;
use Omeka\File\Exception\ConfigException;

class GoogleAdapter implements AdapterInterface
{
    private $options;
    private $client;

    /**
     * {@inheritDoc}
     */
    public function createAdapter($options)
    {
        $this->options = $options;
        $this->createClient();
        $bucket = $this->client->bucket($this->options['google_bucket_name']);

        return new GoogleStorageAdapter($this->client, $bucket);
    }

    /**
     * Find the public base URL for the resource
     *
     * return string Base URL for the resource
     */
    public function getUri()
    {
        return $this->options['google_storage_uri'].'/'.$this->options['google_bucket_name'];
    }

    /**
     * {@inheritDoc}
     */
    public function optionExists($option, $allowNull = false)
    {
        if (isset($this->options[$option]) || $allowNull === true) {
            return true;
        } else {
            throw new ConfigException("Any Cloud Error: Option `$option` has not been properly set.\n".$e."\n");
        }
    }

    /**
     * Create client
     */
    private function createClient()
    {
        $this->optionExists('google_project_id');
        $this->optionExists('google_bucket_name');
        $this->optionExists('google_credentials_path');
        $this->optionExists('google_storage_uri');
        $path = realpath("").'/modules/AnyCloud'.$this->options['google_credentials_path'];
        try {
            $this->client = new StorageClient([
                'projectId' => $this->options['google_project_id'],
                'keyFilePath' => $path,
            ]);
        } catch (ConfigException $e) {
            echo 'Google Error: '.$e->getMessage()."\n";
        }
    }
}
