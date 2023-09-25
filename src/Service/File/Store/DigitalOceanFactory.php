<?php

namespace AnyCloud\Service\File\Store;

class DigitalOceanFactory extends AbstractAwsS3V3Factory
{
    protected function getConfigKey(): string
    {
        return 'digital_ocean';
    }
}
