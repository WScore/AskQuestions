<?php
/**
 * Created by PhpStorm.
 * User: asao
 * Date: 2019-03-14
 * Time: 17:28
 */

namespace Elements;

use PHPUnit\Framework\TestCase;
use WScore\Ask\Element\Text;

require_once __DIR__ . '/../../../vendor/autoload.php';

class AbstractElementTest extends TestCase
{
    /**
     * @param string $name
     * @param string $label
     * @return Text
     */
    private function build($name = 'test-name', $label = 'test-label')
    {
        return new Text($name, $label);
    }

    public function testIsRequired()
    {
        $text = $this->build();
        $this->assertTrue($text->isRequired());
    }

    public function testGetRawOptions()
    {
        $text = $this->build()
            ->addOption('test1', 'option1')
            ->addOption('test2', 'option2');
        $this->assertEquals([
            'test1' => 'option1',
            'test2' => 'option2'],
            $text->getRawOptions());

    }

    public function testSetAndGetMessage()
    {
        $text = $this->build();
        $this->assertEquals('', $text->getMessage());
        $text = $this->build()->setMessage('not-bad');
        $this->assertEquals('not-bad', $text->getMessage());
    }

    public function testRequired()
    {
        $text = $this->build()->required(false);
        $this->assertFalse($text->isRequired());

    }

    public function testOptions()
    {
        $text = $this->build('test-options')
            ->addOption('test1', 'option1')
            ->addOption('test2', 'option2');
        list($opt1, $opt2) = $text->options();
        $this->assertTrue($text->hasOptions());
        $this->assertEquals('option2', $text->getOptionLabel('test2'));
        $this->assertEquals(Text::class, get_class($opt1));
        $this->assertEquals('test-options', $opt1->name());
        $this->assertEquals('test1', $opt1->value());
        $this->assertEquals('test2', $opt2->value());
    }

    public function testIsOptionDefined()
    {
        $text = $this->build()
            ->addOption('test', 'option');
        $this->assertTrue($text->isOptionDefined('test'));
        $this->assertFalse($text->isOptionDefined('bad'));
    }

    public function testHasOptions()
    {
        $text = $this->build();
        $this->assertFalse($text->hasOptions());

        $text = $this->build()
            ->addOption('test', 'option');
        $this->assertTrue($text->hasOptions());
    }

    public function testLabel()
    {
        $text = $this->build('test', 'label-test');
        $this->assertEquals('label-test', $text->label());
    }

    public function testName()
    {
        $text = $this->build('test-name');
        $this->assertEquals('test-name', $text->name());
    }

    public function testPlaceholder()
    {
        $text = $this->build()->setPlaceholder('place-holder');
        $this->assertEquals('place-holder', $text->placeholder());
    }
}
