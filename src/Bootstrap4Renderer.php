<?php

declare(strict_types=1);

namespace Enjoys\Forms\Renderer\Bootstrap4;

use Enjoys\Forms\AttributeFactory;
use Enjoys\Forms\Element;
use Enjoys\Forms\Elements;
use Enjoys\Forms\Elements\Hidden;
use Enjoys\Forms\Form;
use Enjoys\Forms\Helper;
use Enjoys\Forms\Interfaces\TypeRenderInterface;
use Enjoys\Forms\Renderer\AbstractRenderer;
use Enjoys\Traits\Options;

class Bootstrap4Renderer extends AbstractRenderer
{
    use Options;

    private const _MAP_ = [
        Button::class => Elements\Button::class,
        Submit::class => Elements\Submit::class,
        Image::class => Elements\Image::class,
        Reset::class => Elements\Reset::class,
        File::class => Elements\File::class,
        Radio::class => Elements\Radio::class,
        Checkbox::class => Elements\Checkbox::class,
        Select::class => Elements\Select::class,
        Group::class => Elements\Group::class,
        Header::class => Elements\Header::class,
        Range::class => Elements\Range::class,
        Html::class => [
            Elements\Html::class,
            Elements\Header::class
        ],
    ];

    public function __construct(Form $form = null, array $options = [])
    {
        $this->setOptions($options);
        parent::__construct($form);
    }

    public function output(): string
    {
        return sprintf(
            "<form%s>\n%s\n%s\n</form>",
            $this->getForm()->getAttributesString(),
            $this->rendererHiddenElements(),
            $this->rendererElements()
        );
    }

    private function rendererHiddenElements(): string
    {
        $html = [];
        foreach ($this->getForm()->getElements() as $element) {
            if ($element instanceof Hidden) {
                $this->getForm()->removeElement($element);
                $html[] = $element->baseHtml();
            }
        }
        return implode("\n", $html);
    }

    private function rendererElements(): string
    {
        $html = [];
        foreach ($this->getForm()->getElements() as $element) {
            if (method_exists($element, 'getDescription') && !empty($element->getDescription())) {
                $element->setAttrs(
                    AttributeFactory::createFromArray([
                        'id' => $element->getAttr('id')->getValueString() . 'Help',
                        'class' => 'form-text'
                    ]),
                    Form::ATTRIBUTES_DESC
                );
                $element->setAttrs(
                    AttributeFactory::createFromArray([
                        'aria-describedby' => $element->getAttr('id', Form::ATTRIBUTES_DESC)->getValueString()
                    ])
                );
            }


            $element->addClass('form-label', Form::ATTRIBUTES_LABEL);

            $html[] = self::createTypeRender($element, $this->getOptions())->render();
        }
        return implode("\n", $html);
    }

    public static function createTypeRender(Element $element, array $options = []): TypeRenderInterface
    {
        $typeRenderClass = Helper::arrayRecursiveSearchKeyMap(get_class($element), self::_MAP_)[0] ?? false;
        if ($typeRenderClass === false || !class_exists($typeRenderClass)) {
            return new Input($element, $options);
        }
        return new $typeRenderClass($element, $options);
    }
}
