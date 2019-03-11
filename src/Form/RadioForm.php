<?php
namespace WScore\Ask\Form;

class RadioForm extends AbstractForm
{
    /**
     * @return string
     */
    public function makeForm()
    {
        return $this->makeInputType('radio');
    }

    /**
     * @return mixed|string
     */
    public function makeId()
    {
        $name = trim($this->element->name());
        if ($this->isOptionElement) {
            $name .= '_' . $this->optionIndex;
        }
        $name = str_replace(['[',']'], '_', $name);
        return $name;
    }
}