<?php
namespace WScore\Ask\Validator;

class Result
{
    private $name;

    private $value;

    private $isValid;

    private $message;

    /**
     * Result constructor.
     * @param string $name
     * @param string $value
     */
    private function __construct($name, $value)
    {
        $this->name = $name;
        $this->value = $value;
    }

    /**
     * @param string $name
     * @param string $value
     * @return Result
     */
    public static function success($name, $value)
    {
        $self = new self($name, $value);
        $self->isValid = true;
        $self->message = null;

        return $self;
    }

    /**
     * @param string $name
     * @param string|string[] $value
     * @param string $message
     * @return Result
     */
    public static function fail($name, $value, $message)
    {
        $self = new self($name, $value);
        $self->isValid = false;
        $self->message = $message;

        return $self;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string|string[]
     */
    public function getValue()
    {
        return $this->value;
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