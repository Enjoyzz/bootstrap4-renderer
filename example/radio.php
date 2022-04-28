<?php

declare(strict_types=1);

use Enjoys\Forms\Elements\Radio;
use Enjoys\Forms\Form;
use Enjoys\Forms\Renderer\Bootstrap4\Bootstrap4Renderer;

require __DIR__ . '/../vendor/autoload.php';

$form = new Form();
$form->radio('radio', 'radio')->fill([1,2,3]);
$form->radio('radio2', 'radio2')->fill([1,2,3]);
$form->radio('radio3', 'radio3')->setPrefixId('test_')->fill([1,2,3]);
$form->radio('radio4', 'radio4')->addElements([
    new Radio('first', 'Yes', false),
    new Radio('second', 'Second'),
]);
$renderer = new Bootstrap4Renderer($form);
echo include __DIR__.'/.assets.php';
echo sprintf('<div class="container-fluid">%s</div>', $renderer->output());
