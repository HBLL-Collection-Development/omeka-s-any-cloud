<?php

namespace AnyCloud;

return [
    'service_manager' => [
        'factories' => [
            'AnyCloud\File\Store\AnyCloud' => Service\File\Store\AnyCloudFactory::class,
        ],
    ],
];
