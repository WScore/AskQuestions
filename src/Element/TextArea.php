<?php
namespace WScore\Ask\Element;

use WScore\Ask\Interfaces\ElementInterface;

class TextArea extends AbstractElement
{
    /**
     * TextArea constructor.
     * @param string $name
     * @param string $label
     */
    public function __construct($name, $label)
    {
        $this->name = $name;
        $this->label = $label;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return ElementInterface::TYPE_TEXTAREA;
    }
}