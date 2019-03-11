<?php
namespace WScore\Ask\Form;

class SelectForm extends AbstractForm
{
    public function makeForm()
    {
        $class = $this->makeClass($this->form_class);
        $name  = $this->makeAttr('name', $this->element->name());
        $required = $this->element->isRequired()
            ? 'required'
            : '';
        $id = $this->makeAttr('id', $this->makeId());
        $style = $this->style ? "style=\"{$this->style}\"": '';

        $html = "<select {$name} {$id} {$required} {$class} {$style}>";
        $html .= $this->makeOptions();
        $html .= '</select>';
        return $html;
    }

    private function makeOptions()
    {
        $options = '';
        if ($holder = $this->element->placeholder()) {
            $options .= "<option disabled selected hidden>{$holder}</option>";
        }
        foreach ($this->element->getRawOptions() as $value => $label) {
            $options .= "<option value='{$value}'>{$label}</option>";
        }
        return $options;
    }
}