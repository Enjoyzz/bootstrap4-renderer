<?php

declare(strict_types=1);

namespace Enjoys\Forms\Renderer\Bootstrap4;

use Enjoys\Forms\Element;
use Enjoys\Traits\Options;

class Header extends \Enjoys\Forms\Renderer\Html\TypesRender\Input
{
    use Options;

    public function __construct(Element $element, array $options = [])
    {
        $this->setOptions($options);
        $element->addClass('h4');
        parent::__construct($element);
    }

    public function render(): string
    {
        return "<div{$this->getElement()->getAttributesString()}>{$this->getElement()->getLabel()}</div>";
    }
}
