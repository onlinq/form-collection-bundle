<?php
/**
 * Copyright Onlinq B.V.
 */

namespace Onlinq\FormCollectionBundle\DependencyInjection;

use Onlinq\FormCollectionBundle\Form\OnlinqCollectionType;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Extension\Extension;

class OnlinqFormCollectionExtension extends Extension
{
    public function load(array $configurations, ContainerBuilder $container): void
    {
        $container
            ->setDefinition(OnlinqCollectionType::class, new Definition(OnlinqCollectionType::class))
            ->addTag('form.type')
            ->setPublic(false)
        ;
    }
}
