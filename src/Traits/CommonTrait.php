<?php

namespace AnyCloud\Traits;

use Omeka\File\Exception\ConfigException;

trait CommonTrait
{
    protected $options;
    protected $prefix;

    /**
     * {@inheritDoc}
     */
    public function optionExists($option, $allowNull = false)
    {
        $option = $this->getSetting($option);
        if ((isset($option) && !empty($option)) || $allowNull === true) {
            return true;
        } else {
            throw new ConfigException("Any Cloud Error: Option `$option` for adapter `".$this->getSetting('adapter')."` has not been properly set.\n");
        }
    }

    public function setPrefix()
    {
        return $this->getSetting('adapter').'_';
    }

    public function getSetting($name)
    {
        return $this->options->get('anycloud_'.$this->prefix.$name);
    }
}
