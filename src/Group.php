<?php

declare(strict_types=1);


namespace Enjoys\Forms\Renderer\Bootstrap4;


use Enjoys\Forms\Element;
use Enjoys\Forms\Renderer\Html\HtmlRenderer;

class Group extends Input
{
    protected function bodyRender(Element $element): string
    {
//        $element->addClass('form-group');
//        $return = sprintf("<div%s>", $element->getAttributesString());
        $return='';
        /** @var \Enjoys\Forms\Elements\Group $element */
        foreach ($element->getElements() as $data) {
            $data->addClass('col');
//            $data->addClass('form-group');
            $return .= "<div{$data->getAttributesString()}>";
            $return .= Bootstrap4Renderer::createTypeRender($data)->render();
            $return .= '</div>';
        }
//        $return .= '</div>';
        return $return;
    }

    public function render(): string
    {
        return sprintf(
            "%s\n<div class='form-row'>%s\n%s\n%s</div>",
            $this->labelRender(),
            $this->bodyRender($this->getElement()),
            $this->descriptionRender(),
            $this->validationRender(),
        );
    }

}
