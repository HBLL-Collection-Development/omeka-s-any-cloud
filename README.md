[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/HBLL-Collection-Development/omeka-s-any-cloud/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/HBLL-Collection-Development/omeka-s-any-cloud/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/HBLL-Collection-Development/omeka-s-any-cloud/badges/build.png?b=master)](https://scrutinizer-ci.com/g/HBLL-Collection-Development/omeka-s-any-cloud/build-status/master)
[![Maintainability](https://api.codeclimate.com/v1/badges/88231b9bfaa4e0397ef9/maintainability)](https://codeclimate.com/github/HBLL-Collection-Development/omeka-s-any-cloud/maintainability)
[![StyleCI](https://github.styleci.io/repos/167904424/shield)](https://github.styleci.io/repos/167904424)
[![DOI](https://zenodo.org/badge/DOI/10.5281/zenodo.2591621.svg)](https://doi.org/10.5281/zenodo.2591621)

# Any Cloud Storage (Omeka S Module)
This module allows you to store your Omeka S files on one of the following external cloud platforms rather than the local server disk:

- [Amazon S3 Storage](https://aws.amazon.com/s3/)
- [Microsoft Azure Storage](https://azure.microsoft.com/en-us/services/storage/)
- [Google Cloud Storage](https://cloud.google.com/storage/)
- [Wasabi Cloud Storage](https://wasabi.com) (uses the Amazon S3 Storage adapter)
- [DigitalOcean Spaces](https://www.digitalocean.com/products/spaces/) (uses the Amazon S3 Storage adapter)
- [Scaleway Object Storage](https://www.scaleway.com/object-storage/) (uses the Amazon S3 Storage adapter)
- [Dropbox](https://www.dropbox.com)

It uses a filesystem abstraction system called [Flysystem](http://flysystem.thephpleague.com/docs/). You can build your own adapters to use with the system if there is a cloud storage system you would like to use but is not currently available via this module.

It is recommended that once you pick an external storage service you continue using it as migrating to a different external file system is not currently supported.

## Installation and Configuration
1. Install the plugin by [downloading and unzipping the latest module](https://github.com/HBLL-Collection-Development/omeka-s-any-cloud/releases) and loading it into the `modules` directory of your Omeka S instance.
2. Enable the plugin from the Admin side of your installation under “Modules”.
3. Configure the module from the Admin side to include credentials for the cloud storage system you would like to use. You can also choose to configure the module from the `config/local.config.php` file (see [server-side configuration](#server-side-configuration))

After that, when you upload media for an item, it will upload to your selected cloud service rather than to your server’s local storage.

### Server-side configuration

It's possible to configure the module entirely by editing the
`config/local.config.php` file.

First, you need to change the alias for `Omeka\File\Store` to the adapter you
want to use, and then you have to configure the adapter itself inside the
`file_store` section.

For instance, if you want to use Dropbox, `config/local.config.php` should look like this:

```php
<?php

return [
    'service_manager' => [
        'aliases' => [
            'Omeka\File\Store' => 'AnyCloud\File\Store\Dropbox',
        ],
    ],
    'file_store' => [
        'dropbox' => [
            'access_token' => 'YOUR_ACCESS_TOKEN',
        ],
    ],
];
```

#### AWS

Alias should be set to `AnyCloud\File\Store\Aws`.

Available options:

```php
    'file_store' => [
        'aws' => [
            'key' => 'KEY',
            'secret' => 'SECRET',
            'region' => 'REGION',
            'endpoint' => 'ENDPOINT',
            'bucket' => 'BUCKET',
        ],
    ],
```

#### Azure

Alias should be set to `AnyCloud\File\Store\Azure`.

Available options:

```php
    'file_store' => [
        'azure' => [
            'account_name' => 'ACCOUNT_NAME',
            'account_key' => 'ACCOUNT_KEY',
            'container_name' => 'CONTAINER_NAME',
        ],
    ],
```

#### Digital Ocean

Alias should be set to `AnyCloud\File\Store\DigitalOcean`.

Available options:

```php
    'file_store' => [
        'digital_ocean' => [
            'key' => 'KEY',
            'secret' => 'SECRET',
            'region' => 'REGION',
            'endpoint' => 'ENDPOINT',
            'bucket' => 'BUCKET',
        ],
    ],
```

#### Dropbox

Alias should be set to `AnyCloud\File\Store\Dropbox`.

Available options:

```php
    'file_store' => [
        'dropbox' => [
            'access_token' => 'ACCESS_TOKEN',
        ],
    ],
```

#### Google

Alias should be set to `AnyCloud\File\Store\Google`.

Available options:

```php
    'file_store' => [
        'google' => [
            'project_id' => 'PROJECT_ID',
            'credentials_path' => '/path/to/credentials.json', // This path is relative to AnyCloud's module path
        ],
    ],
```

#### Scaleway

Alias should be set to `AnyCloud\File\Store\Scaleway`.

Available options:

```php
    'file_store' => [
        'scaleway' => [
            'key' => 'KEY',
            'secret' => 'SECRET',
            'region' => 'REGION',
            'endpoint' => 'ENDPOINT',
            'bucket' => 'BUCKET',
        ],
    ],
```

#### Wasabi

Alias should be set to `AnyCloud\File\Store\Wasabi`.

Available options:

```php
    'file_store' => [
        'wasabi' => [
            'key' => 'KEY',
            'secret' => 'SECRET',
            'region' => 'REGION',
            'endpoint' => 'ENDPOINT',
            'bucket' => 'BUCKET',
        ],
    ],
```

## Known Issues
1. No migration from one cloud/filesystem to another. Pick one or manually transfer things if you decide to change services.

## Warning
Use this module at your own risk.

It’s always recommended to backup your files and databases and to check your archives regularly so you can roll back if needed.

## Troubleshooting
See online issues on the [module issues](https://github.com/HBLL-Collection-Development/omeka-s-any-cloud/issues) page on GitHub.

## TODO
1. - [ ] Provide more detailed instructions on setting up each cloud storage system (possibly using the GitHub wiki)
2. - [X] Remove need for users to manually change the alias in `config/local.config.php` (v0.2.0)
3. - [X] Move all config data to a form so users can use the admin module system to enter their credentials without the need to access server files (v0.2.0)
4. - [X] Make config forms prettier and easier to use (v0.3.0)
5. - [X] Get a DOI for the software (v1.0.0)
6. - [X] Integrate a Wasabi cloud adapter (v1.1.0)

## Possible Enhancements
1. - [ ] Allow migration between different cloud platforms
2. - [ ] Support [Archive Repertory](https://github.com/Daniel-KM/Omeka-S-module-ArchiveRepertory)
3. - [ ] Write tests for module
4. - [ ] Support module translation
