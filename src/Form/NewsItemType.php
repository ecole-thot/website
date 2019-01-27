<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class NewsItemType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', null, ['label' => 'Titre de la news'])
            ->add('content', null, ['label' => 'Texte'])
            ->add('image', null, ['required' => false, 'label' => 'Mettre à jour l\'image'])
            ->add('theme', ChoiceType::class, [
              'label' => 'Thème',
              'choices' => [
                'Rapport à télécharger' => 'Rapport à télécharger',
                'L\'école' => 'L\'école',
              ],
            ]);
    }
}
