<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class ExamSessionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', ChoiceType::class, [
              'label' => 'Type',
              'choices' => [
                'DILF' => 1,
                'DELF A1/A2' => 2,
                'DELF B1' => 3,
              ],
            ])
            ->add('sessionDate', null, ['widget' => 'single_text', 'label' => 'Date de session', 'attr' => ['placeholder' => 'Format : 2019-12-23T13:30:00']])
            ->add('inscriptionMaxDate', null, ['widget' => 'single_text', 'label' => 'Date maximum d\'inscription', 'attr' => ['placeholder' => 'Format : 2019-12-23T13:30:00']])
            ->add('closed', null, ['label' => 'Inscriptions closes']);
    }
}
