<?php

declare(strict_types=1);

namespace Tests\Enjoys\Forms\Renderer\Bootstrap4;

use Enjoys\Forms\AttributeFactory;
use Enjoys\Forms\Elements;
use Enjoys\Forms\Elements\Select;
use Enjoys\Forms\Elements\Text;
use Enjoys\Forms\Form;
use Enjoys\Forms\Renderer\Bootstrap4\Bootstrap4Renderer;
use Enjoys\Forms\Renderer\Bootstrap4\Button;
use Enjoys\Forms\Renderer\Bootstrap4\Input;
use Enjoys\Forms\Renderer\Bootstrap4\Submit;
use Enjoys\Forms\Renderer\Html\HtmlRenderer;
use Enjoys\Forms\Rules;
use Enjoys\Forms\Validator;
use Enjoys\Session\Session;
use HttpSoft\Message\ServerRequest;
use PHPUnit\Framework\TestCase;

new Session();

class Bootstrap4RendererTest extends _TestCase
{
    use Reflection;

    public function dataForCreateTypeRenderer()
    {
        return [
            [Elements\Text::class, Input::class],
            [Elements\Button::class, Button::class],
            [Elements\Submit::class, Submit::class],
        ];
    }

    /**
     * @dataProvider dataForCreateTypeRenderer
     */
    public function testCreateTypeRenderForInput($elClass, $expect)
    {
        $el = new $elClass('foo');
        $this->assertInstanceOf($expect, Bootstrap4Renderer::createTypeRender($el));
    }

    public function testOutput()
    {
        $form = $this->getForm();

        $renderer = new Bootstrap4Renderer();
        $renderer->setForm($form);

        $_token_csrf = $form->getElement(Form::_TOKEN_CSRF_)->getAttribute('value')->getValueString();
        $_token_submit = $form->getElement(Form::_TOKEN_SUBMIT_)->getAttribute('value')->getValueString();

        $this->assertEquals($form, $renderer->getForm());

        $this->assertSame(
            $this->stringOneLine(
                <<<HTML
<form enctype="multipart/form-data" method="POST">
<input type="hidden" name="_token_csrf" value="$_token_csrf">
<input type="hidden" name="_token_submit" value="$_token_submit">
<input type="hidden" name="MAX_FILE_SIZE" value="2097152">
<div class="h4">Header 1</div>
<div class='form-group'><label class="form-label" for="text_foo1">Text Label Input&nbsp;<sup>*</sup></label>
<input type="text" id="text_foo1" name="text_foo1" aria-describedby="text_foo1Help" class="form-control">

<small id="text_foo1Help" class="form-text">Description</small></div>
<label class="form-label">Group Label</label>
<div class="form-row"><div class="col"><div class='form-group'><label for="text_foo2">Foo&nbsp;<sup>*</sup></label>
<input type="text" id="text_foo2" name="text_foo2" class="form-control">

</div></div><div class="col"><div class='form-group'><label for="select_foo1">Bar</label>
<select id="select_foo1" name="select_foo1" class="form-select form-control">
<option value="0">1</option><option value="1">2</option><option value="2">3</option>
</select>

</div></div><div class="col"><div class='form-group'><label for="text_foo3">Foo3&nbsp;<sup>*</sup></label>
<input type="text" id="text_foo3" name="text_foo3" class="form-control">

</div></div><div class="col"><button id="btn" name="btn" class="btn btn-link"><b>Custom</b> button</button></div>

</div>
<div class='form-group'><label class="form-label" for="select_foo2">Select City</label>
<select id="select_foo2" name="select_foo2" class="form-select form-control">
<option value="0" class="h1 text-danger">msk</option><option value="1">vrn</option>
</select>

</div>
<div class="h4">Header 2</div>
<div class='form-group'><label class="form-label" for="select_group">Select Group</label>
<select id="select_group" name="select_group" class="form-select form-control">
<optgroup label="Россия" class="text-primary"><option value="0">Москва</option><option value="1" class="text-warning">Воронеж</option></optgroup><optgroup label="Украина"><option value="0">Киев</option><option value="1">Львов</option></optgroup>
</select>

</div>
<div class='form-group'><label class="form-label" for="checkbox1">Выбор1&nbsp;<sup>*</sup></label>
<div class="custom-control custom-checkbox"><input type="checkbox" id="checkbox1_1" value="1" class="custom-control-input" name="checkbox1[]"><label class="custom-control-label" for="checkbox1_1">1</label></div>
<div class="custom-control custom-checkbox"><input type="checkbox" id="checkbox1_2" value="2" class="custom-control-input" name="checkbox1[]"><label class="custom-control-label" for="checkbox1_2">2</label></div>
<div class="custom-control custom-checkbox"><input type="checkbox" id="checkbox1_3" value="3" class="custom-control-input" name="checkbox1[]"><label class="custom-control-label" for="checkbox1_3">3</label></div>
<div class="custom-control custom-checkbox"><input type="checkbox" id="checkbox1_4" value="4" class="custom-control-input" name="checkbox1[]"><label class="custom-control-label" for="checkbox1_4">4</label></div>


<small id="checkbox1Help" class="form-text">Выбор1 Description</small></div>
<input type="image" id="image_name" name="image_name" src="https://avatars.mds.yandex.net/get-entity_search/5735732/551767088/S122x122Fit_2x">
<div class="h4">Header 3</div>
<div style="margin: 2em 0"><i>HTML embed</i></div>
<div class='form-group'><label class="form-label" for="datalist_name">Datalist</label>
<input id="datalist_name" name="datalist_name" list="datalist_name-list" class="form-control">
<datalist id='datalist_name-list'>
<option value="1">
<option value="2">
<option value="3">
<option value="4">
<option value="5">
</datalist>

</div>
<div class='form-group'><label class="form-label" for="file_name">File LAbel</label><div class='custom-file'><input type="file" id="file_name" name="file_name" aria-describedby="file_nameHelp" class="custom-file-input">
<label class="custom-file-label" for="file_name">Choose file</label></div>
<small id="file_nameHelp" class="form-text">File desc</small></div>
<div class='form-group'><div class='custom-file'><input type="file" id="file_name2" name="file_name2" class="custom-file-input">
<label class="custom-file-label" for="file_name2">select file</label></div>
</div>
<div class='form-group'><label class="form-label" for="textares1">TEXTAREA</label>
<textarea id="textares1" name="textares1" cols="10" rows="5" class="form-control">default value</textarea>

</div>
<input type="submit" id="sbmt1" name="sbmt1" value="Submit button" class="btn btn-primary">
<input type="reset" id="reset1" name="reset1" value="Reset button" class="btn btn-secondary">
</form>
HTML
            ),
//            $renderer->output()
            $this->stringOneLine($renderer->output())
        );
    }


    public function testOutputWithEmptySubmitted()
    {
        $form = $this->getForm(
            'get',
            new ServerRequest(parsedBody: [
                Form::_TOKEN_SUBMIT_ => 'd751713988987e9331980363e24189ces'
            ])
        );

        /** @var \Enjoys\Forms\Elements\Csrf $csrf */
        $csrf = $form->getElement(Form::_TOKEN_CSRF_);
        $rules = $this->getPrivateProperty(Elements\Csrf::class, 'rules');
        $rules->setValue($csrf, []);

        $_token_csrf = $csrf->getAttribute('value')->getValueString();


        $_token_submit = $form->getElement(Form::_TOKEN_SUBMIT_)->getAttribute('value')->getValueString();

        Validator::check($form->getElements());


        $renderer = new Bootstrap4Renderer();
        $renderer->setForm($form);


        $this->assertEquals($form, $renderer->getForm());

        $this->assertSame(
            $this->stringOneLine(
                <<<HTML
<form enctype="multipart/form-data" method="POST">
<input type="hidden" name="_token_submit" value="$_token_submit">
<input type="hidden" name="_token_csrf" value="$_token_csrf">
<input type="hidden" name="MAX_FILE_SIZE" value="2097152">
<div class="h4">Header 1</div>
<div class='form-group'><label class="form-label" for="text_foo1">Text Label Input&nbsp;<sup>*</sup></label>
<input type="text" id="text_foo1" name="text_foo1" aria-describedby="text_foo1Help" class="form-control is-invalid">
<div class="invalid-feedback d-block">Обязательно для заполнения, или выбора</div>
<small id="text_foo1Help" class="form-text">Description</small></div>
<label class="form-label">Group Label</label>
<div class="form-row"><div class="col"><div class='form-group'><label for="text_foo2">Foo&nbsp;<sup>*</sup></label>
<input type="text" id="text_foo2" name="text_foo2" class="form-control is-invalid">
<div class="invalid-feedback d-block">Обязательно для заполнения, или выбора</div>
</div></div><div class="col"><div class='form-group'><label for="select_foo1">Bar</label>
<select id="select_foo1" name="select_foo1" class="form-select form-control">
<option value="0">1</option><option value="1">2</option><option value="2">3</option>
</select>

</div></div><div class="col"><div class='form-group'><label for="text_foo3">Foo3&nbsp;<sup>*</sup></label>
<input type="text" id="text_foo3" name="text_foo3" class="form-control is-invalid">
<div class="invalid-feedback d-block">Обязательно для заполнения, или выбора</div>
</div></div><div class="col"><button id="btn" name="btn" class="btn btn-link"><b>Custom</b> button</button></div>

</div>
<div class='form-group'><label class="form-label" for="select_foo2">Select City</label>
<select id="select_foo2" name="select_foo2" class="form-select form-control">
<option value="0" class="h1 text-danger">msk</option><option value="1">vrn</option>
</select>

</div>
<div class="h4">Header 2</div>
<div class='form-group'><label class="form-label" for="select_group">Select Group</label>
<select id="select_group" name="select_group" class="form-select form-control">
<optgroup label="Россия" class="text-primary"><option value="0">Москва</option><option value="1" class="text-warning">Воронеж</option></optgroup><optgroup label="Украина"><option value="0">Киев</option><option value="1">Львов</option></optgroup>
</select>

</div>
<div class='form-group'><label class="form-label" for="checkbox1">Выбор1&nbsp;<sup>*</sup></label>
<div class="custom-control custom-checkbox"><input type="checkbox" id="checkbox1_1" value="1" class="custom-control-input is-invalid" name="checkbox1[]"><label class="custom-control-label" for="checkbox1_1">1</label></div>
<div class="custom-control custom-checkbox"><input type="checkbox" id="checkbox1_2" value="2" class="custom-control-input is-invalid" name="checkbox1[]"><label class="custom-control-label" for="checkbox1_2">2</label></div>
<div class="custom-control custom-checkbox"><input type="checkbox" id="checkbox1_3" value="3" class="custom-control-input is-invalid" name="checkbox1[]"><label class="custom-control-label" for="checkbox1_3">3</label></div>
<div class="custom-control custom-checkbox"><input type="checkbox" id="checkbox1_4" value="4" class="custom-control-input is-invalid" name="checkbox1[]"><label class="custom-control-label" for="checkbox1_4">4</label></div>

<div class="invalid-feedback d-block">Обязательно для заполнения, или выбора</div>
<small id="checkbox1Help" class="form-text">Выбор1 Description</small></div>
<input type="image" id="image_name" name="image_name" src="https://avatars.mds.yandex.net/get-entity_search/5735732/551767088/S122x122Fit_2x">
<div class="h4">Header 3</div>
<div style="margin: 2em 0"><i>HTML embed</i></div>
<div class='form-group'><label class="form-label" for="datalist_name">Datalist</label>
<input id="datalist_name" name="datalist_name" list="datalist_name-list" class="form-control">
<datalist id='datalist_name-list'>
<option value="1">
<option value="2">
<option value="3">
<option value="4">
<option value="5">
</datalist>

</div>
<div class='form-group'><label class="form-label" for="file_name">File LAbel</label><div class='custom-file'><input type="file" id="file_name" name="file_name" aria-describedby="file_nameHelp" class="custom-file-input is-invalid">
<label class="custom-file-label" for="file_name">Choose file</label></div><div class="invalid-feedback d-block">Выберите файл для загрузки</div>
<small id="file_nameHelp" class="form-text">File desc</small></div>
<div class='form-group'><div class='custom-file'><input type="file" id="file_name2" name="file_name2" class="custom-file-input">
<label class="custom-file-label" for="file_name2">select file</label></div>
</div>
<div class='form-group'><label class="form-label" for="textares1">TEXTAREA</label>
<textarea id="textares1" name="textares1" cols="10" rows="5" class="form-control">default value</textarea>

</div>
<input type="submit" id="sbmt1" name="sbmt1" value="Submit button" class="btn btn-primary">
<input type="reset" id="reset1" name="reset1" value="Reset button" class="btn btn-secondary">
</form>
HTML
            ),
//            $renderer->output()
            $this->stringOneLine($renderer->output())
        );
    }


    private function getForm($method = 'post', $request = null): Form
    {
        $form = new Form($method, request: $request);

        $form->header('Header 1');

        $form->text('text_foo1', 'Text Label Input')->setDescription('Description')->addRule(Rules::REQUIRED);
        $form->group('Group Label', 'group_id')
            ->removeAttribute('id')
            ->removeAttribute('name')
            ->add([
                (new Text('text_foo2', 'Foo'))->addRule(Rules::REQUIRED),
                (new Select('select_foo1', 'Bar'))->fill([1, 2, 3]),
                (new Text('text_foo3', 'Foo3'))->addRule(Rules::REQUIRED),
                new Elements\Button('btn', '<b>Custom</b> button')
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
            ]);

        $form->checkbox('checkbox1', 'Выбор1')->fill([
            1,
            2,
            3,
            4
        ], true)->setDescription('Выбор1 Description')
            ->addClass('text-muted')
            ->addRule(Rules::REQUIRED);

        $form->image('image_name', 'https://avatars.mds.yandex.net/get-entity_search/5735732/551767088/S122x122Fit_2x');

        $form->header('Header 3');

        $form->html('<div style="margin: 2em 0"><i>HTML embed</i></div>');

        $form->datalist('datalist_name', 'Datalist')->fill([1, 2, 3, 4, 5]);

        $form->file('file_name', 'File LAbel')->addRule(Rules::UPLOAD, params: ['required'])->setDescription(
            'File desc'
        );
        $form->file('file_name2')->addAttribute(AttributeFactory::create('placeholder', 'select file'));

        $form->textarea('textares1', 'TEXTAREA')->setValue('default value')->setCols(10)->setRows(5);

        $form->submit('sbmt1', 'Submit button');
        $form->reset('reset1', 'Reset button');
        return $form;
    }
}
