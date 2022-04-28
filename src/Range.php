<?php

declare(strict_types=1);


namespace Enjoys\Forms\Renderer\Bootstrap4;

use Enjoys\Forms\Element;

class Range extends \Enjoys\Forms\Renderer\Html\TypesRender\Input
{
    public function __construct(Element $element)
    {
        $element->addClass('form-control-range');
        parent::__construct($element);
    }

}
