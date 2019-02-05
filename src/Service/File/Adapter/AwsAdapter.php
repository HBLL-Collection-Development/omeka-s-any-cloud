<?php

namespace AnyCloud\Service\File\Adapter;

use AnyCloud\Traits\CommonTrait;
use Aws\Exception\AwsException;
use Aws\S3\S3Client;
use League\Flysystem\AwsS3v3\AwsS3Adapter;

class AwsAdapter implements AdapterInterface
{
    use CommonTrait;

    protected $options;
    private $client;

    /**
     * {@inheritdoc}
     */
    public function createAdapter($options)
    {
        $this->options = $options;
        $this->createClient();

        return new AwsS3Adapter($this->client, $this->getSetting('bucket'));
    }

    private function createClient()
    {
        $this->optionExists('key');
        $this->optionExists('secret_key');
        $this->optionExists('bucket');
        $this->optionExists('region');
        $version = empty($this->getSetting('version')) ? 'latest' : $this->getSetting('version');

        try {
            $clientArray = [
                'credentials' => [
                    'key'    => $this->getSetting('key'),
                    'secret' => $this->getSetting('secret_key'),
                ],
                'region'  => $this->getSetting('region'),
                'version' => $version,
            ];
            $endpoint = $this->optionExists('endpoint', true);
            if ($endpoint && !empty($this->getSetting('endpoint')) && $this->getSetting('endpoint') !== '') {
                $clientArray['endpoint'] = $this->getSetting('endpoint');
            }
            $this->client = new S3Client($clientArray);
        } catch (AwsException $e) {
            echo 'AWS Error: '.$e->getMessage()."\n";
        }
    }
}
