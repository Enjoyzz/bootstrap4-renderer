# bootstrap4-renderer
Renderer for enjoys/forms

## Run built-in server for view example
```shell
php -S localhost:8000 -t ./example .route
```

## Usage

```php
use Enjoys\Forms\Renderer\Bootstrap4\Bootstrap4Renderer;
use Enjoys\Forms\Form;
$renderer = new Bootstrap4Renderer();
/** @var Form $form */
$renderer->setForm($form);
$renderer->output();
```
or
```php
use Enjoys\Forms\Renderer\Bootstrap4\Bootstrap4Renderer;
use Enjoys\Forms\Form;
/** @var Form $form */
$renderer = new Bootstrap4Renderer($form);
$renderer->output();
```


## Options

```custom-switch``` - more https://getbootstrap.com/docs/4.6/components/forms/#switches

set for all checkbox the custom switch
```php
$renderer->setOptions([
    'custom-switch' => true 
]);
```

set for one element the custom switch
```php
$renderer->setOptions([
    'custom-switch' => 'element_name' // 
]);
```

set for definitions elements the custom switch
```php
$renderer->setOptions([
    'custom-switch' => [
        'element_name', 
        'more_element', //...
    ] 
]);
```
