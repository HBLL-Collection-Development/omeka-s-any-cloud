<?php

namespace AnyCloud\Service\File\Adapter;

use AnyCloud\Traits\CommonTrait;
use Aws\S3\S3Client;
use Aws\Exception\AwsException;
use League\Flysystem\AwsS3v3\AwsS3Adapter;

class AwsAdapter implements AdapterInterface
{
    use CommonTrait;

    protected $options;
    private $prefix;
    private $client;

    /**
     * {@inheritDoc}
     */
    public function createAdapter($options)
    {
        $this->options = $options;
        $this->prefix = $this->getSetting('adapter').'_';
        $this->createClient();
        return new AwsS3Adapter($this->client, $this->getSetting($this->prefix.'bucket'));
    }

    private function createClient()
    {
        $this->optionExists($this->prefix.'key');
        $this->optionExists($this->prefix.'secret_key');
        $this->optionExists($this->prefix.'bucket');
        $this->optionExists($this->prefix.'region');
        $version = empty($this->getSetting($this->prefix.'version')) ? 'latest' : $this->getSetting($this->prefix.'version');

        try {
            $clientArray = [
                'credentials' => [
                    'key' => $this->getSetting($this->prefix.'key'),
                    'secret' => $this->getSetting($this->prefix.'secret_key'),
                ],
                'region' => $this->getSetting($this->prefix.'region'),
                'version' => $version,
            ];
            $endpoint = $this->optionExists($this->prefix.'endpoint', true);
            $clientArray['endpoint'] = ($endpoint && !empty($this->getSetting($this->prefix.'endpoint')) && $this->getSetting($this->prefix.'endpoint') !== '') ? $this->getSetting($this->prefix.'endpoint') : null;
            $this->client = new S3Client($clientArray);
        } catch (AwsException $e) {
            echo 'AWS Error: '.$e->getMessage()."\n";
        }
    }
}
