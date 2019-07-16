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
            ->add('linkedFile', null, ['required' => false, 'label' => 'Mettre à jour le fichier associé'])
            ->add('theme', ChoiceType::class, [
              'label' => 'Thème',
              'choices' => [
                "Rapport d'activité" => "Rapport d'activité",
                "L'école" => "L'école",
                'Partenaires' => 'Partenaires',
                'Développement' => 'Développement',
                'Financement' => 'Financement',
                'Prise de parole' => 'Prise de parole',
                'Conférences' => 'Conférences',
              ],
            ]);
    }
}
