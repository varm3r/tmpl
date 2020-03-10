## About
This is a simple template engine.
It support simple variables and if-else conditions. 

## Installation
    composer require varm3r/tmpl

## How to Use
To create template by text:
```php
try {
    // variables
    $text = '<h1>{title}</h1>';
    $tmpl = \Tmpl\Factory::createByText($text);
    echo $tmpl->render(['title' => 'my header']); // it will output "<h1>my header</h1>"
    echo $tmpl->render(['title' => 'subtitle']); // it will output "<h1>subtitle</h1>"
    
    // if-conditions
    $text = '{if userName}Hello {userName}!{/if}';
    $tmpl = \Tmpl\Factory::createByText($text);
    echo $tmpl->render(['userName' => 'Adam']); // it will output "Hello Adam!"
    
    // nested if-else conditions
    $text =<<<TEXT
{if test1}
    white {if test2}dog{else}cat{/if}
{else}
    gray {if test2}wolf{else}bird{/if}
{/if}
TEXT;
    $tmpl = \Tmpl\Factory::createByText($text);
    echo $tmpl->render(['test1' => true, 'test2' => false]); // it will output "white cat"
    echo $tmpl->render(['test1' => false, 'test2' => true]); // it will output "gray wolf"

} catch (\Tmpl\Exception\Exception $e) {
    // an exception will be thrown if template has error
}
```

It is posible to create template by filepath:
```php
try {
    $filepath = '/path/to/file.tpl';
    $tmpl = \Tmpl\Factory::create($filepath);
    echo $tmpl->render(['title' => 'excelent!']);
} catch (\Tmpl\Exception\Exception $e) {
    // an exception will be thrown if file does not exists or cannot be read
}
```
