<?php

namespace AnyCloud\Service\File\Store;

class AwsFactory extends AbstractAwsS3V3Factory
{
    protected function getConfigKey(): string
    {
        return 'aws';
    }
}
