<?php

namespace AnyCloud\Service\File\Store;

use AnyCloud\File\Store\Dropbox;
use AnyCloud\FilesystemAdapter\DropboxAdapter;
use League\Flysystem\Filesystem;
use League\Flysystem\FilesystemAdapter;
use Omeka\File\Store\StoreInterface;
use Spatie\Dropbox\Client;

class DropboxFactory extends AbstractFlysystemFactory
{
    protected function getConfigKey(): string
    {
        return 'dropbox';
    }

    protected function getFilesystemAdapter(array $config): FilesystemAdapter
    {
        $client = new Client($config['access_token']);
        $adapter = new DropboxAdapter($client);

        return $adapter;
    }

    protected function getStore(array $config): StoreInterface
    {
        $adapter = $this->getFilesystemAdapter($config);
        $filesystem = new Filesystem($adapter);
        $store = new Dropbox($filesystem);

        return $store;
    }
}
