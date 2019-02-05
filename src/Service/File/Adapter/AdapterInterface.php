<?php

namespace AnyCloud\Service\File\Adapter;

/**
 * Interface for AnyCloud adapters.
 *
 * Set up adapters for storage in various cloud services.
 */
interface AdapterInterface
{
    /**
     * Create the filesystem adapter.
     *
     * @param array $options Array of options needed to create an adapter
     *
     * return object Adapter needed to create the appropriate Filesystem object
     */
    public function createAdapter($options);

    /**
     * Determine whether an option exists or not.
     *
     * @param string $option    Array key value of option to check if it exists
     * @param bool   $allowNull Whether or not a `null` value is allowed for this option
     *
     * return bool `true` if value exists or is allowed to be `null`
     *
     * @return bool
     *
     * throws ConfigException if option not set correctly
     */
    public function optionExists($option, $allowNull = false);
}
