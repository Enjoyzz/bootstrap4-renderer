<?php

declare(strict_types=1);

namespace Tests\Enjoys\Forms\Renderer\Bootstrap4;

use Enjoys\Forms\Elements;
use Enjoys\Forms\Elements\Select;
use Enjoys\Forms\Elements\Text;
use Enjoys\Forms\Form;
use Enjoys\Forms\Renderer\Bootstrap4\Bootstrap4Renderer;
use Enjoys\Forms\Renderer\Bootstrap4\Button;
use Enjoys\Forms\Renderer\Bootstrap4\Input;
use Enjoys\Forms\Renderer\Html\HtmlRenderer;
use Enjoys\Forms\Validator;
use Enjoys\ServerRequestWrapper;
use Enjoys\Session\Session;
use Enjoys\Traits\Reflection;
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
            [Elements\Submit::class, Button::class],
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

        $_token_csrf = $form->getElement(Form::_TOKEN_CSRF_)->getAttr('value')->getValueString();
        $_token_submit = $form->getElement(Form::_TOKEN_SUBMIT_)->getAttr('value')->getValueString();

        $this->assertEquals($form, $renderer->getForm());

        $this->assertSame(
        // $this->stringOneLine(
            <<<HTML
<form method="POST">
<input type="hidden" name="_token_csrf" value="$_token_csrf">
<input type="hidden" name="_token_submit" value="$_token_submit">
<div class='form-group'><label class="form-label" for="text_foo1">Text Label Input&nbsp;<sup>*</sup></label>
<input type="text" id="text_foo1" name="text_foo1" aria-describedby="text_foo1Help" class="form-control">

<small id="text_foo1Help" class="form-text">Description</small></div>
<label class="form-label" for="group_id">Group Label</label>
<div class='form-row'><div id="text_foo2" name="text_foo2" class="col"><div class='form-group'><label for="text_foo2">Foo&nbsp;<sup>*</sup></label>
<input type="text" id="text_foo2" name="text_foo2" class="col form-control">

</div></div><div id="select_foo1" name="select_foo1" class="col"><div class='form-group'><label for="select_foo1">Bar</label>
<select id="select_foo1" name="select_foo1" class="col form-select form-control">
<option value="0">1</option><option value="1">2</option><option value="2">3</option>
</select>

</div></div><div id="text_foo3" name="text_foo3" class="col"><div class='form-group'><label for="text_foo3">Foo3&nbsp;<sup>*</sup></label>
<input type="text" id="text_foo3" name="text_foo3" class="col form-control">

</div></div><div id="reset" name="reset" class="col"><input type="reset" id="reset" name="reset" class="col btn"></div>

</div>
<div class='form-group'><label class="form-label" for="select_foo2">Select City</label>
<select id="select_foo2" name="select_foo2" class="form-select form-control">
<option value="0" class="h1 text-danger">msk</option><option value="1">vrn</option>
</select>

</div>
<div class='form-group'><label class="form-label" for="select_group">Select Group</label>
<select id="select_group" name="select_group" class="form-select form-control">
<optgroup label="Россия" class="text-primary"><option value="0">Москва</option><option value="1" class="text-warning">Воронеж</option></optgroup><optgroup label="Украина"><option value="0">Киев</option><option value="1">Львов</option></optgroup>
</select>

</div>
<div class='form-group'><label class="form-label" for="cb_checkbox1">Выбор1&nbsp;<sup>*</sup></label>
<div class="form-check"><input type="checkbox" id="cb_1" value="1" class="form-check-input" name="checkbox1[]"><label class="form-check-label" for="cb_1">1</label></div>
<div class="form-check"><input type="checkbox" id="cb_2" value="2" class="form-check-input" name="checkbox1[]"><label class="form-check-label" for="cb_2">2</label></div>
<div class="form-check"><input type="checkbox" id="cb_3" value="3" class="form-check-input" name="checkbox1[]"><label class="form-check-label" for="cb_3">3</label></div>
<div class="form-check"><input type="checkbox" id="cb_4" value="4" class="form-check-input" name="checkbox1[]"><label class="form-check-label" for="cb_4">4</label></div>


<small id="cb_checkbox1Help" class="form-text">Выбор1 Description</small></div>
<input type="submit" id="sbmt1" name="sbmt1" value="Submit button" class="btn-primary btn">
</form>
HTML
            ,
            $renderer->output()
        // $this->stringOneLine($renderer->output())
        );
    }


    public function testOutputWithEmptySubmitted()
    {
        $form = $this->getForm('get', new ServerRequestWrapper(new ServerRequest(parsedBody: [
           Form::_TOKEN_SUBMIT_ => 'd751713988987e9331980363e24189ces'
        ])));

        Validator::check($form->getElements());


        $renderer = new Bootstrap4Renderer();
        $renderer->setForm($form);

        $_token_submit = $form->getElement(Form::_TOKEN_SUBMIT_)->getAttr('value')->getValueString();

        $this->assertEquals($form, $renderer->getForm());

        $this->assertSame(
        // $this->stringOneLine(
            <<<HTML
<form method="GET">
<input type="hidden" name="_token_submit" value="$_token_submit">
<div class='form-group'><label class="form-label" for="text_foo1">Text Label Input&nbsp;<sup>*</sup></label>
<input type="text" id="text_foo1" name="text_foo1" aria-describedby="text_foo1Help" class="form-control is-invalid">
<div class="invalid-feedback d-block">Обязательно для заполнения, или выбора</div>
<small id="text_foo1Help" class="form-text">Description</small></div>
<label class="form-label" for="group_id">Group Label</label>
<div class='form-row'><div id="text_foo2" name="text_foo2" class="col"><div class='form-group'><label for="text_foo2">Foo&nbsp;<sup>*</sup></label>
<input type="text" id="text_foo2" name="text_foo2" class="col form-control is-invalid">
<div class="invalid-feedback d-block">Обязательно для заполнения, или выбора</div>
</div></div><div id="select_foo1" name="select_foo1" class="col"><div class='form-group'><label for="select_foo1">Bar</label>
<select id="select_foo1" name="select_foo1" class="col form-select form-control">
<option value="0">1</option><option value="1">2</option><option value="2">3</option>
</select>

</div></div><div id="text_foo3" name="text_foo3" class="col"><div class='form-group'><label for="text_foo3">Foo3&nbsp;<sup>*</sup></label>
<input type="text" id="text_foo3" name="text_foo3" class="col form-control is-invalid">
<div class="invalid-feedback d-block">Обязательно для заполнения, или выбора</div>
</div></div><div id="reset" name="reset" class="col"><input type="reset" id="reset" name="reset" class="col btn"></div>

</div>
<div class='form-group'><label class="form-label" for="select_foo2">Select City</label>
<select id="select_foo2" name="select_foo2" class="form-select form-control">
<option value="0" class="h1 text-danger">msk</option><option value="1">vrn</option>
</select>

</div>
<div class='form-group'><label class="form-label" for="select_group">Select Group</label>
<select id="select_group" name="select_group" class="form-select form-control">
<optgroup label="Россия" class="text-primary"><option value="0">Москва</option><option value="1" class="text-warning">Воронеж</option></optgroup><optgroup label="Украина"><option value="0">Киев</option><option value="1">Львов</option></optgroup>
</select>

</div>
<div class='form-group'><label class="form-label" for="cb_checkbox1">Выбор1&nbsp;<sup>*</sup></label>
<div class="form-check"><input type="checkbox" id="cb_1" value="1" class="form-check-input is-invalid" name="checkbox1[]"><label class="form-check-label" for="cb_1">1</label></div>
<div class="form-check"><input type="checkbox" id="cb_2" value="2" class="form-check-input is-invalid" name="checkbox1[]"><label class="form-check-label" for="cb_2">2</label></div>
<div class="form-check"><input type="checkbox" id="cb_3" value="3" class="form-check-input is-invalid" name="checkbox1[]"><label class="form-check-label" for="cb_3">3</label></div>
<div class="form-check"><input type="checkbox" id="cb_4" value="4" class="form-check-input is-invalid" name="checkbox1[]"><label class="form-check-label" for="cb_4">4</label></div>

<div class="invalid-feedback d-block">Обязательно для заполнения, или выбора</div>
<small id="cb_checkbox1Help" class="form-text">Выбор1 Description</small></div>
<input type="submit" id="sbmt1" name="sbmt1" value="Submit button" class="btn-primary btn">
</form>
HTML
            ,
            $renderer->output()
        // $this->stringOneLine($renderer->output())
        );
    }


    private function getForm($method = 'post', $request = null): Form
    {
        $form = new Form($method,  request: $request);
        $form->text('text_foo1', 'Text Label Input')->setDescription('Description')->addRule(
            \Enjoys\Forms\Rules::REQUIRED
        );
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
        return $form;
    }
}
