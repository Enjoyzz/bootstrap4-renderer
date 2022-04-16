<?php

declare(strict_types=1);


namespace Enjoys\Forms\Renderer\Bootstrap4;


use Enjoys\Forms\Element;

class Button extends \Enjoys\Forms\Renderer\Html\TypesRender\Button
{

    public function __construct(Element $element)
    {
        $element->addClass('btn');
        parent::__construct($element);
    }

    public function render(): string
    {
        return $this->bodyRender($this->getElement());
    }

}
