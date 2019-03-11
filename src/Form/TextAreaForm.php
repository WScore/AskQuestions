<?php
namespace WScore\Ask\Form;

class TextAreaForm extends AbstractForm
{
    public function makeForm()
    {
        $class = $this->makeClass($this->form_class);
        $name  = $this->makeAttr('name', $this->element->name());
        $required = $this->element->isRequired()
            ? 'required'
            : '';
        $id = $this->makeAttr('id', $this->makeId());
        $value = $this->element->value() ?: '';
        $style = $this->style ? "style=\"{$this->style}\"": '';

        return "<textarea {$class} {$name} {$required} {$id} {$style}>{$value}</textarea>";
    }
}