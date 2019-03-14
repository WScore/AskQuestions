<?php

namespace WScore\Ask\Locale;

class LangJa implements LanguageInterface
{
    private $messages = [
        LanguageInterface::MESSAGE_REQUIRED => '必須項目です',
        LanguageInterface::MESSAGE_NOT_AVAILABLE => '選択できない値が含まれています',
        LanguageInterface::MESSAGE_NOT_SELECTABLE => '入力は選択できません',
    ];

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