<?php

namespace App\Form;

use App\Entity\PackEvenement;
use App\Entity\Locaux;
use App\Entity\Service;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\GreaterThan;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Positive;

class PackEvenementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom du pack',
                'attr' => ['class' => 'form-control'],
                'constraints' => [
                    new NotBlank(['message' => 'Le nom est obligatoire']),
                    new Length([
                        'min' => 3,
                        'max' => 255,
                        'minMessage' => 'Le nom doit contenir au moins {{ limit }} caractères',
                        'maxMessage' => 'Le nom ne peut pas dépasser {{ limit }} caractères'
                    ])
                ]
            ])
            ->add('type', ChoiceType::class, [
                'label' => 'Type d\'événement',
                'choices' => [
                    'Mariage' => 'Mariage',
                    'Conférence' => 'Conférence',
                    'Fête' => 'Fête',
                    'Autre' => 'Autre'
                ],
                'attr' => ['class' => 'form-select'],
                'constraints' => [
                    new NotBlank(['message' => 'Le type est obligatoire'])
                ]
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'required' => false,
                'attr' => ['class' => 'form-control', 'rows' => 5],
                'constraints' => [
                    new Length([
                        'max' => 1000,
                        'maxMessage' => 'La description ne peut pas dépasser {{ limit }} caractères'
                    ])
                ]
            ])
            ->add('prix', NumberType::class, [
                'label' => 'Prix',
                'scale' => 2,
                'attr' => ['class' => 'form-control'],
                'constraints' => [
                    new NotBlank(['message' => 'Le prix est obligatoire']),
                    new Positive(['message' => 'Le prix doit être positif'])
                ]
            ])
            ->add('nbreInvitesMax', NumberType::class, [
                'label' => 'Nombre maximum d\'invités',
                'required' => false,
                'attr' => ['class' => 'form-control'],
                'constraints' => [
                    new GreaterThanOrEqual([
                        'value' => 1,
                        'message' => 'Le nombre d\'invités doit être au moins 1'
                    ])
                ]
            ])
            ->add('budgetPrevu', NumberType::class, [
                'label' => 'Budget prévu',
                'scale' => 2,
                'required' => false,
                'attr' => ['class' => 'form-control'],
                'constraints' => [
                    new Positive(['message' => 'Le budget doit être positif'])
                ]
            ])
            ->add('dateEvenement', DateType::class, [
                'label' => 'Date de l\'événement',
                'widget' => 'single_text',
                'required' => false,
                'attr' => ['class' => 'form-control'],
                'constraints' => [
                    new GreaterThan([
                        'value' => 'today',
                        'message' => 'La date doit être dans le futur'
                    ])
                ]
            ])
            ->add('lieu', EntityType::class, [
                'class' => Locaux::class,
                'choice_label' => 'adresse',
                'placeholder' => 'Sélectionnez un local',
                'required' => true,
                'mapped' => true,
                'attr' => ['class' => 'form-select'],
                'constraints' => [
                    new NotBlank(['message' => 'Le lieu est obligatoire'])
                ]
            ])
            ->add('services', EntityType::class, [
                'class' => Service::class,
                'choice_label' => 'nomService',
                'multiple' => true,
                'expanded' => true,
                'required' => false,
                // Optionnel : ajout d'un attribut pour l'image, si besoin
                'choice_attr' => function(Service $service, $key, $index) {
                     return ['data-image-url' => $service->getImageUrl()];
                },
            ])                       
            ->add('photoFile', FileType::class, [
                    'label' => 'Photo',
                    'mapped' => false, // Ce champ n'est pas mappé à une propriété de l'entité
                    'required' => false,
                    'constraints' => [
                        new File([
                            'maxSize' => '5M',
                            'mimeTypes' => [
                                'image/jpeg',
                                'image/png',
                                'image/gif',
                            ],
                            'mimeTypesMessage' => 'Veuillez télécharger une image valide (JPG, PNG, GIF).',
                        ]),
                    ],
            ])
            ->add('statut', ChoiceType::class, [
                'label' => 'Statut',
                'choices' => [
                    'Actif' => 'actif',
                    'Inactif' => 'inactif',
                    'Archivé' => 'archivé'
                ],
                'attr' => ['class' => 'form-select'],
                'constraints' => [
                    new NotBlank(['message' => 'Le statut est obligatoire'])
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PackEvenement::class,
        ]);
    }
} 