<?php

namespace AnyCloud\Service\File\Store;

use Google\Cloud\Storage\StorageClient;
use League\Flysystem\FilesystemAdapter;
use League\Flysystem\GoogleCloudStorage\GoogleCloudStorageAdapter;

class GoogleFactory extends AbstractFlysystemFactory
{
    protected function getConfigKey(): string
    {
        return 'google';
    }

    protected function getFilesystemAdapter(array $config): FilesystemAdapter
    {
        $client = new StorageClient([
            'projectId'   => $config['project_id'],
            'keyFilePath' => sprintf('%s/modules/AnyCloud%s', OMEKA_PATH, $config['credentials_path']),
        ]);
        $bucket = $client->bucket($config['bucket_name']);
        $adapter = new GoogleCloudStorageAdapter($bucket);

        return $adapter;
    }
}
