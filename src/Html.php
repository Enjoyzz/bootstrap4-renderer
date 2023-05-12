<?php

declare(strict_types=1);

namespace Enjoys\Forms\Renderer\Bootstrap4;

use Enjoys\Forms\Element;

class Html extends \Enjoys\Forms\Renderer\Html\TypesRender\Input
{

    public function __construct(Element $element)
    {
        parent::__construct($element);
    }

    public function render(): string
    {
        return "{$this->getElement()->getLabel()}";
    }
}
