# bootstrap4-renderer
Renderer for enjoys/forms

## Run built-in server for view example
```shell
port=$(shuf -i 2048-65000 -n 1);
php -S localhost:"${port}" -t ./example .route
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

### ```switch``` setting for the  checkbox elements the custom switch control
see  https://getbootstrap.com/docs/4.6/components/forms/#switches

setting for all the  checkbox elements  the custom switch
```php
$renderer->setOptions([
    'switch' => true 
]);
```

setting for one element the custom switch
```php
$renderer->setOptions([
    'switch' => 'element_name'
]);
```

setting a custom switch for the listed elements
```php
$renderer->setOptions([
    'switch' => [
        'element_name', 
        'more_element', 
        //...
    ] 
]);
```
