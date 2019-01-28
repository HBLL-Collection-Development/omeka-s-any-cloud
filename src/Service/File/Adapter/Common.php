<?php

namespace AnyCloud\Service\File\Adapter;

use Omeka\File\Exception\ConfigException;

trait Common
{
    protected $options;

    /**
     * {@inheritDoc}
     */
    public function optionExists($option, $allowNull = false)
    {
        if (isset($this->options[$option]) || $allowNull === true) {
            return true;
        } else {
            throw new ConfigException("Any Cloud Error: Option `$option` for adapter `".$this->options['adapter']."` has not been properly set.\n");
        }
    }
}
