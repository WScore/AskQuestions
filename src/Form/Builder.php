<?php
namespace WScore\Ask\Form;

use WScore\Ask\Interfaces\ElementInterface;
use WScore\Ask\Interfaces\FormInterface;

class Builder
{
    /**
     * @param ElementInterface $element
     * @return FormInterface
     */
    public static function form(ElementInterface $element)
    {
        $class = __NAMESPACE__ . '\\' . $element->getType() . 'Form';
        if (!class_exists($class)) {
            throw new \InvalidArgumentException();
        }
        return new $class($element);
    }
}