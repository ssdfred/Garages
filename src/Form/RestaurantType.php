<?php

namespace App\Form;

use App\Entity\Restaurant;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class RestaurantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            
            ->add("name", TextType::class, [
                "label" => "name",
                "required" => true,
            ])
            ->add("nb_couverts",TextType::class, [
                "label" => "nombre de personne",
                "required" => true,
            ])

            ->add("users", TextType::class)
            ->add("menus", TextType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            "data_class" => Restaurant::class,

        ]);
    }
}
