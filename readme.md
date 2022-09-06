# Onlinq Form Collection Bundle

Symfony bundle to build forms with [Onlinq Form Collection][component] web
components.

It allows [form collections][form-collections] to be manipulated through
JavaScript and customizable buttons.

## Installation

Onlinq Form Collection Bundle requires PHP 7.2+ and Symfony 4.4+.

Install this bundle using Composer and Symfony Flex:

```bash
composer require onlinq/form-collection-bundle
```

The easiest way to enable the Onlinq Form Collection web components in forms is
by adding one of the [built-in form themes](#built-in-form-themes) to the
project's Twig configuration:

```yaml
# config/packages/twig.yaml

twig:
    form_themes:
        - '@OnlinqFormCollection/collection_theme.html.twig'
```

Make sure to add the Onlinq Form Collection script to pages with forms through
a [JavaScript bundler](#using-a-javascript-bundler) or by including it at the
bottom of your page with: 

```html
<script src="{{ asset('bundles/onlinqformcollection/onlinq-collection.js') }}"></script>
```

Read on to start using the bundle immediately or visit the [documentation](./docs).

## Usage

The Onlinq Form Collection web components are enabled when a compatible form
theme has been loaded. The easiest way to configure the resulting form
collection is by using the built-in form type that can be used as a drop-in
replacement for the Symfony [`CollectionType`][collection-type] class:

```php
// ...
use Onlinq\FormCollectionBundle\Form\OnlinqCollectionType;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // ...
            ->add('tags', OnlinqCollectionType::class, [
                'entry_type' => TagType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'allow_move' => true,
            ])
            // ...
        ;
    }

    // ...
}
```

### Built-in form themes

The bundle includes multiple built-in form themes to make collections look great
without having to create your own styling:

- `@OnlinqFormCollection/collection_theme.html.twig`
- `@OnlinqFormCollection/bootstrap_4_collection_theme.html.twig`
- `@OnlinqFormCollection/bootstrap_5_collection_theme.html.twig`

Learn more about the built-in form themes in the [documentation](./docs/getting-started.md#collection-form-themes).

### Using a JavaScript bundler

When using a bundler like Webpack it's possible to include the Onlinq Form
Collection web components through the compiled JavaScript bundle.

Install the Onlinq Form Collection web components package:

```bash
npm install @onlinq/form-collection
```

Import the package in the project's JavaScript assets:

```js
// assets/js/app.js

import '@onlinq/form-collection';
```

[component]: https://github.com/onlinq/form-collection
[form-collections]: https://symfony.com/doc/current/form/form_collections.html
[form-themes]: https://symfony.com/doc/current/form/form_themes.html
[collection-type]: https://symfony.com/doc/current/reference/forms/types/collection.html
