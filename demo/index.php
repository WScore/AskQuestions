<?php
require_once __DIR__ . '/ask.inc.php';

$ask = buildAskForms();
$forms = $ask->buildForm();
$forms->setFormClass('form-control');
$forms->setLabelClass('form-label');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Ask Forms Demo - HTML Forms</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="ask.css">
</head>
<body>
<div class="container">
    <h1>Ask Forms<span class="small"> /Forms</span></h1>
    <hr>
    <form action="check.php" method="post">
        <div class="form-group">
            <?php $element = $forms->getElement('name'); ?>
            <?= $element->makeLabel(); ?>
            <?= $element->makeForm(); ?>
        </div>

        <div class="form-group">
            <?php $element = $forms->getElement('preference'); ?>
            <?= $element->makeLabel(); ?>
            <?= $element->addFormClass('col-sm-6')->makeForm(); ?>
        </div>

        <?php $element = $forms->getElement('happy'); ?>
        <div class="form-group">
            <?= $element->makeLabel(); ?>
            <?php foreach ($element->getOptions() as $option) :
                $option->setLabelClass('form-check-label');
                $option->setFormClass('form-check-input');
                ?>
                <div class="form-check">
                    <?php
                    echo $option->makeForm();
                    echo $option->makeLabel();
                    ?>
                </div>
            <?php endforeach; ?>
        </div>
        <?php $element = $forms->getElement('movie'); ?>
        <div class="form-group">
            <?= $element->makeLabel(); ?>
            <?php foreach ($element->getOptions() as $option) :
                $option->setLabelClass('form-check-label');
                $option->setFormClass('form-check-input');
                ?>
                <div class="form-check">
                    <?php
                    echo $option->makeForm();
                    echo $option->makeLabel();
                    ?>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="form-group">
            <?php $element = $forms->getElement('agree'); ?>
            <label class="form-label required" for="agree">Do you agree with...</label>
            <div class="form-check">
                <?= $element->setFormClass('form-check-input')->makeForm(); ?>
                <?= $element->setLabelClass('form-check-label')->makeLabel(); ?>
            </div>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Submit Form">
        </div>
    </form>
</div>
</body>
</html>
