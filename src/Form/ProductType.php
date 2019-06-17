<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Product;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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
        //dd($options);
        /*
         * le paramètre option fournit des informations relatives au formulaire
         * clé data fournit l'entité en cours de modification
         * si l'identité possède un identifiant, pas de contrainte, sinon on met le contrainte NotBlank
         */
        $builder
            ->add('name',TextType::class, [
                'constraints' =>  [
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
            ->add('category', EntityType::class,[
                'class' => Category::class,
                'choice_label' => 'name',
                'constraints' => [
                    new NotBlank([
                        'message' => "Vous n'avez pas saisi la catégorie du produit"
                    ])
                ],
                'placeholder' => 'Choisir une catégorie',
                'expanded' => false,
                'multiple' => false
            ])
            ->add('imageFile', VichImageType::class, [
                'constraints' => $options['data']->getId() ? [] : [
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