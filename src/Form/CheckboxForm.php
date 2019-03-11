<?php
namespace WScore\Ask\Form;

class CheckboxForm extends AbstractForm
{
    /**
     * @return string
     */
    public function makeForm()
    {
        $class = $this->makeClass($this->form_class);
        $name  = $this->makeAttr('name', $this->element->name());
        $id = $this->makeAttr('id', $this->makeId());
        $holder = $this->element->placeholder();
        $holder = $holder ? $this->makeAttr('placeholder', $holder) : '';
        $value = $this->element->value();
        $value = $value ? $this->makeAttr('value', $value): '';
        $style = $this->style ? "style=\"{$this->style}\"": '';

        return "<input type='checkbox' {$name} {$id} {$class} {$holder} {$value} {$style}>";
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