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
     * @var string
     */
    private $form_class = '';

    /**
     * @var string
     */
    private $label_class = '';

    /**
     * Forms constructor.
     * @param ElementInterface[] $elements
     */
    public function __construct($elements)
    {
        $this->elements = $elements;
    }

    /**
     * @param string $class
     * @return $this
     */
    public function setFormClass($class)
    {
        $this->form_class = $class;
        return $this;
    }

    /**
     * @param string $class
     * @return $this
     */
    public function setLabelClass($class)
    {
        $this->label_class = $class;
        return $this;
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

        $form = Builder::form($element);
        $form->setFormClass($this->form_class);
        $form->setLabelClass($this->label_class);
        return $form;
    }
}