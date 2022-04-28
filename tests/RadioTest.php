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
<label for="test">Test Label</label>
<div class="custom-control custom-radio"><input type="radio" value="0" test id="new" class="custom-control-input" name="test"><label class="custom-control-label" for="new">no</label></div>
<div class="custom-control custom-radio"><input type="radio" id="test_1" value="1" class="custom-control-input" name="test"><label class="custom-control-label" for="test_1">yes</label></div>
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
<label for="test">Test Label</label>
<div class="custom-control custom-radio"><input type="radio" value="no" id="no" class="custom-control-input position-static" name="test"><label class="custom-control-label" for="no"></label></div>
<div class="custom-control custom-radio"><input type="radio" value="yes" id="yes" class="custom-control-input" name="test"><label class="custom-control-label" for="yes">Yes</label></div>
</div>
HTML), $this->stringOneLine($render->render()));
    }
}
