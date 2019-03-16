<?php

namespace WScore\Ask\Locale;

class LangJa implements LanguageInterface
{
    public static $msg_required = '必須項目です';
    public static $msg_not_available = '選択できない値が含まれています';
    public static $msg_not_selectable = '入力は選択できません';

    /**
     * @var string[]
     */
    private $messages = [];

    /**
     * LangJa constructor.
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
        return 'ja';
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