<?php

namespace AnyCloud\Service\File\Adapter;

use AnyCloud\Traits\CommonTrait;
use League\Flysystem\Rackspace\RackspaceAdapter as RSAdapter;
use Omeka\File\Exception\ConfigException;
use OpenCloud\Common\Exceptions\CdnNotAvailableError;
use OpenCloud\OpenStack;

class RackspaceAdapter implements AdapterInterface
{
    use CommonTrait;

    protected $options;
    private $client;
    private $uri;

    /**
     * {@inheritdoc}
     */
    public function createAdapter($options): RSAdapter
    {
        $this->options = $options;
        $this->createClient();

        return new RSAdapter($this->client);
    }

    /**
     * Find the public base URL for the resource.
     *
     * @return string Base URL for the resource
     */
    public function getUri(): string
    {
        if (empty($this->Uri)) {
            $this->createClient();
        }

        return $this->uri;
    }

    /**
     * Create client.
     */
    private function createClient(): void
    {
        $this->optionExists('identity_endpoint');
        $this->optionExists('username');
        $this->optionExists('password');
        $this->optionExists('region');
        $this->optionExists('container');

        try {
            $method = $this->getSetting('identity_endpoint');
            $client = new OpenStack(constant('OpenCloud\Rackspace::'.$method), [
                'username' => $this->getSetting('username'),
                'password' => $this->getSetting('password'),
            ]);
            $store = $client->objectStoreService('cloudFiles', $this->getSetting('region'), 'publicURL');
            $this->client = $store->getContainer($this->getSetting('container'));
            $this->uri = $this->client->getCdn()->getCdnUri();
        } catch (CdnNotAvailableError $e) {
            echo 'Rackspace Error: '.$e->getMessage()."\n";
        } catch (ConfigException $e) {
            echo 'Rackspace Error: '.$e->getMessage()."\n";
        }
    }
}
