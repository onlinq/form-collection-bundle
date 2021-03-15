<?php
/**
 * Copyright Onlinq B.V.
 */

namespace Onlinq\FormCollectionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OnlinqCollectionType extends AbstractType
{
    public function buildView(FormView $view, FormInterface $form, array $options): void
    {
        $view->vars = array_replace($view->vars, [
            'allow_move' => $options['allow_move'],
            'min' => $options['min'],
            'max' => $options['max'],
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'allow_add' => true,
            'allow_delete' => true,
            'allow_move' => true,
            'min' => 0,
            'max' => 0,
        ]);
    }

    public function getParent(): string
    {
        return CollectionType::class;
    }
}
