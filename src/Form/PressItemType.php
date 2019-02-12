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
            ->add('issue', null, ['label' => 'Numéro, édition ou détails (optionnel)'])
            ->add('link', null, ['label' => 'Lien'])
            ->add('source', ChoiceType::class, [
              'label' => 'Source (Journal / Revue / Site web)',
              'choices' => [
                '20 Minutes' => '20_minutes',
                'Actualitté' => 'actualitte',
                'Arte' => 'arte',
                'Au Féminin' => 'au_feminin',
                'BBC Afrique' => 'bbc_afrique',
                'Care News' => 'carenews',
                'Cheek Magazine' => 'cheek',
                'Clique.tv' => 'clique',
                'Courrier de l\'Atlas' => 'courrier_atlas',
                'Deezer' => 'deezer',
                'ELLE' => 'elle',
                'France 24' => 'france_24',
                'France Culture' => 'france_culture',
                'France Inter' => 'france_inter',
                'Grazia' => 'grazia',
                'Huffington Post' => 'huffington_post',
                'JDD' => 'jdd',
                'L\'ADN' => 'l_adn',
                'L\'Express' => 'l_express',
                'L\'Humanité' => 'l_humanite',
                'L\'Obs' => 'l_obs',
                'L\'étudiant' => 'l_etudiant',
                'La Croix' => 'la_croix',
                'LCI' => 'lci',
                'Le Figaro' => 'le_figaro',
                'Le Monde' => 'le_monde',
                'Le Mouv\'' => 'le_mouv',
                'Le Nouvel Obs' => 'le_nouvel_obs',
                'Le Parisien' => 'le_parisien',
                'Le Point' => 'le_point',
                'Les Inrocks' => 'les_inrocks',
                'Les petts frenchies' => 'petit_frenchies',
                'Libération' => 'liberation',
                'Madmoizelle' => 'madmoizelle',
                'Marianne' => 'marianne',
                'Mediapart' => 'mediapart',
                'NOVA' => 'nova',
                'Psychologies' => 'psychologies',
                'RFI' => 'rfi',
                'RTBF' => 'rtbf',
                'RTL' => 'rtl',
                'Society' => 'society',
                'TedX' => 'tedx',
                'TV5MONDE' => 'tv5_monde',
                'Télérama' => 'telerama',
                'Ulule' => 'ulule',
                'Autre' => null,
              ],
            ]);
    }
}
