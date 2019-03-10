<?php
require_once __DIR__ . '/ask.inc.php';

$ask = buildAskForms();
$forms = $ask->buildForm();
$forms->setFormClass('form-control');
$forms->setLabelClass('form-label');

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Ask Forms Demo - HTML Forms</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        label.form-label {
            font-weight: bold;
            color: #496282;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Ask Forms<span class="small"> /HTML Forms</span></h1>
    <form action="">
        <div class="form-group">
            <?= $forms->getElement('name')->makeLabel(); ?>
            <?= $forms->getElement('name')->makeForm(); ?>
        </div>
    </form>
</div>
</body>
</html>
