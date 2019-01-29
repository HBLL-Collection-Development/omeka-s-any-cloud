<?php

namespace AnyCloud\Service\File\Store;

use AnyCloud\File\Store\AnyCloud;
use AnyCloud\Service\File\Adapter;
use AnyCloud\Traits\CommonTrait;
use League\Flysystem\Filesystem;
use Interop\Container\ContainerInterface;
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

    private function createFilesystem()
    {
        $adapterName = $this->getSetting('adapter');
        switch ($adapterName) {
            case 'aws':
            case 'digital_ocean':
            case 'scaleway_object_storage':
                $aws = new Adapter\AwsAdapter;
                $this->adapter = $aws->createAdapter($this->options);
                break;
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
            default:
                $this->adapter = null;
        }

        $this->filesystem = new Filesystem($this->adapter);
    }

    private function createUri()
    {
        $adapterName = $this->getSetting('adapter');
        switch ($adapterName) {
            case 'aws':
            case 'digital_ocean':
            case 'scaleway_object_storage':
                $this->uri = dirname($this->filesystem->getAdapter()->getClient()->getObjectUrl($this->getSetting($adapterName.'_bucket'),
                    $this->getSetting($adapterName.'_key')));
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
