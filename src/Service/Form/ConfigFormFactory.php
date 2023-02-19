<?php

namespace AnyCloud\Service\Form;

use AnyCloud\Form\ConfigForm;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class ConfigFormFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $services, $requestedName, array $options = null)
    {
        $settings = $services->get('Omeka\Settings');

        $form = new ConfigForm([], $options ?? []);
        $form->setGlobalSettings($settings);

        return $form;
    }
}
