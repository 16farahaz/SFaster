<?php

namespace App\Form;

use App\Entity\Facture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FactureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('modele_id')
            ->add('outil_id')
            ->add('idfacture')
            ->add('prix_outil')
            ->add('temps')
            ->add('prixtotale')
            ->add('gamme_usinage_id')
            ->add('energie_id')
            ->add('matieres_id')
            ->add('prix_energie')
            ->add('puissance_machine')
            ->add('prix_totale_energie')
            ->add('quantity')
            ->add('prix_matiere')
            ->add('prix_totale_matiere')
            ->add('nombre_employer')
            ->add('salaire_employer')
            ->add('nombre_piece')
            ->add('accessoire_id')
            ->add('prix_accessoire')
            ->add('quantite_accessoire')
            ->add('prix_totale_accessoire')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Facture::class,
        ]);
    }
}
