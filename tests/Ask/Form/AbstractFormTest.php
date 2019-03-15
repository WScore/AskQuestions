<?php
/**
 * Created by PhpStorm.
 * User: wsjp
 * Date: 2019/03/15
 * Time: 20:06
 */

use WScore\Ask\Element\Text;
use PHPUnit\Framework\TestCase;
use WScore\Ask\Form\TextForm;
use WScore\Ask\Interfaces\ElementInterface;

class AbstractFormTest extends TestCase
{
    /**
     * @param string $name
     * @param string $label
     * @return Text
     */
    private function buildText($name = 'test-valid', $label = 'test-label')
    {
        return new Text($name, $label);
    }

    /**
     * @param ElementInterface $element
     * @return \WScore\Ask\Interfaces\FormInterface
     */
    private function buildForm(ElementInterface $element)
    {
        return new TextForm($element);
    }

    public function testGetElement()
    {
        $form = $this->buildForm($this->buildText());
        $this->assertEquals(TextForm::class, get_class($form));
        $this->assertEquals(Text::class, get_class($form->getElement()));

        $label = $form->makeLabel();
        $this->assertStringContainsString('>test-label<', $label);
        $this->assertStringContainsString('for="test-valid"', $label);

        $html = $form->makeForm();
        $this->assertStringContainsString('<input type=\'text\'', $html);
        $this->assertStringContainsString('name="test-valid"', $html);
    }
}
