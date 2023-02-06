<?php
namespace App\Form;


use App\Entity\Reservation;


use Container7ozhulI\getFieldCollectionService;
use Symfony\Component\Form\AbstractType;
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
                "label" => "veuillez indiqué le nombre de personnes",
                    "required" => true,
                  
                ])
                ->add("Date", textType::class, [
                    "label" => "veuillez indiqué le nombre de personnes",
                        "required" => true,
                     
                    ])
                    ->add("reservation_heure", TextType::class, [
                        "label" => "veuillez indiqué les heures",
                            "required" => true,
                        
                            ])
                            ->add('allergie');
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }

}

