<?php
namespace WScore\Ask\Locale;

class Locale
{
    /**
     * @var LanguageInterface
     */
    private $messages;

    /**
     * Locale constructor.
     * @param string $locale
     */
    public function __construct($locale)
    {
        if (strlen($locale) === 2) {
            $locale = __NAMESPACE__ . '\\Lang' . ucwords($locale);
        }
        if (class_exists($locale)) {
            $this->messages = new $locale;
        } else {
            throw new \InvalidArgumentException("unknown local: " . $locale);
        }
    }

    /**
     * @param string $item
     * @return string
     */
    public function getMessage($item)
    {
        return $this->messages->getMessage($item);
    }

    /**
     * @return string
     */
    public function getLocale()
    {
        return $this->messages->getLocale();
    }
}