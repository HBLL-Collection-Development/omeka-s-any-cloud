<?php

namespace AnyCloud\Service\File\Adapter;

use OpenCloud\OpenStack;
use League\Flysystem\Rackspace\RackspaceAdapter as RSAdapter;
use Omeka\File\Exception\ConfigException;

class RackspaceAdapter implements AdapterInterface
{
    use Common;

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

        return new RSAdapter($this->client);
    }

    /**
     * Find the public base URL for the resource
     *
     * return string Base URL for the resource
     */
    public function getUri()
    {
        if (empty($this->Uri)) {
            $this->createClient();
        }
        return $this->uri;
    }

    /**
     * Create client
     */
    private function createClient()
    {
        $this->optionExists('rackspace_identity_endpoint');
        $this->optionExists('rackspace_username');
        $this->optionExists('rackspace_password');
        $this->optionExists('rackspace_region');
        $this->optionExists('rackspace_container');

        try {
            $method = $this->options['rackspace_identity_endpoint'];
            $client = new OpenStack(constant('OpenCloud\Rackspace::'.$method), [
                'username' => $this->options['rackspace_username'],
                'password' => $this->options['rackspace_password'],
            ]);
            $store = $client->objectStoreService('cloudFiles', $this->options['rackspace_region'], 'publicURL');
            $this->client = $store->getContainer($this->options['rackspace_container']);
            $this->uri = $this->client->getCdn()->getCdnUri();
        } catch (\OpenCloud\Common\Exceptions\CdnNotAvailableError $e) {
            echo 'Rackspace Error: '.$e->getMessage()."\n";
        } catch (ConfigException $e) {
            echo 'Rackspace Error: '.$e->getMessage()."\n";
        }
    }
}
