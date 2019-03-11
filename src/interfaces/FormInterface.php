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
     * @param string $class
     * @return self
     */
    public function addFormClass($class);

    /**
     * @param string $style
     * @return self
     */
    public function setFormStyle($style);

    /**
     * @return string
     */
    public function makeLabel();

    /**
     * @return string
     */
    public function makeForm();
}