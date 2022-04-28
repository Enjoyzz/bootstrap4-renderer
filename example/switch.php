<?php

use Enjoys\Forms\AttributeFactory;
use Enjoys\Forms\Elements\Button;
use Enjoys\Forms\Elements\Select;
use Enjoys\Forms\Elements\Text;
use Enjoys\Forms\Form;
use Enjoys\Forms\Renderer\Bootstrap4\Bootstrap4Renderer;
use Enjoys\Forms\Rules;

require __DIR__ . '/../vendor/autoload.php';

$form = new Form();

$form->checkbox('active','switch enabled')
    ->fill([1 => 'Active']);
$form->checkbox('active2', 'switch not enabled')
    ->fill([1 => 'Active']);
$form->checkbox('many', 'switch enabled')
    ->fill([1,2,3,4,5]);
$form->checkbox('many2', 'switch not enabled')
    ->fill([1,2,3,4,5]);


$renderer = new Bootstrap4Renderer($form);

$renderer->setOptions([
    'switch' => ['active', 'many']
]);

echo include __DIR__.'/.assets.php';
echo sprintf('<div class="container-fluid">%s</div>', $renderer->output());


