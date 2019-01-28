<?php

namespace AnyCloud\Service\File\Store;

use AnyCloud\File\Store\AnyCloud;
use AnyCloud\Service\File\Adapter;
use League\Flysystem\Filesystem;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class AnyCloudFactory implements FactoryInterface
{
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
        $config = $serviceLocator->get('Config');
        $this->createFilesystem($config['any_cloud']);
        $this->createUri($config['any_cloud']);

        return new AnyCloud($this->filesystem, $config, $this->uri, $this->adapter);
    }

    private function createFilesystem($options)
    {
        $adapterOptions = $options['adapter'];
        switch ($adapterOptions) {
            case 'aws':
            case 'digital_ocean':
            case 'scaleway_object_storage':
                $aws = new Adapter\AwsAdapter;
                $this->adapter = $aws->createAdapter($options);
                break;
            case 'azure':
                $azure = new Adapter\AzureAdapter;
                $this->adapter = $azure->createAdapter($options);
                $this->tempUri = $azure->getUri();
                break;
            case 'rackspace':
                $rackspace = new Adapter\RackspaceAdapter;
                $this->adapter = $rackspace->createAdapter($options);
                $this->tempUri = $rackspace->getUri();
                break;
            case 'dropbox':
                $dropbox = new Adapter\DropboxAdapter;
                $this->adapter = $dropbox->createAdapter($options);
                break;
            case 'google':
                $google = new Adapter\GoogleAdapter;
                $this->adapter = $google->createAdapter($options);
                $this->tempUri = $google->getUri();
                break;
            default:
                $this->adapter = null;
        }

        $this->filesystem = new Filesystem($this->adapter);
    }

    private function createUri($options)
    {
        $adapterOptions = $options['adapter'];
        switch ($adapterOptions) {
            case 'aws':
            case 'digital_ocean':
            case 'scaleway_object_storage':
                $this->uri = dirname($this->filesystem->getAdapter()->getClient()->getObjectUrl($options['bucket'], $options['key']));
                break;
            case 'azure':
                $this->uri = $this->tempUri;
                break;
            case 'rackspace':
                $this->uri = $this->tempUri;
                break;
            case 'google':
                $this->uri = $this->tempUri;
                break;
            default:
                $this->uri = null;
        }
    }
}
