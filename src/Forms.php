<?php
namespace WScore\Ask;

use WScore\Ask\Form\Builder;
use WScore\Ask\Interfaces\ElementInterface;
use WScore\Ask\Interfaces\FormInterface;

class Forms
{
    /**
     * @var ElementInterface[]
     */
    private $elements;

    /**
     * Forms constructor.
     * @param ElementInterface[] $elements
     */
    public function __construct($elements)
    {
        $this->elements = $elements;
    }

    /**
     * @param $name
     * @return FormInterface
     */
    public function getElement($name)
    {
        if (!isset($this->elements[$name])) {
            throw new \InvalidArgumentException();
        }
        $element = $this->elements[$name];

        return Builder::form($element);
    }
}