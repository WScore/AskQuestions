<?php
namespace WScore\Ask\Validator;

use WScore\Ask\Interfaces\ElementInterface;

class Result
{
    /**
     * @var ElementInterface
     */
    private $element;

    private $value;

    private $isValid;

    private $message;

    /**
     * Result constructor.
     * @param ElementInterface $element
     * @param string $value
     */
    private function __construct(ElementInterface $element, $value)
    {
        $this->element = $element;
        $this->value = $value;
    }

    /**
     * @param ElementInterface $element
     * @param string $value
     * @return Result
     */
    public static function success(ElementInterface $element, $value)
    {
        $self = new self($element, $value);
        $self->isValid = true;
        $self->message = null;

        return $self;
    }

    /**
     * @param ElementInterface $element
     * @param string|string[] $value
     * @param string $message
     * @return Result
     */
    public static function fail(ElementInterface $element, $value, $message)
    {
        $self = new self($element, $value);
        $self->isValid = false;
        $self->message = $message;

        return $self;
    }

    /**
     * @return string
     */
    public function name()
    {
        return $this->element->name();
    }

    /**
     * @return string
     */
    public function label()
    {
        return $this->element->label();
    }

    /**
     * @return string|string[]
     */
    public function value()
    {
        return $this->value;
    }

    /**
     * @param string $conn
     * @return string
     */
    public function showValue($conn = "\n")
    {
        $display = [];
        $values = (array) $this->value;
        foreach ($values as $value) {
            $display[] = $this->element->isOptionDefined($value)
                ? $this->element->getOptionLabel($value)
                : $value;
        }
        return implode($conn, $display);
    }

    /**
     * @return bool
     */
    public function isValid()
    {
        return $this->isValid;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }
}