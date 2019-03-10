<?php
namespace WScore\Ask\Form;

class RadioForm extends AbstractForm
{
    public function makeForm()
    {
        return $this->makeInputType('radio');
    }
}