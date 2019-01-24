<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class PressItemType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', null, ['label' => 'Titre de la publication'])
            ->add('publishedAt', null, ['label' => 'Date de publication', 'widget' => 'single_text'])
            ->add('document', null, ['label' => 'ou Fichier', 'required' => false])
            ->add('link', null, ['label' => 'Lien'])
            ->add('source', ChoiceType::class, [
              'label' => 'Source (Journal / Revue / Site web)',
              'choices' => [
                'Rapport à télécharger' => 'Rapport à télécharger',
                'Autre' => 'other',
              ],
            ]);
    }
}
