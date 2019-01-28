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
        require __DIR__ . '/vendor/autoload.php';
    }
}
