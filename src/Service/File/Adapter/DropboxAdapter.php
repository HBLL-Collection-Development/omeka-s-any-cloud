<?php

namespace AnyCloud\Service\File\Adapter;

use AnyCloud\Traits\CommonTrait;
use Spatie\Dropbox\Client;
use Spatie\FlysystemDropbox\DropboxAdapter as FlyDropboxAdapter;
use Omeka\File\Exception\ConfigException;

class DropboxAdapter implements AdapterInterface
{
    use CommonTrait;

    protected $options;
    private $client;
    private $uri;

    /**
     * {@inheritDoc}
     */
    public function createAdapter($options)
    {
        $this->options = $options;
        $this->createClient();

        return new FlyDropboxAdapter($this->client);
    }

    /**
     * Create client
     */
    private function createClient()
    {
        $this->optionExists('access_token');

        try {
            $this->client = new Client($this->getSetting('access_token'));
        } catch (ConfigException $e) {
            echo 'Dropbox Error: '.$e->getMessage()."\n";
        }
    }
}
