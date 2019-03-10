<?php
require_once __DIR__ . '/ask.inc.php';

$ask = buildAskForms();
$validator = $ask->buildValidator($_POST);
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
    <h1>Ask Forms<span class="small"> /Checks</span></h1>
    <hr>
    <h2>Data var dump</h2>
    <pre><?php var_dump($validator->getData()); ?></pre>
    <h2>$_POST var dump</h2>
    <pre><?php var_dump($_POST); ?></pre>
</div>
</body>
</html>
