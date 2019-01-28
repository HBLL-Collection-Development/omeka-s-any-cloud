<?php

namespace AnyCloud;

use Omeka\Module\AbstractModule;
use Zend\Mvc\MvcEvent;

class Module extends AbstractModule
{
    public function getConfig()
    {
        return include __DIR__.'/config/module.config.php';
    }

    public function onBootstrap(MvcEvent $event)
    {
        parent::onBootstrap($event);
        $this->setFileStoreAlias();
        require __DIR__ . '/vendor/autoload.php';
    }

    /**
     * Override default file store alias to use Any Cloud module for uploads instead
     */
    protected function setFileStoreAlias()
    {
        $serviceLocator = $this->getServiceLocator();
        $serviceLocator->setAlias('Omeka\File\Store', File\Store\AnyCloud::class);
    }
}
