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

?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
      integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF"
        crossorigin="anonymous"></script>

<?php
echo sprintf('<div class="container-fluid">%s</div>', $renderer->output());


