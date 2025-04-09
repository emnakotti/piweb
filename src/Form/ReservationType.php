<?php

namespace App\Form;

use App\Entity\Reservation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Validator\Constraints\Callback;



class ReservationType extends AbstractType
{
    // src/Form/ReservationType.php

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('quantite', IntegerType::class, [
                'label' => 'Quantité',
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Positive(),
                    new Assert\LessThanOrEqual([
                        'value' => $options['max_quantity'],
                        'message' => 'La quantité demandée dépasse le stock disponible'
                    ]),
                ],
                'attr' => [
                    'min' => 1,
                    'max' => $options['max_quantity'],
                    'class' => 'form-control'
                ]
            ])
            ->add('dateReservation', DateTimeType::class, [
                'label' => 'Date et heure de réservation',
                'widget' => 'single_text',
                'data' => new \DateTime(), // Valeur par défaut
                'attr' => [
                    'min' => (new \DateTime())->format('Y-m-d\TH:i')
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\GreaterThanOrEqual('today')
                ]
            ]);
    }

    public function validateBusinessHours($value, ExecutionContextInterface $context)
    {
        if ($value === null) {
            return;
        }

        $hour = (int)$value->format('H');
        if ($hour < 9 || $hour >= 18) {
            $context->buildViolation('Les réservations sont possibles entre 9h et 18h')
                ->atPath('dateReservation')
                ->addViolation();
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
            'max_quantity' => 100, // Valeur par défaut
        ]);
    }
}
