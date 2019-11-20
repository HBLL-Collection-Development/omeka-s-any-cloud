<?php

namespace AnyCloud\Service\File\Adapter;

use AnyCloud\Traits\CommonTrait;
use Omeka\File\Exception\ConfigException;
use Spatie\Dropbox\Client;
use Spatie\FlysystemDropbox\DropboxAdapter as FlyDropboxAdapter;

class DropboxAdapter implements AdapterInterface
{
    use CommonTrait;

    protected $options;
    private $client;

    /**
     * {@inheritdoc}
     */
    public function createAdapter($options): FlyDropboxAdapter
    {
        $this->options = $options;
        $this->createClient();

        return new FlyDropboxAdapter($this->client);
    }

    /**
     * Find the public base URI for the resource.
     *
     * This is actually generated on the fly in `AnyCloudFactory.php`
     * because all Dropbox URIs are temporary and expire
     */
    public function getUri(): void
    {
    }

    /**
     * Create client.
     */
    private function createClient(): void
    {
        $this->optionExists('access_token');

        try {
            $this->client = new Client((string) $this->getSetting('access_token'));
        } catch (ConfigException $e) {
            echo 'Dropbox Error: '.$e->getMessage()."\n";
        }
    }
}
