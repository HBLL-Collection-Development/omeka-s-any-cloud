<?php

namespace AnyCloud\Traits;

use Omeka\File\Exception\ConfigException;

trait CommonTrait
{
    protected $options;

    /**
     * {@inheritdoc}
     */
    public function optionExists($option, $allowNull = false): bool
    {
        $option = $this->getSetting($option);

        if ((isset($option) && !empty($option)) || $allowNull === true) {
            return true;
        }

        throw new ConfigException("Any Cloud Error: Option `$option` for adapter `".$this->getSetting('adapter')."` has not been properly set.\n");
    }

    /**
     * Get the adapter.
     *
     * @return string Adapter name as a string
     */
    public function getAdapter(): string
    {
        $array = $this->options->get(['anycloud_adapter'][0]);

        return $array['adapter'];
    }

    /**
     * Get the setting.
     *
     * @param string $name Name of the desired setting to retrieve
     *
     * @return string|null
     */
    public function getSetting($name): ?string
    {
        $options = $this->options->get(['anycloud_'.$this->getAdapter()][0]);

        return $options[$this->getAdapter().'_'.$name] ?? null;
    }
}
