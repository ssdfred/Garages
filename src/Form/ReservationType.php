<?php
namespace App\Form;


use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("name", TextType::class, [
                "label" => "votre nom",
                "required" => true,
                "constraints" => [
                    new NotBlank(["message" => "Le nom ne doit pas etre vide"])
                ]
            ])
            ->add("nb_personnes", TextType::class, [
                "label" => "veuillez indiqué le nombre de personnes",
                    "required" => true,
                    "constraints" => [
                        new NotBlank(["Le nombre de personnes est obligatoire"])
                    ]
                ]);
    }


}

