<?php
namespace WScore\Ask\Validator;

use WScore\Ask\Interfaces\ElementInterface;

class TextValidator
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
     * @param string $value
     * @return Result
     */
    public function validate($value)
    {
        $value = (string) $value;
        return $this->validateValue($value);
    }

    /**
     * @param string $value
     * @return Result
     */
    protected function validateValue($value)
    {
        if ($result = $this->checkRequired($value)) {
            return $result;
        }
        if ($result = $this->checkValue($value)) {
            return $result;
        }
        if ($result = $this->checkOptions($value)) {
            return $result;
        }
        return Result::success($this->element, $value);
    }

    /**
     * @param string $value
     * @return Result|null
     */
    protected function checkRequired($value)
    {
        if ($value) return null;
        if ($this->element->isRequired()) {
            return $this->makeFail('必須項目です');
        }
        return Result::success($this->element, null);
    }

    /**
     * @param string $value
     * @return Result|null
     */
    protected function checkValue($value)
    {
        $correct_value = (string) $this->element->value();
        if ($correct_value && $correct_value !== $value) {
            return $this->makeFail('入力は選択できません');
        }
        return null;
    }

    /**
     * @param string $value
     * @return Result|null
     */
    protected function checkOptions($value)
    {
        if (!$this->element->hasOptions()) return null;
        if ($this->element->isOptionDefined($value)) return null;
        return $this->makeFail('選択できない値です');
    }
}