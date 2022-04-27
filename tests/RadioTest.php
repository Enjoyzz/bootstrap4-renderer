<?php

declare(strict_types=1);

namespace Tests\Enjoys\Forms\Renderer\Bootstrap4;

use Enjoys\Forms\Elements\Checkbox;
use Enjoys\Forms\Elements\Radio;
use Enjoys\Forms\Renderer\Bootstrap4\Bootstrap4Renderer;
use Enjoys\Forms\Renderer\Html\HtmlRenderer;

class RadioTest extends _TestCase
{
    public function testRadio()
    {

        $el = new Radio('test', 'Test Label', true);

        $el->fill([
            ['no', ['test', 'id' => 'new']],
            'yes'
        ]);

        $render = Bootstrap4Renderer::createTypeRender($el);
        $this->assertSame($this->stringOneLine(<<<HTML
<div class='form-group'>
<label for="rb_test">Test Label</label>
<div class="form-check"><input type="radio" value="0" test id="new" class="form-check-input" name="test"><label class="form-check-label" for="new">no</label></div>
<div class="form-check"><input type="radio" id="rb_1" value="1" class="form-check-input" name="test"><label class="form-check-label" for="rb_1">yes</label></div>
</div>
HTML), $this->stringOneLine($render->render()));
    }

    public function testRadioWithoutLabel()
    {

        $el = new Radio('test', 'Test Label', true);

        $el->addElements([
            new Radio('no'),
            new Radio('yes', 'Yes')
        ]);

        $render = Bootstrap4Renderer::createTypeRender($el);
        $this->assertSame($this->stringOneLine(<<<HTML
<div class='form-group'>
<label for="rb_test">Test Label</label>
<div class="form-check"><input type="radio" id="rb_no" value="no" class="form-check-input position-static" name="test"><label class="form-check-label" for="rb_no"></label></div>
<div class="form-check"><input type="radio" id="rb_yes" value="yes" class="form-check-input" name="test"><label class="form-check-label" for="rb_yes">Yes</label></div>
</div>
HTML), $this->stringOneLine($render->render()));
    }
}
