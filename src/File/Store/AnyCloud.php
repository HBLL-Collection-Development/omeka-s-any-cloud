<?php

namespace AnyCloud\File\Store;

use League\Flysystem\Filesystem;
use League\Flysystem\FilesystemException;
use League\Flysystem\Visibility;
use Omeka\File\Exception\ConfigException;
use Omeka\File\Store\StoreInterface;

class AnyCloud implements StoreInterface
{
    private const AWS_BASED = ['aws', 'wasabi', 'digital_ocean', 'scaleway'];
    private $remoteFilesystem;
    private $configs;
    private $uri;
    private $adapter;

    /**
     * Initiate Any Cloud Module.
     *
     * @param Filesystem  $remoteFilesystem Filesystem to use
     * @param array       $configs          Array containing `config` data
     * @param string|null $uri              URI structure for file
     * @param object      $adapter          Adapter that can be used to create temporary links or call other methods of
     *                                      the Flysystem Adapter
     */
    public function __construct(Filesystem $remoteFilesystem, $configs, $uri = null, $adapter = null)
    {
        $this->remoteFilesystem = $remoteFilesystem;
        $this->configs = $configs;
        $this->uri = $uri;
        $this->adapter = $adapter;
    }

    /**
     * {@inheritdoc}
     */
    public function put($source, $storagePath): void
    {
        try {
            $contents = fopen($source, 'r');
            $config = ['visibility' => Visibility::PUBLIC];
            $this->remoteFilesystem->writeStream($storagePath, $contents, $config);
            if (is_resource($contents)) {
                fclose($contents);
            }
        } catch (ConfigException $e) {
            echo 'Any Cloud Error: '.$e->getMessage()."\n";
        }
    }

    /**
     * {@inheritdoc}
     */
    public function delete($storagePath): void
    {
        try {
            $this->remoteFilesystem->delete($storagePath);
        } catch (FilesystemException $e) {
            echo 'Any Cloud Error: '.$e->getMessage()."\n";
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getUri($storagePath): string
    {
        if (method_exists($this->adapter, 'getUrl')) {
            // Kludgy solution to working with temporary Dropbox URIs
            return $this->adapter->getUrl($storagePath);
        } else {
            return $this->remoteFilesystem->publicUrl($storagePath);
        }
        // Normal method for grabbing URIs from `AnyCloudFactory` (for everything except Dropbox)
        try {
            return $this->uri.'/'.$storagePath;
        } catch (ConfigException $e) {
            echo 'Any Cloud Error: '.$e->getMessage()."\n";
        }
    }
}
