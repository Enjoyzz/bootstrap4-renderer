<?php

declare(strict_types=1);

namespace Enjoys\Forms\Renderer\Bootstrap4;

use Enjoys\Forms\Element;
use Enjoys\Forms\Renderer\Html\TypesRender\Input;

class Group extends Input
{
    public const ATTRIBUTES_GROUP = '_group_attributes_';

    public function __construct(Element $element)
    {
        $element->addClass('form-row');
        parent::__construct($element);
    }

    protected function bodyRender(Element $element): string
    {
        $return = '';
        /** @var \Enjoys\Forms\Elements\Group $element */
        foreach ($element->getElements() as $data) {
            $data->addClass('col', self::ATTRIBUTES_GROUP);
            $return .= sprintf("<div%s>", $data->getAttributesString(self::ATTRIBUTES_GROUP));
            $return .= Bootstrap4Renderer::createTypeRender($data)->render();
            $return .= '</div>';
        }
        return $return;
    }

    public function render(): string
    {
        return sprintf(
            "%s\n<div%s>%s\n%s\n%s</div>",
            $this->labelRender(),
            $this->getElement()->getAttributesString(),
            $this->bodyRender($this->getElement()),
            $this->descriptionRender(),
            $this->validationRender(),
        );
    }
}
