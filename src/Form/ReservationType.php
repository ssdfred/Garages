<?php

namespace App\Form;
use Symfony\Component\Validator\Constraints\Time;
use App\Service\ReservationService;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\Reservation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /**
         * @link buildView()
         */
        $heures = ['12:15', '12:30', '12:45', '13:00', '13:15', '13:30', '13:45', '17:15', '17:30', '17:45', '18:00', '18:15', '18:30', '18:45',];
        $builder
            ->add("name", TextType::class, [
                "label" => "votre nom",
                "required" => true,
            ])
            ->add("nb_personnes", TextType::class, [
                "label" => "veuillez indiquer le nombre de personnes",
                "required" => true,
            ])
            ->add("date", DateType::class, [
                "label" => "Date de reservation",
                "widget" => "single_text",
                "format" => "dd/MM/yyyy",
                "required" => true,
                "html5" => false,
            ])
            
            ->add('reservation_heure', ChoiceType::class, [
                'label' => "veuillez indiquer l'heure",
                'choices' => array_combine($heures, $heures),
                'expanded' => true, // affiche les choix sous forme de boutons
                'multiple' => false, // un seul choix possible
                'required' => true,
                'constraints' => [
                    new Time(), // ajout de la contrainte Time pour valider l'heure
                ],
               
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
