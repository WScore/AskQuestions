<?php
namespace WScore\Ask;

use WScore\Ask\Interfaces\ElementInterface;
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
     * Validation constructor.
     * @param ElementInterface[] $elements
     * @param array $inputs
     */
    public function __construct($elements, array $inputs)
    {
        $this->elements = $elements;
        $this->inputs = $inputs;
        $this->validate($inputs);
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
            $validator = new ArrayValidator($element);
            return $validator->validate($value);
        }
        $value = (string) $value;
        $validator = new TextValidator($element);
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
}