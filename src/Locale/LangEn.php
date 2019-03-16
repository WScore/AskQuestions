<?php

namespace WScore\Ask\Locale;

class LangEn implements LanguageInterface
{
    public static $msg_required = 'required item';
    public static $msg_not_available = 'invalid value';
    public static $msg_not_selectable = 'not a selectable item';

    /**
     * @var string[]
     */
    private $messages = [];

    /**
     * LangEn constructor.
     */
    public function __construct()
    {
        $this->messages = [
            LanguageInterface::MESSAGE_REQUIRED => self::$msg_required,
            LanguageInterface::MESSAGE_NOT_AVAILABLE => self::$msg_not_available,
            LanguageInterface::MESSAGE_NOT_SELECTABLE => self::$msg_not_selectable,
        ];
    }

    /**
     * @return string
     */
    public function getLocale()
    {
        return 'en';
    }

    /**
     * @param string $item
     * @return string
     */
    public function getMessage($item)
    {
        if (isset($this->messages[$item])) {
            return $this->messages[$item];
        }
        throw new \InvalidArgumentException();
    }
}