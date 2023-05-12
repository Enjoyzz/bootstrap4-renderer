<?php

declare(strict_types=1);

namespace Enjoys\Forms\Renderer\Bootstrap4;

use Enjoys\Forms\Element;
use Enjoys\Forms\Form;
use Enjoys\Forms\Interfaces\Fillable;
use Enjoys\Forms\Interfaces\Ruleable;

class Checkbox extends Input
{

    private array $options;

    public function setOptions(array $options): void
    {
        $this->options = $options;
    }

    public function getOption(string $key, $default = null)
    {
        return array_key_exists($key, $this->options) ? $this->options[$key] : $default;
    }

    /**
     * @param Element&Fillable&Ruleable $element
     * @return string
     */
    protected function bodyRender(Element $element): string
    {
        $return = '';
        /** @var Element&Fillable $data */
        foreach ($element->getElements() as $data) {

            $data->addClass('custom-control-input');
            $data->addClass('custom-control-label', Form::ATTRIBUTES_LABEL);
            $element->addClass('custom-control custom-checkbox', Form::ATTRIBUTES_FILLABLE_BASE);

            if ($this->getOption('switch') === true
                || in_array(rtrim($element->getName(), '[]'), (array)$this->getOption('switch', []), true)
            ) {
                $element->removeClass('custom-checkbox', Form::ATTRIBUTES_FILLABLE_BASE);
                $element->addClass('custom-switch', Form::ATTRIBUTES_FILLABLE_BASE);
            }

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
