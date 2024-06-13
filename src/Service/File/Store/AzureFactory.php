<?php

namespace AnyCloud\Service\File\Store;

use League\Flysystem\AzureBlobStorage\AzureBlobStorageAdapter;
use League\Flysystem\FilesystemAdapter;
use MicrosoftAzure\Storage\Blob\BlobRestProxy;

class AzureFactory extends AbstractFlysystemFactory
{
    protected function getConfigKey(): string
    {
        return 'azure';
    }

    protected function getFilesystemAdapter(array $config): FilesystemAdapter
    {
        $connectionString = sprintf(
            'DefaultEndpointsProtocol=https;AccountName=%s;AccountKey=%s;',
            $config['account_name'],
            $config['account_key']
        );
        $client = BlobRestProxy::createBlobService($connectionString);
        $adapter = new AzureBlobStorageAdapter($client, $config['container_name']);

        return $adapter;
    }
}
