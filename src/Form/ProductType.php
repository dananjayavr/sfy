<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Positive;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => "Vous n'avez pas saisi le nom du produit"
                    ]),
                    new Length([
                        'min' => 5,
                        'max' => 150,
                        'minMessage' => 'Le nom doit contenir au moins {{ limit }} caractères',
                        'maxMessage' => 'Le nom ne doit pas dépasser {{ limit }} caractères'
                    ])
                ]
            ])
            ->add('description', TextareaType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => "Vous n'avez pas saisi la description du produit"
                    ])
                ]
            ])
            ->add('price',MoneyType::class,[
                'constraints' => [
                    new NotBlank([
                        'message' => "Vous n'avez pas saisi le prix du produit"
                    ]),
                    new Positive([
                        'message' => 'Le prix doit être supérieur à zéro'
                    ])
                ]
            ])
            ->add('imageFile', VichImageType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Vous devez séléctionner un image du produit'
                    ]),
                ],
                'download_label' => 'Télécharger l\'image',
                'download_uri' => false,
                'delete_label' => 'Supprimer l\'image',
                'allow_delete' => true
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}