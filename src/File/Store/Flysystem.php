<?php

namespace AnyCloud\File\Store;

use League\Flysystem\Filesystem;
use League\Flysystem\Visibility;
use Omeka\File\Store\StoreInterface;

class Flysystem implements StoreInterface
{
    protected $filesystem;

    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    public function put($source, $storagePath)
    {
        $fh = fopen($source, 'r');
        if ($fh === false) {
            throw new \Omeka\File\Exception\RuntimeException(sprintf('Failed to open "%s"', $source));
        }

        $config = ['visibility' => Visibility::PUBLIC];
        $this->filesystem->writeStream($storagePath, $fh, $config);
        fclose($fh);
    }

    public function delete($storagePath)
    {
        $this->filesystem->delete($storagePath);
    }

    public function getUri($storagePath)
    {
        return $this->filesystem->publicUrl($storagePath);
    }
}
