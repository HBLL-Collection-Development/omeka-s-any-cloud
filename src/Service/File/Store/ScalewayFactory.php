<?php

namespace AnyCloud\Service\File\Store;

class ScalewayFactory extends AbstractAwsS3V3Factory
{
    protected function getConfigKey(): string
    {
        return 'scaleway';
    }
}
