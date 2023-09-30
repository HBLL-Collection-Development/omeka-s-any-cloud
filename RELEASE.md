This patch allows to configure the module entirely from `local.config.php` by doing two things:

It creates a Laminas service for each adapter, so that administrators can configure which adapter to use by modifying the `Omeka\File\Store` alias directly in `local.config.php`. For instance
```
    'Omeka\File\Store' => 'AnyCloud\File\Store\Scaleway'
```
Doing this prevents using the local store by mistake (for instance when the module is disabled or needs to be updated)

It allows to configure each adapter in the `file_store` section of `local.config.php`. For instance you can set up the dropbox adapter like this:
```
    'file_store' => [
        'dropbox' => [
            'access_token' => 'ACCESS_TOKEN',
        ],
    ],
```
This is to avoid exposing secrets through Omeka administration interface

When an adapter is configured like this, its corresponding section is disabled in the admin configuration form

Fixes #19
