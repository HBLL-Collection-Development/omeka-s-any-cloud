<?php

namespace AnyCloud\Service\File\Store;

class WasabiFactory extends AbstractAwsS3V3Factory
{
    protected function getConfigKey(): string
    {
        return 'wasabi';
    }
}
