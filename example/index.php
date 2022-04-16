<?php

use Enjoys\Forms\Elements\Select;
use Enjoys\Forms\Elements\Text;
use Enjoys\Forms\Form;
use Enjoys\Forms\Renderer\Bootstrap4\Bootstrap4Renderer;

require __DIR__ . '/../vendor/autoload.php';

$form = new Form();
$form->text('text_foo1', 'Text Label Input')->setDescription('Description')->addRule(\Enjoys\Forms\Rules::REQUIRED);
$form->group('Group Label', 'group_id')->add([
    (new Text('text_foo2', 'Foo'))->addRule(\Enjoys\Forms\Rules::REQUIRED),
    (new Select('select_foo1', 'Bar'))->fill([1, 2, 3]),
    (new Text('text_foo3', 'Foo3'))->addRule(\Enjoys\Forms\Rules::REQUIRED),
    new \Enjoys\Forms\Elements\Reset('reset')
]);

$form->select('select_foo2', 'Select City')->fill([
    [
        'msk',
        [
            'class' => 'h1 text-danger'
        ]
    ],
    'vrn'
]);


$form->select('select_group', 'Select Group')
    ->setOptgroup('Россия', [
        'Москва',
        ['Воронеж', ['class' => 'text-warning']]
    ], [
        'class' => 'text-primary'
    ])
    ->setOptgroup('Украина', [
        'Киев',
        'Львов'
    ])
;

$form->checkbox('checkbox1', 'Выбор1')->fill([
    1,
    2,
    3,
    4
], true)->setDescription('Выбор1 Description')
    ->addClass('text-muted')
    ->addRule(\Enjoys\Forms\Rules::REQUIRED)
;

$form->submit('sbmt1', 'Submit button');

if (!$form->isSubmitted()) {
    $renderer = new Bootstrap4Renderer();
    $renderer->setForm($form);
    ?>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
          integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF"
            crossorigin="anonymous"></script>

    <?php

    echo sprintf('<div class="container-fluid">%s</div>', $renderer->output());
}



