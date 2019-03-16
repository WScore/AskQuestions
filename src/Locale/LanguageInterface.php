<?php

namespace WScore\Ask\Locale;

interface LanguageInterface
{
    const MESSAGE_REQUIRED = 'required';
    const MESSAGE_NOT_SELECTABLE = 'notSelectable';
    const MESSAGE_NOT_AVAILABLE = 'notAvailable';

    /**
     * return local string, such as 'en' or 'ja'.
     *
     * @return string
     */
    public function getLocale();

    /**
     * return error message for the $item,
     * which are defined as constants in this interface.
     *
     * @param string $item
     * @return string
     */
    public function getMessage($item);
}