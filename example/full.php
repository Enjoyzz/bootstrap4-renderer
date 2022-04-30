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

$form->header('Header 1');

$form->text('text_foo1', 'Text Label Input')->setDescription('Description')->addRule(Rules::REQUIRED);
$form->group('Group Label', 'group_id')->add([
    (new Text('text_foo2', 'Foo'))->addRule(Rules::REQUIRED),
    (new Select('select_foo1', 'Bar'))->fill([1, 2, 3]),
    (new Text('text_foo3', 'Foo3'))->addRule(Rules::REQUIRED),
    new Button('btn', '<b>Custom</b> button')
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

$form->header('Header 2');

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
    ->addRule(Rules::REQUIRED)
;

$form->image('image_name', 'https://avatars.mds.yandex.net/get-entity_search/5735732/551767088/S122x122Fit_2x');

$form->header('Header 3');

$form->html('<div style="margin: 2em 0"><i>HTML embed</i></div>');

$form->datalist('datalist_name', 'Datalist')->fill([1, 2, 3, 4, 5]);

$form->file('file_name', 'File LAbel')->addRule(Rules::UPLOAD, params: ['required'])->setDescription('File desc');
$form->file('file_name2')->addAttribute(AttributeFactory::create('placeholder', 'select file'));

$form->textarea('textares1', 'TEXTAREA')->setValue('default value')->setCols(10)->setRows(5);

$form->submit('sbmt1', 'Submit button');
$form->reset('reset1', 'Reset button');

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



