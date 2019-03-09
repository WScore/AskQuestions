<?php

namespace WScore\Ask\Interfaces;

interface ElementInterface
{
    const TYPE_TEXT = 'Text';
    const TYPE_TEXTAREA = 'TextArea';
    const TYPE_CHECKBOX = 'Checkbox';
    const TYPE_SELECT = 'Select';
    const TYPE_RADIO = 'Radio';

    /**
     * @return string
     */
    public function getType();

    /**
     * @param bool $required
     * @return $this
     */
    public function required($required = true);

    /**
     * @return bool
     */
    public function isRequired();

    /**
     * @return string
     */
    public function label();

    /**
     * @return string
     */
    public function name();

    /**
     * @return string
     */
    public function value();

    /**
     * @return bool
     */
    public function hasOptions();

    /**
     * @return self[]
     */
    public function options();

    /**
     * @param string $value
     * @param string $name
     * @return $this
     */
    public function addOption($value, $name = null);

    /**
     * @param string $message
     * @return self
     */
    public function setMessage($message);

    /**
     * @return string
     */
    public function getMessage();
}