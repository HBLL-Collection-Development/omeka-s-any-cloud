<?php

namespace AnyCloud\Traits;

use Omeka\File\Exception\ConfigException;

trait CommonTrait
{
    protected $options;

    /**
     * {@inheritDoc}
     */
    public function optionExists($option, $allowNull = false)
    {
        $option = $this->getSetting($option);
        if ((isset($option) && !empty($option)) || $allowNull === true) {
            return true;
        } else {
            throw new ConfigException("Any Cloud Error: Option `$option` for adapter `".$this->options['adapter']."` has not been properly set.\n");
        }
    }

    public function getSetting($name)
    {
        return $this->options->get('anycloud_'.$name);
    }
}
