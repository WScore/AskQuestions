<?php
namespace WScore\Ask\Element;

use WScore\Ask\Interfaces\ElementInterface;

class Radio extends AbstractElement
{
    /**
     * TextArea constructor.
     * @param string $name
     * @param string $label
     * @param array $options
     */
    public function __construct($name, $label, $options = [])
    {
        $this->name = $name;
        $this->label = $label;
        $this->options = $options;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return ElementInterface::TYPE_RADIO;
    }

    /**
     * @return self[]
     */
    public function options()
    {
        $options = [];
        foreach($this->options as $value => $label) {
            $option = clone($this);
            $option->value = $value;
            $option->label = $label;
            $options[] = $option;
        }
        return $options;
    }
}