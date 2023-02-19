<?php

namespace AnyCloud\Service\File\Store;

use AnyCloud\File\Store\AnyCloud;
use AnyCloud\Service\File\Adapter;
use AnyCloud\Traits\CommonTrait;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use League\Flysystem\Filesystem;

class AnyCloudFactory implements FactoryInterface
{
    use CommonTrait;

    private const AWS_BASED = ['aws', 'wasabi', 'digital_ocean', 'scaleway'];

    protected $options;
    private $filesystem;
    private $uri;
    private $tempUri;
    private $adapter;

    /**
     * @param ContainerInterface $serviceLocator
     * @param string             $requestedName
     * @param array|null         $options
     *
     * @return AnyCloud|object
     */
    public function __invoke(ContainerInterface $serviceLocator, $requestedName, array $options = null)
    {
        $this->options = $serviceLocator->get('Omeka\Settings');
        $this->createFilesystem();
        $this->createUri();

        return new AnyCloud($this->filesystem, $this->options, $this->uri, $this->adapter);
    }

    /**
     * Create the Filesystem object.
     */
    private function createFilesystem(): void
    {
        $this->createAwsAdapter();
        $this->createAzureAdapter();
        $this->createDropboxAdapter();
        $this->createGoogleAdapter();

        $this->filesystem = new Filesystem($this->adapter);
    }

    /**
     * Create adapter.
     *
     * @param object $adapter Adapter to create
     */
    private function createAdapter($adapter): void
    {
        $this->adapter = $adapter->createAdapter($this->options);
    }

    /**
     * Create a temporary URI to store the file before saving.
     *
     * @param object $adapter Adapter to create a temporary URI for
     */
    private function createTempUri($adapter): void
    {
        $this->tempUri = $adapter->getUri();
    }

    /**
     * Create new AWS adapter.
     */
    private function createAwsAdapter(): void
    {
        if (in_array($this->getAdapter(), self::AWS_BASED, true)) {
            $this->createAdapter(new Adapter\AwsAdapter());
        }
    }

    /**
     * Create new Azure adapter.
     */
    private function createAzureAdapter(): void
    {
        if ($this->getAdapter() === 'azure') {
            $adapter = new Adapter\AzureAdapter();
            $this->createAdapter($adapter);
            $this->createTempUri($adapter);
        }
    }

    /**
     * Create new Dropbox adapter.
     */
    private function createDropboxAdapter(): void
    {
        if ($this->getAdapter() === 'dropbox') {
            $adapter = new Adapter\DropboxAdapter();
            $this->createAdapter($adapter);
        }
    }

    /**
     * Create new Google adapter.
     */
    private function createGoogleAdapter(): void
    {
        if ($this->getAdapter() === 'google') {
            $adapter = new Adapter\GoogleAdapter();
            $this->createAdapter($adapter);
            $this->createTempUri($adapter);
        }
    }

    /**
     * Create URI for file.
     */
    private function createUri(): void
    {
        $this->uri = $this->tempUri;
    }
}
