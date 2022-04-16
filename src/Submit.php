<?php

declare(strict_types=1);


namespace Enjoys\Forms\Renderer\Bootstrap4;


use Enjoys\Forms\Element;

class Submit extends Button
{

    public function __construct(Element $element)
    {
        $element->addClass('btn-primary');
        parent::__construct($element);
    }
}
