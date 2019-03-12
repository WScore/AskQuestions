<?php
require_once __DIR__ . '/ask.inc.php';

$ask = buildAskForms();
$validator = $ask->buildValidator($_POST);
$results = $validator->getResults();
?>
<!DOCTYPE html>
<html lang="ja">

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
    <h1>Ask Forms<span class="small"> /確認</span></h1>
    <hr>
    <table class="table">
        <?php foreach ($results as $result) :?>
        <tr>
            <th><?= $result->label(); ?></th>
            <td><?= $result->showValue('<br>'); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <h2>データ var dump</h2>
    <pre><?php var_dump($validator->getData()); ?></pre>
    <h2>入力値 var dump</h2>
    <pre><?php var_dump($_POST); ?></pre>
</div>
</body>
</html>