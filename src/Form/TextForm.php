<?php
namespace WScore\Ask\Form;

class TextForm extends AbstractForm
{
    public function makeForm()
    {
        return $this->makeInputType('text');
    }
}