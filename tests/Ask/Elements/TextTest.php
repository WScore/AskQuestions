<?php
/**
 * Created by PhpStorm.
 * User: asao
 * Date: 2019-03-14
 * Time: 17:26
 */

namespace Elements;

use PHPUnit\Framework\TestCase;
use WScore\Ask\Element\Text;

class TextTest extends TestCase
{
    public function testGetType()
    {
        $text = new Text('test', 'text');
        $this->assertEquals('Text', $text->getType());
    }
}
