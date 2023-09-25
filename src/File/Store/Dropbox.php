<?php

namespace AnyCloud\File\Store;

class Dropbox extends Flysystem
{
    public function getUri($storagePath)
    {
        return $this->filesystem->temporaryUrl($storagePath);
    }
}
