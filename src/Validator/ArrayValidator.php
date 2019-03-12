<?php
namespace WScore\Ask\Validator;

use WScore\Ask\Interfaces\ElementInterface;

class ArrayValidator
{
    /**
     * @var ElementInterface
     */
    private $element;

    /**
     * TextValidator constructor.
     * @param ElementInterface $element
     */
    public function __construct($element)
    {
        $this->element = $element;
    }

    /**
     * @param string $message
     * @return Result
     */
    protected function makeFail($message)
    {
        $message = $this->element->getMessage() ?: $message;
        return Result::fail($this->element, null, $message);
    }

    /**
     * @param string[] $raw_value
     * @return Result
     */
    public function validate($raw_value)
    {
        $value = [];
        foreach($raw_value as $v) {
            $v = trim($v);
            if ($v) $value[] = $v;
        }
        return $this->validateValue($value);
    }

    /**
     * @param string[] $value
     * @return Result
     */
    protected function validateValue($value)
    {
        if ($result = $this->checkRequired($value)) {
            return $result;
        }
        if ($result = $this->checkOptions($value)) {
            return $result;
        }
        return Result::success($this->element, $value);
    }

    /**
     * @param string[] $value
     * @return Result|null
     */
    protected function checkRequired($value)
    {
        if (!empty($value)) return null;
        if ($this->element->isRequired()) {
            return $this->makeFail('必須項目です');
        }
        return Result::success($this->element, null);
    }

    /**
     * @param string[] $value
     * @return Result|null
     */
    protected function checkOptions($value)
    {
        if (!$this->element->hasOptions()) return null;
        foreach($value as $v) {
            if (!$this->element->isOptionDefined($v)) {
                return $this->makeFail('選択できない値が含まれています');
            }
        }
        return null;
    }
}