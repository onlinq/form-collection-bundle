<?php

/*
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
        $actionList = [];

        if ($options['allow_add']) {
            $actionList[] = 'add';
        }
        if ($options['allow_delete']) {
            $actionList[] = 'delete';
        }
        if ($options['allow_move']) {
            $actionList[] = 'move';
        }

        $view->vars = array_replace($view->vars, [
            'collection_actions' => $options['collection_actions'],
            'collection_action_list' => implode(' ', $actionList),
            'allow_move' => $options['allow_move'],
            'min' => $options['min'],
            'max' => $options['max'],
        ]);
    }

    public function finishView(FormView $view, FormInterface $form, array $options)
    {
        $prefixOffset = -2;
        // check if the entry type also defines a block prefix
        /** @var FormInterface $entry */
        foreach ($form as $entry) {
            if ($entry->getConfig()->getOption('block_prefix')) {
                --$prefixOffset;
            }

            break;
        }

        foreach ($view as $entryView) {
            array_splice($entryView->vars['block_prefixes'], $prefixOffset, 0, 'onlinq_collection_entry');
        }

        /** @var FormInterface $prototype */
        if ($prototype = $form->getConfig()->getAttribute('prototype')) {
            if ($view->vars['prototype']->vars['multipart']) {
                $view->vars['multipart'] = true;
            }

            if ($prefixOffset > -3 && $prototype->getConfig()->getOption('block_prefix')) {
                --$prefixOffset;
            }

            array_splice($view->vars['prototype']->vars['block_prefixes'], $prefixOffset, 0, 'onlinq_collection_entry');
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'collection_actions' => true,
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

    public function getBlockPrefix(): string
    {
        return 'onlinq_collection';
    }
}
