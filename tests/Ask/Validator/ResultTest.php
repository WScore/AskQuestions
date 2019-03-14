<?php
/**
 * Created by PhpStorm.
 * User: asao
 * Date: 2019-03-14
 * Time: 17:59
 */

use WScore\Ask\Element\Text;
use WScore\Ask\Validator\Result;
use PHPUnit\Framework\TestCase;

class ResultTest extends TestCase
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

    public function testSuccess()
    {
        $good = Result::success($this->build(), 'success');
        $this->assertTrue($good->isValid());
        $this->assertEquals('success', $good->value());
        $this->assertEquals('test-name', $good->name());
        $this->assertEquals('test-label', $good->label());
        $this->assertEquals('', $good->getMessage());
    }

    public function testFail()
    {
        $failed = Result::fail($this->build(), 'failed', 'sorry');
        $this->assertFalse($failed->isValid());
        $this->assertEquals('failed', $failed->value());
        $this->assertEquals('test-name', $failed->name());
        $this->assertEquals('test-label', $failed->label());
        $this->assertEquals('sorry', $failed->getMessage());
    }

    public function testShowValue()
    {
        $good = Result::success($this->build(), ['success', 'failed']);
        $this->assertEquals('success-failed', $good->showValue('-'));
    }
}
