# Any Cloud Storage (Omeka S Module)
This module allows you to store your Omeka S files on one of the following external cloud platforms rather than the local server disk:
* [Amazon S3 Storage](https://aws.amazon.com/s3/)
* [Microsoft Azure Storage](https://azure.microsoft.com/en-us/services/storage/)
* [Google Cloud Storage](https://cloud.google.com/storage/)
* [Rackspace Files](https://www.rackspace.com/cloud/files)
* [DigitalOcean Spaces](https://www.digitalocean.com/products/spaces/) (uses the Amazon S3 Storage adapter)
* [Scaleway Object Storage](https://www.scaleway.com/object-storage/) (uses the Amazon S3 Storage adapter)
* [Dropbox](https://www.dropbox.com)

It uses a filesystem abstraction system called [Flysystem](http://flysystem.thephpleague.com/docs/). You can build your own adapters to use with the system if there is a cloud storage system you would like to use but is not currently available via this module.

It is recommended that once you pick an external storage service you continue using it as migrating to a different external file system is not currently supported.

# Installation and Configuration
1. Install the plugin by [downloading and unzipping the latest module](https://github.com/HBLL-Collection-Development/omeka-s-any-cloud/releases) and loading it into the `modules` directory of your Omeka S instance.
2. Enable the plugin from the Admin side of your installation under "Modules".
3. Add one of the following sections to your `config/local.config.php` file:

## Amazon S3 Storage, DigitalOcean Spaces, and Scaleway Object Storage

All 3 of these services are set up as though they are an Amazon S3 Storage system:

```php
'any_cloud' => [
    'adapter' => 'aws', // or `digital_ocean` or `scaleway_object_storage`
    'key' => 'YOUR KEY',
    'secret_key' => 'YOUR SECRET KEY',
    'bucket' => 'YOUR BUCKET NAME',
    'region' => 'YOUR BUCKET REGION',
    'endpoint' => '', // can leave blank unless you have set up custom endpoint URLs
],
```

## Microsoft Azure Storage

```php
'any_cloud' => [
    'adapter' => 'azure',
    'azure_account_name' => 'YOUR_ACCOUNT_NAME',
    'azure_account_key' => 'YOUR ACCOUNT KEY',
    'azure_container_name' => 'YOUR CONTAINER NAME',
    'azure_endpoint' => '', // can leave blank unless you have set up custom endpoint URLs
],
```

## Rackspace Files

The Rackspace Files adapter currently relies on an outdated version of the Guzzle package which causes problems authenticating to the service. See [this forum posting](https://community.rackspace.com/products/f/dedicated-hybrid-hosting-forum/8674/rackspace-public-cloud-php-opencloud-sdk-errors-due-to-outdated-certificate-authority-list/14415#14415) for the solution which involves downloading an updated security certificate and placing it in the correct directory in the `vendor` directory. There are several issues requesting a fix but I don't know when those will be resolved. Until then, the instructions in that forum work well.

There is also an authentication issue if you use Multi-Factor Authentication (MFA). MFA must be disabled on your account for this adapter to work. Hopefully both of these issues are addressed soon.

```php
'any_cloud' => [
    'adapter' => 'rackspace',
    'rackspace_identity_endpoint' => 'YOUR ENDPOINT', // 2 valid options are `US_IDENTITY_ENDPOINT` or `UK_IDENTITY_ENDPOINT`
    'rackspace_username' => 'YOUR USERNAME',
    'rackspace_password' => 'YOUR PASSWORD',
    'rackspace_container' => 'YOUR CONTAINER NAME',
    'rackspace_region' => 'YOUR REGION', // `DFW` for example
],
```

## Dropbox

Sign up for a Dropbox developer account, create an app and get an access token. Your app only needs access to one folder and not your entire Dropbox unless you plan on saving things in lots of different places in Dropbox.

```php
'any_cloud' => [
    'adapter' => 'dropbox',
    'dropbox_access_token' => 'YOUR ACCESS TOKEN,
],
```

## Google Cloud storage

```php
'any_cloud' => [
    'adapter' => 'google',
    'google_project_id' => 'YOUR PROJECT ID',
    'google_bucket_name' => 'YOUR BUCKET NAME',
    'google_credentials_path' => '/src/Service/File/Adapter/Google/your_authentication_credentials.json', // Can be downloaded from Google and must be stored in this directory of the module
    'google_storage_uri' => 'https://storage.googleapis.com', // Shouldn't need to change unless you have a custom URI setup
],
```

After that, when you upload media for an item, it will upload to your selected cloud service rather than to your server's local storage.

# Warning

Use this module at your own risk.

It’s always recommended to backup your files and databases and to check your archives regularly so you can roll back if needed.

# Troubleshooting

See online issues on the [module issues](https://github.com/HBLL-Collection-Development/omeka-s-any-cloud/issues) page on GitHub.

# TODO

1. - [X] Remove need for users to manually change the alias in `config/local.config.php` (v0.2.0)
2. - [ ] Move all config data to a form so users can use the admin module system to enter their credentials without the need to access server files
3. - [ ] Provide more detailed instructions on setting up each cloud storage system (possibly using the GitHub wiki)

# Possible Enhancements

1. - [ ] Add more cloud adapters (OneDrive, Box.com)