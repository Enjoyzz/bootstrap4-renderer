<?php

declare(strict_types=1);

namespace Tests\Enjoys\Forms\Renderer\Bootstrap4;

use Enjoys\Forms\Elements\Text;
use Enjoys\Forms\Renderer\Bootstrap4\Input;
use PHPUnit\Framework\TestCase;

class InputTest extends TestCase
{
    public function testAddedClass()
    {
        $el = new Text('foo');
        $render = new Input($el);
        $this->assertSame(['form-control'], $render->getElement()->getClassesList());
    }
}
