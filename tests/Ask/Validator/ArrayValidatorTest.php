<?php
/**
 * Created by PhpStorm.
 * User: asao
 * Date: 2019-03-15
 * Time: 10:53
 */

use WScore\Ask\Element\Checkbox;
use WScore\Ask\Interfaces\ElementInterface;
use WScore\Ask\Validator\ArrayValidator;
use PHPUnit\Framework\TestCase;
use WScore\Ask\Validator\Result;

class ArrayValidatorTest extends TestCase
{
    /**
     * @param ElementInterface $element
     * @return ArrayValidator
     */
    private function buildValidator(ElementInterface $element)
    {
        return new ArrayValidator($element);
    }

    /**
     * @param string $name
     * @param string $label
     * @return Checkbox
     */
    private function buildCheck($name = 'test-valid', $label = 'test-label')
    {
        return (new Checkbox($name, $label))
            ->addOption('test1', 'label1')
            ->addOption('test2', 'label2');
    }

    public function testValidInput()
    {
        $validator = $this->buildValidator($this->buildCheck());
        $result = $validator->validate(['test1', 'test2']);
        $this->assertTrue($result->isValid());
        $this->assertEquals(Result::class, get_class($result));
        $this->assertEquals(['test1', 'test2'], $result->value());
        $this->assertEquals('test-valid', $result->name());
        $this->assertEquals('test-label', $result->label());
        $this->assertEquals('', $result->getMessage());
        $this->assertEquals('label1-label2', $result->showValue('-'));
    }

    public function testInvalidInput()
    {
        $validator = $this->buildValidator($this->buildCheck());
        $result = $validator->validate(['bad', 'test2']);
        $this->assertFalse($result->isValid());
        $this->assertEquals(null, $result->value());
        $this->assertEquals('test-valid', $result->name());
        $this->assertEquals('test-label', $result->label());
        $this->assertEquals('選択できない値が含まれています', $result->getMessage());
        $this->assertEquals('', $result->showValue('-'));
    }

    public function testNotRequiredInput()
    {
        $validator = $this->buildValidator($this->buildCheck()->required(false));
        $result = $validator->validate([]);
        $this->assertTrue($result->isValid());
        $this->assertEquals(null, $result->value());
        $this->assertEquals('test-valid', $result->name());
        $this->assertEquals('test-label', $result->label());
        $this->assertEquals('', $result->getMessage());
        $this->assertEquals('', $result->showValue('-'));
    }

    public function testMissingRequiredInput()
    {
        $validator = $this->buildValidator($this->buildCheck()->required(false));
        $result = $validator->validate([]);
        $this->assertTrue($result->isValid());
        $this->assertEquals('', $result->value());
        $this->assertEquals('test-valid', $result->name());
        $this->assertEquals('test-label', $result->label());
        $this->assertEquals('', $result->getMessage());
        $this->assertEquals('', $result->showValue('-'));
    }
}
