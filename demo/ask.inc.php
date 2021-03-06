<?php
require_once __DIR__ . '/../vendor/autoload.php';

/**
 * @return \WScore\Ask\AskModel
 */
function buildAskForms()
{
    $ask = new \WScore\Ask\AskModel();

    $ask->addText('name', 'Your Name')
        ->setPlaceholder('Mr. Test Taro');

    $ask->addSelect('preference', 'Prefers')
        ->addOption('radio', 'Radio Buttons')
        ->addOption('select', 'Dropdown List')
        ->addOption('check', 'Checkboxes')
        ->setPlaceholder('select one...');

    $ask->addRadio('happy', 'Are You Happy?')
        ->addOption('yes', 'Yes!')
        ->addOption('no', 'noop...');

    $ask->addCheckBox('movie', 'Favorite movie')
        ->addOption('starwars', 'Star Wars!')
        ->addOption('yamato', 'Spaceship Yamato!')
        ->addOption('startrek', 'Star Trek!');

    $ask->addCheckBox('agree', 'agreed', 'whatever the terms you probably will not read.');

    return $ask;
}
