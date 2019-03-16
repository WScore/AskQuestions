<?php
/**
 * Created by PhpStorm.
 * User: asao
 * Date: 2019-03-15
 * Time: 09:58
 */

use WScore\Ask\Element\Checkbox;
use WScore\Ask\Element\Radio;
use WScore\Ask\Element\Text;
use WScore\Ask\Interfaces\ElementInterface;
use WScore\Ask\Validator\Result;
use WScore\Ask\Validator\TextValidator;
use PHPUnit\Framework\TestCase;

class TextValidatorTest extends TestCase
{
    /**
     * @param ElementInterface $element
     * @return TextValidator
     */
    private function buildValidator(ElementInterface $element)
    {
        return new TextValidator($element);
    }

    /**
     * @param string $name
     * @param string $label
     * @return Text
     */
    private function buildText($name = 'test-valid', $label = 'test-label')
    {
        return new Text($name, $label);
    }

    public function testValidInput()
    {
        $validator = $this->buildValidator($this->buildText());
        $result = $validator->validate('tested');
        $this->assertTrue($result->isValid());
        $this->assertEquals(Result::class, get_class($result));
        $this->assertEquals('tested', $result->value());
        $this->assertEquals('test-valid', $result->name());
        $this->assertEquals('test-label', $result->label());
        $this->assertEquals('', $result->getMessage());
        $this->assertEquals('tested', $result->showValue('-'));
    }

    public function testNotRequiredInput()
    {
        $validator = $this->buildValidator($this->buildText()->required(false));
        $result = $validator->validate('');
        $this->assertTrue($result->isValid());
        $this->assertEquals(Result::class, get_class($result));
        $this->assertEquals('', $result->value());
        $this->assertEquals('test-valid', $result->name());
        $this->assertEquals('test-label', $result->label());
        $this->assertEquals('', $result->getMessage());
        $this->assertEquals('', $result->showValue('-'));
    }

    public function testInvalidInput()
    {
        $validator = $this->buildValidator($this->buildText()->required());
        $result = $validator->validate('');
        $this->assertFalse($result->isValid());
        $this->assertEquals('', $result->value());
        $this->assertEquals('test-valid', $result->name());
        $this->assertEquals('test-label', $result->label());
        $this->assertEquals('必須項目です', $result->getMessage());
        $this->assertEquals('', $result->showValue('-'));
    }

    public function testInvalidUtf8Required()
    {
        $bad = mb_convert_encoding('表組', 'SJIS-win', 'UTF-8');

        $validator = $this->buildValidator($this->buildText());
        $this->assertFalse(mb_check_encoding($bad, 'UTF-8'));
        $result = $validator->validate($bad);
        $this->assertFalse($result->isValid());
        $this->assertEquals('', $result->value());
        $this->assertEquals('test-valid', $result->name());
        $this->assertEquals('test-label', $result->label());
        $this->assertEquals('必須項目です', $result->getMessage());
        $this->assertEquals('', $result->showValue('-'));
    }

    public function testInvalidUtf8NotRequired()
    {
        $bad = mb_convert_encoding('表組', 'SJIS-win', 'UTF-8');

        $validator = $this->buildValidator($this->buildText()->required(false));
        $result = $validator->validate($bad);
        $this->assertTrue($result->isValid());
        $this->assertEquals('', $result->value());
        $this->assertEquals('test-valid', $result->name());
        $this->assertEquals('test-label', $result->label());
        $this->assertEquals('', $result->getMessage());
        $this->assertEquals('', $result->showValue('-'));
    }

    public function testXssInput()
    {
        $validator = $this->buildValidator($this->buildText()->required());
        $result = $validator->validate('bad<bad>\'bad\"');
        $this->assertTrue($result->isValid());
        $this->assertEquals('bad<bad>\'bad\"', $result->value());
        $this->assertEquals('test-valid', $result->name());
        $this->assertEquals('test-label', $result->label());
        $this->assertEquals('', $result->getMessage());
        $this->assertEquals('bad&lt;bad&gt;&#039;bad\&quot;', $result->showValue('-'));
    }

    public function testInvalidValueInput()
    {
        $validator = $this->buildValidator(
            new Checkbox('test-value', 'value-label', 'value!')
        );
        $result = $validator->validate('bad');
        $this->assertFalse($result->isValid());
        $this->assertEquals('', $result->value());
        $this->assertEquals('test-value', $result->name());
        $this->assertEquals('value-label', $result->label());
        $this->assertEquals('入力は選択できません', $result->getMessage());
        $this->assertEquals('', $result->showValue('-'));
    }

    public function testRadioInput()
    {
        $validator = $this->buildValidator(
            new Radio('test-value', 'value-label', [
                'test1' => 'label-1',
                'test2' => 'label-2',
            ])
        );
        $result = $validator->validate('test1');
        $this->assertTrue($result->isValid());
        $this->assertEquals('test1', $result->value());
        $this->assertEquals('test-value', $result->name());
        $this->assertEquals('value-label', $result->label());
        $this->assertEquals('', $result->getMessage());
        $this->assertEquals('label-1', $result->showValue('-'));
    }

    public function testInvalidRadioInput()
    {
        $validator = $this->buildValidator(
            new Radio('test-value', 'value-label', [
                'test1' => 'label-1',
                'test2' => 'label-2',
            ])
        );
        $result = $validator->validate('bad');
        $this->assertFalse($result->isValid());
        $this->assertEquals('', $result->value());
        $this->assertEquals('test-value', $result->name());
        $this->assertEquals('value-label', $result->label());
        $this->assertEquals('選択できない値です', $result->getMessage());
        $this->assertEquals('', $result->showValue('-'));
    }
}
