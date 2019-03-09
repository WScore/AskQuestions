<?php
namespace WScore\Ask\Element;

use WScore\Ask\Interfaces\ElementInterface;

class Checkbox extends AbstractElement
{
    /**
     * TextArea constructor.
     * @param string $name
     * @param string $label
     * @param string $value
     */
    public function __construct($name, $label, $value = null)
    {
        $this->name = $name;
        $this->label = $label;
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return ElementInterface::TYPE_CHECKBOX;
    }

    /**
     * @return self[]
     */
    public function options()
    {
        $options = [];
        $idx = 0;
        foreach($this->options as $value => $label) {
            $option = clone($this);
            $option->name = $this->name . '[]';
            $option->value = $value;
            $option->label = $label;
            $options[] = $option;
            $idx ++;
        }
        return $options;
    }
}