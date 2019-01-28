<?php

namespace AnyCloud\Service\File\Adapter;

use Aws\S3\S3Client;
use Aws\Exception\AwsException;
use League\Flysystem\AwsS3v3\AwsS3Adapter;
use Omeka\File\Exception\ConfigException;

class AwsAdapter implements AdapterInterface
{
    private $options;
    private $client;

    /**
     * {@inheritDoc}
     */
    public function createAdapter($options)
    {
        $this->options = $options;
        $this->createClient();

        return new AwsS3Adapter($this->client, $options['aws_bucket']);
    }

    /**
     * {@inheritDoc}
     */
    public function optionExists($option, $allowNull = false)
    {
        if (isset($this->options[$option]) || $allowNull === true) {
            return true;
        } else {
            throw new ConfigException("Any Cloud Error: Option `$option` has not been properly set.\n".$e."\n");
        }
    }

    private function createClient()
    {
        $this->optionExists('aws_key');
        $this->optionExists('aws_secret_key');
        $this->optionExists('aws_bucket');
        $this->optionExists('aws_region');
        $version = isset($this->options['aws_version']) ? $this->options['aws_version'] : 'latest';

        try {
            $clientArray = [
                'credentials' => [
                    'key' => $this->options['aws_key'],
                    'secret' => $this->options['aws_secret_key'],
                ],
                'region' => $this->options['aws_region'],
                'version' => $version,
            ];
            $endpoint = $this->optionExists('aws_endpoint', true);
            $clientArray['endpoint'] = ($endpoint && !empty($this->options['aws_endpoint']) && $this->options['aws_endpoint'] !== '') ? $this->options['aws_endpoint'] : null;
            $this->client = new S3Client($clientArray);
        } catch (AwsException $e) {
            echo 'AWS Error: '.$e->getMessage()."\n";
        }
    }
}
