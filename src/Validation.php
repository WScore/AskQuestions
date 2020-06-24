<?php
namespace WScore\Ask;

use WScore\Ask\Interfaces\ElementInterface;
use WScore\Ask\Locale\Locale;
use WScore\Ask\Validator\ArrayValidator;
use WScore\Ask\Validator\Result;
use WScore\Ask\Validator\TextValidator;

class Validation
{
    /**
     * @var ElementInterface[]
     */
    private $elements;

    /**
     * @var Result[]
     */
    private $results = [];

    /**
     * @var bool
     */
    private $isValid = true;

    /**
     * @var array
     */
    private $inputs;

    /**
     * @var Locale
     */
    private $locale;

    /**
     * Validation constructor.
     * @param Locale $locale
     * @param ElementInterface[] $elements
     * @param array $inputs
     * @param null|callable|\Closure $validator
     */
    public function __construct(Locale $locale, $elements, array $inputs, $validator = null)
    {
        $this->locale = $locale;
        $this->elements = $elements;
        $this->inputs = $inputs;
        $this->validate($inputs);
        if ($validator) {
            $validator($this);
        }
    }

    private function validate($inputs)
    {
        foreach($this->elements as $name => $element) {
            $value = isset($inputs[$name]) ?$inputs[$name]: '';
            $result = $this->validateElement($element, $value);
            if (!$result->isValid()) {
                $this->isValid = false;
            }
            $this->results[$name] = $result;
        }
    }

    /**
     * @param ElementInterface $element
     * @param string|string[] $value
     * @return Result
     */
    private function validateElement(ElementInterface $element, $value)
    {
        if ($element->getType() === ElementInterface::TYPE_CHECKBOX && !empty($element->options())) {
            $value = (array) $value;
            $validator = new ArrayValidator($this->locale, $element);
            return $validator->validate($value);
        }
        $value = (string) $value;
        $validator = new TextValidator($this->locale, $element);
        return $validator->validate($value);
    }

    /**
     * @return bool
     */
    public function isValid()
    {
        return $this->isValid;
    }

    /**
     * @return Result[]
     */
    public function getResults()
    {
        return $this->results;
    }

    /**
     * @return array
     */
    public function getData()
    {
        $data = [];
        foreach ($this->results as $name => $result) {
            $data[$name] = $result->value();
        }
        return $data;
    }

    /**
     * @param string $name
     * @return Result|null
     */
    public function getResult($name)
    {
        return isset($this->results[$name]) ? $this->results[$name]: null;
    }

    /**
     * @param string $name
     * @param string|string[] $value
     * @param string $message
     * @return $this
     */
    public function setError($name, $value, $message)
    {
        $this->isValid = false;
        $element = isset($this->elements[$name]) ? $this->elements[$name]: null;
        $this->results[$name] = Result::fail($element, $value, $message);
        return $this;
    }
}