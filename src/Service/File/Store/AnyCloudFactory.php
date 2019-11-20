<?php

namespace AnyCloud\Service\File\Store;

use AnyCloud\File\Store\AnyCloud;
use AnyCloud\Service\File\Adapter;
use AnyCloud\Traits\CommonTrait;
use Interop\Container\ContainerInterface;
use League\Flysystem\Filesystem;
use Zend\ServiceManager\Factory\FactoryInterface;

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
        if (in_array($this->getAdapter(), self::AWS_BASED, true)) {
            $adapter = new Adapter\AwsAdapter();
            $this->adapter = $adapter->createAdapter($this->options);
        }

        switch ($this->getAdapter()) {
            case 'azure':
                $azure = new Adapter\AzureAdapter;
                $this->adapter = $azure->createAdapter($this->options);
                $this->tempUri = $azure->getUri();
                break;
            case 'rackspace':
                $rackspace = new Adapter\RackspaceAdapter;
                $this->adapter = $rackspace->createAdapter($this->options);
                $this->tempUri = $rackspace->getUri();
                break;
            case 'dropbox':
                $dropbox = new Adapter\DropboxAdapter;
                $this->adapter = $dropbox->createAdapter($this->options);
                break;
            case 'google':
                $google = new Adapter\GoogleAdapter;
                $this->adapter = $google->createAdapter($this->options);
                $this->tempUri = $google->getUri();
                break;
        }

        $this->filesystem = new Filesystem($this->adapter);
    }

    /**
     * Create URI for file.
     */
    private function createUri(): void
    {
        if (in_array($this->getAdapter(), self::AWS_BASED, true)) {
            $this->uri = dirname($this->filesystem->getAdapter()->getClient()->getObjectUrl($this->getSetting('bucket'),
                $this->getSetting('key')));
        } else {
            $this->uri = $this->tempUri;
        }
    }
}
