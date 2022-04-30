<?php

use Enjoys\Forms\AttributeFactory;
use Enjoys\Forms\Form;
use Enjoys\Forms\Renderer\Bootstrap4\Bootstrap4Renderer;

require __DIR__ . '/../vendor/autoload.php';

$form = new Form();

$form->header('HTML5 inputs');
$form->color('color1', 'Color');
$form->date('date1', 'Date');
$form->datetime('datetime1', 'DateTime');
$form->datetimelocal('datetimelocal1', 'DateTime Local');
$form->email('email1', 'E-mail');
$form->email('email2', 'E-mail / multiple')
    ->setAttribute(AttributeFactory::create('multiple'))
    ->setDescription('Список e-mail вводится через запятую')
;
$form->month('month1', 'Month');
$form->number('number1', 'Number');
$form->range('range1', 'Range');
$form->search('search1', 'Search');
$form->tel('tel1', 'Tel');
$form->time('time1', 'Time');
$form->url('url1', 'Url');
$form->week('week1', 'Week');

$renderer = new Bootstrap4Renderer();
$renderer->setForm($form);

echo include __DIR__.'/.assets.php';
echo sprintf('<div class="container">%s</div>', $renderer->output());




