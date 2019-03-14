<?php

namespace WScore\Ask\Locale;

class LangEn implements LanguageInterface
{
    private $messages = [
        LanguageInterface::MESSAGE_REQUIRED => 'required item',
        LanguageInterface::MESSAGE_NOT_AVAILABLE => 'invalid value',
        LanguageInterface::MESSAGE_NOT_SELECTABLE => 'not a selectable item',
    ];

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