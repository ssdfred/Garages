<?php

namespace App\Form;

use App\Entity\Reservation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /**
         * @link buildView()
         */
        $builder
            ->add("name", TextType::class, [
                "label" => "votre nom",
                "required" => true,
            ])
            ->add("nb_personnes", TextType::class, [
                "label" => "veuillez indiquer le nombre de personnes",
                "required" => true,
            ])
            ->add("date", DateType::class,  [
                "label" => "Date de reservation",
               // "attr"=> ['class' => 'js-datapicker'],
               "widget" => "single_text",
               'placeholder' => [
                  'year' => 'Year', 'month' => 'Month', 'day' => 'Day',
                "html5"=> false,
                "date_format"=> "%d/%m/%Y",
                 "required" => true,
                    ]])
            ->add("reservation_heure", TimeType::class, [
                "label" => "veuillez indiquer l'heure",
                "widget" => "single_text",
                "placeholder" => [
                    "hour" => "Hour",
                    "minute" => "Minute",
                    "second" => "Second",
                ],
                
                "required" => true,
            ])
            ->add("allergie", TextType::class, [
                "label" => "Allergies",
                "required" => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            "data_class" => Reservation::class,
            "html5" => false,
        ]);
    }
}
