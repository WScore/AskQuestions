<?php
/**
 * Created by PhpStorm.
 * User: wsjp
 * Date: 2019/03/09
 * Time: 18:38
 */

namespace WScore\Ask\Interfaces;

interface FormInterface
{
    /**
     * @return bool
     */
    public function hasOptions();

    /**
     * @return self[]
     */
    public function getOptions();

    /**
     * @param string $class
     * @return self
     */
    public function setLabelClass($class);

    /**
     * @param string $class
     * @return self
     */
    public function setFormClass($class);

    /**
     * @return string
     */
    public function makeLabel();

    /**
     * @return string
     */
    public function makeForm();
}