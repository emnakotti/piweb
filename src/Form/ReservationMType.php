<?php

namespace App\Form;

use App\Entity\Reservation;
use App\Entity\Service; // Ajoutez cette ligne
use Symfony\Bridge\Doctrine\Form\Type\EntityType; // Ajoutez cette ligne
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType; // Ajoutez cette ligne

class ReservationMType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('quantite', IntegerType::class, [
                'label' => 'Quantité',
                'attr' => [
                    'min' => 1,
                    'max' => $options['max_quantity'],
                    'class' => 'form-control'
                ],
                'required' => true,
            ])
            ->add('date', DateTimeType::class, [
                'label' => 'Date et heure',
                'widget' => 'single_text',
                'attr' => ['class' => 'form-control'],
                'required' => true,
            ])
            ->add('service', EntityType::class, [
                'label' => 'Service',
                'class' => Service::class,
                'choice_label' => 'nom', // Supposons que votre entité Service a une propriété 'nom'
                'attr' => ['class' => 'form-control'],
                'required' => true,
            ])

            ->add('dateReservation', DateTimeType::class, [
                'label' => 'Date et heure',
                'widget' => 'single_text',
                'html5' => false, // Important pour le contrôle côté client
                'attr' => [
                    'class' => 'form-control datetimepicker',
                    'data-date-format' => 'YYYY-MM-DD HH:mm'
                ],
                'required' => true,
                'empty_data' => new \DateTime(), // Valeur par défaut si vide
                'invalid_message' => 'La date doit être au format YYYY-MM-DD HH:mm',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
            'max_quantity' => null,
        ]);

        $resolver->setDefined(['max_quantity']);
    }
}
