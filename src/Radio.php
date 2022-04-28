<?php

declare(strict_types=1);

namespace Enjoys\Forms\Renderer\Bootstrap4;

use Enjoys\Forms\Element;
use Enjoys\Forms\Form;
use Enjoys\Forms\Interfaces\Fillable;
use Enjoys\Forms\Interfaces\Ruleable;

class Radio extends Input
{
    /**
     * @param Element&Fillable&Ruleable $element
     * @return string
     */
    protected function bodyRender(Element $element): string
    {
        $return = '';
        foreach ($element->getElements() as $data) {
            $element->addClass('form-check', Form::ATTRIBUTES_FILLABLE_BASE);

            $data->addClass('form-check-input');
            $data->addClass('form-check-label', Form::ATTRIBUTES_LABEL);


            if (empty($data->getLabel())) {
                $data->addClass('position-static');
            }

            if ($element->isRuleError()) {
                $data->addClass('is-invalid');
            }


            $return .= "<div{$element->getAttributesString(Form::ATTRIBUTES_FILLABLE_BASE)}>";
            $return .= parent::bodyRender($data);
            $return .= "</div>\n";
        }
        return $return;
    }
}
