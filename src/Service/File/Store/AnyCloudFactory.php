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
        switch ($this->getAdapter()) {
            case 'aws':
            case 'wasabi':
            case 'digital_ocean':
            case 'scaleway':
                $adapter = new Adapter\AwsAdapter();
                break;
            case 'azure':
                $adapter = new Adapter\AzureAdapter();
                $this->tempUri = $adapter->getUri();
                break;
            case 'rackspace':
                $adapter = new Adapter\RackspaceAdapter();
                $this->tempUri = $adapter->getUri();
                break;
            case 'dropbox':
                $adapter = new Adapter\DropboxAdapter();
                break;
            case 'google':
                $adapter = new Adapter\GoogleAdapter();
                $this->tempUri = $adapter->getUri();
                break;
            default:
                $adapter = null;
        }

        $this->adapter    = $adapter->createAdapter($this->options);
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
