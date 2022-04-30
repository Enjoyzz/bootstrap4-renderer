<?php

declare(strict_types=1);

namespace Tests\Enjoys\Forms\Renderer\Bootstrap4;

use Enjoys\Forms\Renderer\Bootstrap4\Button;
use PHPUnit\Framework\TestCase;

class ButtonTest extends TestCase
{
    public function testAddedClass()
    {
        $el = new \Enjoys\Forms\Elements\Button('foo');
        $render = new Button($el);
        $this->assertSame([ 'btn', 'btn-link'], $render->getElement()->getClassesList());
    }
}
