<?php

namespace AnyCloud\Service\File\Store;

use AnyCloud\File\Store\Flysystem;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use League\Flysystem\Filesystem;
use League\Flysystem\FilesystemAdapter;
use Omeka\File\Store\StoreInterface;

abstract class AbstractFlysystemFactory implements FactoryInterface
{
    abstract protected function getConfigKey(): string;

    abstract protected function getFilesystemAdapter(array $config): FilesystemAdapter;

    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $config = $this->getConfig($container);
        $store = $this->getStore($config);

        return $store;
    }

    protected function getConfig(ContainerInterface $container)
    {
        $config = $container->get('Config');

        $configKey = $this->getConfigKey();
        if (isset($config['file_store'][$configKey])) {
            return $config['file_store'][$configKey];
        }

        $settings = $container->get('Omeka\Settings');
        $db_settings = $settings->get("anycloud_$configKey", []);
        $adapter_config = [];
        $configKeyQuoted = preg_quote($configKey);
        foreach ($db_settings as $key => $value) {
            $new_key = preg_replace("/^{$configKeyQuoted}_/", '', $key);
            $adapter_config[$new_key] = $value;
        }

        return $adapter_config;
    }

    protected function getStore(array $config): StoreInterface
    {
        $adapter = $this->getFilesystemAdapter($config);
        $filesystem = new Filesystem($adapter);
        $store = new Flysystem($filesystem);

        return $store;
    }
}
