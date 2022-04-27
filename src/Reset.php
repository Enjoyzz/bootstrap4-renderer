<?php

declare(strict_types=1);

namespace Enjoys\Forms\Renderer\Bootstrap4;

use Enjoys\Forms\Element;
use Enjoys\Traits\Options;

class Reset extends \Enjoys\Forms\Renderer\Html\TypesRender\Button
{
    use Options;

    public function __construct(Element $element, array $options = [])
    {
        $this->setOptions($options);
        $element->addClass('btn btn-secondary');
        parent::__construct($element);
    }
}
