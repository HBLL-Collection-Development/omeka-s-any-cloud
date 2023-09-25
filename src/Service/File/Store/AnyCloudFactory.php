<?php

namespace AnyCloud\Service\File\Store;

use AnyCloud\File\Store;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class AnyCloudFactory implements FactoryInterface
{
    const SERVICE_NAMES = [
        'aws'           => Store\Aws::class,
        'azure'         => Store\Azure::class,
        'digital_ocean' => Store\DigitalOcean::class,
        'dropbox'       => Store\Dropbox::class,
        'google'        => Store\Google::class,
        'scaleway'      => Store\Scaleway::class,
        'wasabi'        => Store\Wasabi::class,
    ];

    /**
     * @param ContainerInterface $serviceLocator
     * @param string             $requestedName
     * @param array|null         $options
     *
     * @return \Omeka\File\Store\StoreInterface
     */
    public function __invoke(ContainerInterface $serviceLocator, $requestedName, array $options = null)
    {
        $settings = $serviceLocator->get('Omeka\Settings');
        $anycloud_adapter = $settings->get('anycloud_adapter', []);
        $adapter = $anycloud_adapter['adapter'];

        if (array_key_exists($adapter, self::SERVICE_NAMES)) {
            return $serviceLocator->get(self::SERVICE_NAMES[$adapter]);
        }

        throw new \Omeka\Service\Exception\ConfigException('Bad value for anycloud_adapter: '.$adapter);
    }
}
