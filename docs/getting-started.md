# Getting Started

## Installation

Add the Onlinq Form Collection Bundle to your project with Composer:

```bash
composer require @onlinq/form-collection-bundle
```

If you're using Symfony Flex (enabled by default for new Symfony projects) the
bundle will be included in your project automatically.

Note that Onlinq Form Collection Bundle requires PHP 7.2+ and Symfony 4.4 or
Symfony 5.x.

Additionally, you'll need to include the Onlinq Form Collection web components'
JavaScript on your form pages. The recommended way to install the web components
is through a package bundler like Webpack, but they're also available as public
assets provided by the bundle after running `bin/console assets:install`:

```html
<script src="{{ asset('bundles/onlinqformcollection/onlinq-collection.js') }}"></script>

<!-- Optionally include the CSS on your page -->
<link rel="stylesheet" href="{{ asset('bundles/onlinqformcollection/onlinq-collection.css') }}">
```

For more information about the JavaScript integration, see the [Onlinq Form Collection web components][component].

## Collection Form Themes

The bundle comes with a number of pre-defined form themes that use the Onlinq
Form Collection web components. Learn more about using form themes in the
[Symfony documentation][form-themes].

- `@OnlinqFormCollection/collection_theme.html.twig`  
  A basic form theme adding support for form collections with custom stylable
  buttons.

- `@OnlinqFormCollection/bootstrap_collection_theme.html.twig`  
  A form theme with the appropriate CSS classes for use with the [Bootstrap CSS Framework][bootstrap].

To use one of the form themes globally, add it to the Twig Bundle configuration:

```yaml
# config/packages/twig.yaml

twig:
    # ...
    form_themes:
        - '@OnlinqFormCollection/collection_theme.html.twig'
```

## OnlinqCollectionType

In addition to custom form themes, the bundle also includes the `OnlinqCollectionType`
form type class with additional configuration options for dynamic collections
which can be used as a drop-in replacement for the Symfony [`CollectionType`][collection-type]
class.

```php
<?php

namespace App\Form;

use Onlinq\FormCollectionBundle\Form\OnlinqCollectionType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class UserSurveyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('fruits', OnlinqCollectionType::class, [
                // Form and regular collection options
                'label' => 'Enter your favorite fruits:',
                'entry_type' => TextType::class,
                'entry_options' => [
                    'label' => false,
                ],
                'allow_add' => true,
                'allow_delete' => true,

                // Custom options for OnlinqCollectionType
                'allow_move' => true,
                'min' => 0,
                'max' => 5,
            ])
        ;
    }
}
```

[component]: https://github.com/onlinq/form-collection
[bootstrap]: https://getbootstrap.com/
[form-themes]: https://symfony.com/doc/current/form/form_themes.html
[collection-type]: https://symfony.com/doc/current/reference/forms/types/collection.html
