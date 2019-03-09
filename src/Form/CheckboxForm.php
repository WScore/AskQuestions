<?php
namespace WScore\Ask\Form;

class CheckboxForm extends AbstractForm
{
    public function makeForm()
    {
        return $this->makeInputType('checkbox');
    }
}