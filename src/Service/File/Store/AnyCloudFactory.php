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

    const AWS_BASED = ['aws', 'wasabi', 'digital_ocean', 'scaleway'];
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
    private function createFilesystem()
    {
        if (in_array($this->getAdapter(), self::AWS_BASED)) {
            $adapter = new Adapter\AwsAdapter();
            $this->adapter = $adapter->createAdapter($this->options);
        } else {
            $adapter = new Adapter\AzureAdapter();
            $this->adapter = $adapter->createAdapter($this->options);
            $this->tempUri = $adapter->getUri();
        }
        $this->filesystem = new Filesystem($this->adapter);
    }

    /**
     * Create URI for file.
     */
    private function createUri()
    {
        if (in_array($this->getAdapter(), self::AWS_BASED)) {
            $this->uri = dirname($this->filesystem->getAdapter()->getClient()->getObjectUrl($this->getSetting('bucket'),
                $this->getSetting('key')));
        } else {
            $this->uri = $this->tempUri;
        }
    }
}
