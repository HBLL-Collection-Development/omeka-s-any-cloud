<?php

namespace AnyCloud\Service\File\Adapter;

use Aws\S3\S3Client;
use Aws\Exception\AwsException;
use League\Flysystem\AwsS3v3\AwsS3Adapter;

class AwsAdapter implements AdapterInterface
{
    use Common;

    protected $options;
    private $client;

    /**
     * {@inheritDoc}
     */
    public function createAdapter($options)
    {
        $this->options = $options;
        $this->createClient();

        return new AwsS3Adapter($this->client, $options['bucket']);
    }

    private function createClient()
    {
        $this->optionExists('key');
        $this->optionExists('secret_key');
        $this->optionExists('bucket');
        $this->optionExists('region');
        $version = isset($this->options['version']) ? $this->options['version'] : 'latest';

        try {
            $clientArray = [
                'credentials' => [
                    'key' => $this->options['key'],
                    'secret' => $this->options['secret_key'],
                ],
                'region' => $this->options['region'],
                'version' => $version,
            ];
            $endpoint = $this->optionExists('endpoint', true);
            $clientArray['endpoint'] = ($endpoint && !empty($this->options['endpoint']) && $this->options['endpoint'] !== '') ? $this->options['endpoint'] : null;
            $this->client = new S3Client($clientArray);
        } catch (AwsException $e) {
            echo 'AWS Error: '.$e->getMessage()."\n";
        }
    }
}
