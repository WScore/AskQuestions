<?php
/**
 * Created by PhpStorm.
 * User: wsjp
 * Date: 2019/03/16
 * Time: 10:43
 */

use WScore\Ask\Locale\LangEn;
use WScore\Ask\Locale\LanguageInterface;
use WScore\Ask\Locale\Locale;
use PHPUnit\Framework\TestCase;

class LocaleTest extends TestCase
{
    public function testGetLocale()
    {
        $locale = new Locale('en');
        $this->assertEquals(LangEn::$msg_required, $locale->getMessage(LanguageInterface::MESSAGE_REQUIRED));
    }

    public function testGetMessage()
    {
        $lang = new class implements LanguageInterface {
            public function getLocale()
            {
                return 'test-locale';
            }

            public function getMessage($item)
            {
                return 'test-message';
            }
        };
        $locale = new Locale($lang);
        $this->assertEquals('test-message', $locale->getMessage(LanguageInterface::MESSAGE_REQUIRED));
        $this->assertEquals('test-locale', $locale->getLocale());
    }

    public function testInvalidLangClass()
    {
        $this->expectException(\InvalidArgumentException::class);
        new Locale('bad-class');
    }
}
