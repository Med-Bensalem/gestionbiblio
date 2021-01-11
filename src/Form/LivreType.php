<?php

namespace App\Form;

use App\Entity\Auteur;
use App\Entity\Categorie;
use App\Entity\Editeur;
use App\Entity\Livre;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LivreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre',TextType::class,['attr' =>['class'=>'form-control'],
        'label' => 'Titre'])
            ->add('nbpages',NumberType::class,['attr' =>['class'=>'form-control'],
                'label' => 'Nombre de page'])
            ->add('dateedition',DateType::class,
                ['widget' => 'single_text','attr'=>['class' =>'form-control'],
                    'label'=>'Date Edition'])
            ->add('nbexemplaires',NumberType::class,['attr' =>['class'=>'form-control'],
                'label' => 'Nombre Exemplaires'])
            ->add('prix',NumberType::class,['attr' =>['class'=>'form-control'],
                'label' => 'Prix'])
            ->add('isbn',NumberType::class,['attr' =>['class'=>'form-control'],
                'label' => 'ISBN'])
            ->add('editeur',EntityType::class,
                ['attr' =>['class'=>'form-control'],
                'label' => 'Editeur',
                'class'=>Editeur::class,
                    'multiple'=>false,
                    'expanded'=>false,
                    'choice_label'=>'nomediteur'])
            ->add('categorie',EntityType::class,
                ['attr' =>['class'=>'form-control'],
                    'label' => 'Categorie',
                    'class'=>Categorie::class,
                    'multiple'=>false,
                    'expanded'=>false,
                    'choice_label'=>'designation'])
            ->add('auteur',EntityType::class,
            ['attr'=>['class'=>'form-control'],
            'label'=>'Auteurs',
            'class' => Auteur::class,
             'multiple'=> true,
                'expanded' =>false,
                'choice_label' => function($auteur){
                return $auteur->getPrenom()." ".$auteur->getNom();
                }
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Livre::class,
        ]);
    }
}
