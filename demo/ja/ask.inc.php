<?php
require_once __DIR__ . '/../../vendor/autoload.php';

/**
 * @return \WScore\Ask\AskModel
 */
function buildAskForms()
{
    $ask = new \WScore\Ask\AskModel();

    $ask->addText('name', '氏　名')
        ->setPlaceholder('テスト　太郎');

    $ask->addSelect('preference', 'どれが好き？')
        ->addOption('ラジオボタン')
        ->addOption('ドロップダウン')
        ->addOption('チェックボックス')
        ->setPlaceholder('選択してください...');

    $ask->addRadio('happy', '幸せですか？')
        ->addOption('もちろん！')
        ->addOption('後で聞いて...');

    $ask->addCheckBox('movie', '好きな映画')
        ->addOption('スターウォーズ')
        ->addOption('宇宙戦艦ヤマト')
        ->addOption('スタートレック')
        ->required(false);

    $ask->addCheckBox('agree', 'agreed', '誰も読まない契約書に同意します。');

    return $ask;
}
