<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class TeamMemberType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, ['label' => 'Nom'])
            ->add('job', null, ['label' => 'Poste'])
            ->add('sortingOrder', null, ['label' => 'Ordre (Chiffre entier positif — plus petit => en premier)'])
            ->add('image', null, ['label' => 'Image', 'required' => false]);
    }
}
