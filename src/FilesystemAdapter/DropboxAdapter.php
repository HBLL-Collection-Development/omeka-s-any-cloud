<?php

namespace AnyCloud\FilesystemAdapter;

use DateTimeInterface;
use League\Flysystem\Config;
use League\Flysystem\UrlGeneration\TemporaryUrlGenerator;

class DropboxAdapter extends \Spatie\FlysystemDropbox\DropboxAdapter implements TemporaryUrlGenerator
{
    public function temporaryUrl(string $path, DateTimeInterface $expiresAt, Config $config): string
    {
        return $this->client->getTemporaryLink($path);
    }
}
