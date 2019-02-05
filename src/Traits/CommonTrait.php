<?php

namespace AnyCloud\Traits;

use Omeka\File\Exception\ConfigException;

trait CommonTrait
{
    protected $options;

    /**
     * {@inheritdoc}
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

    public function getAdapter()
    {
        $array = $this->options->get(['anycloud_adapter'][0]);

        return $array['adapter'];
    }

    public function getSetting($name)
    {
        $options = $this->options->get(['anycloud_'.$this->getAdapter()][0]);

        if (isset($options[$this->getAdapter().'_'.$name])) {
            return $options[$this->getAdapter().'_'.$name];
        } else {
            return;
        }
    }
}
