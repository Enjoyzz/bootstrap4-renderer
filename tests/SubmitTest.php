<?php

declare(strict_types=1);

namespace Tests\Enjoys\Forms\Renderer\Bootstrap4;

use Enjoys\Forms\Elements\Submit;
use Enjoys\Forms\Renderer\Bootstrap4\Bootstrap4Renderer;
use PHPUnit\Framework\TestCase;

class SubmitTest extends TestCase
{
    public function testAddedClass()
    {
        $el = new Submit('foo');
        $render = Bootstrap4Renderer::createTypeRender($el);
        $this->assertSame(['btn-primary', 'btn'], $render->getElement()->getClassesList());
    }
}
