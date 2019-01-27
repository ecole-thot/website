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
            ->add('issue', null, ['label' => 'Numéro, éition ou détails'])
            ->add('link', null, ['label' => 'Lien'])
            ->add('source', ChoiceType::class, [
              'label' => 'Source (Journal / Revue / Site web)',
              'choices' => [
                'Le Point' => 'le_point',
                'France Inter' => 'france_inter',
                'Huffington Post' => 'huffington_post',
                'Libération' => 'liberation',
                'France 24' => 'france_24',
                'RFI' => 'rfi',
                'Le Parisien' => 'le_parisien',
                'L\'Humanité' => 'l_humanite',
                'Care News' => 'carenews',
                'France Culture' => 'france_culture',
                'ELLE' => 'elle',
                'L\'Obs' => 'l_obs',
                '|\'ADN' => 'l_adn',
                'JDD' => 'jdd',
                'Arte' => 'arte',
                'Actualitté' => 'actualitte',
                'TV5MONDE' => 'tv5_monde',
                'Télérama' => 'telerama',
                'TedX' => 'tedx',
                'Society' => 'society',
                'RTL' => 'rtl',
                'Psychologies' => 'psychologies',
                'Mediapart' => 'mediapart',
                'Marianne' => 'marianne',
                'Madmoizelle' => 'madmoizelle',
                'NOVA' => 'nova',
                'Les Inrocks' => 'les_inrocks',
                'Le Figaro' => 'le_figaro',
                'LCI' => 'lci',
                'La Croix' => 'la_croix',
                'L\'express' => 'l_express',
                'L\'étudiant' => 'l_etudiant',
                '20 Minutes' => '20_minutes',
                'BBC Afrique' => 'bbc_afrique',
                'Cheek Magazine' => 'cheek',
                'Clique.tv' => 'clique',
                'Courrier de l\'Atlas' => 'courrier_atlas',
                'Le Monde' => 'le_monde',
                'Les petts frenchies' => 'petit_frenchies',
                'Ulule' => 'ulule',
                'Autre' => 'news',
              ],
            ]);
    }
}
