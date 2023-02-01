<?php

namespace App\Form;


use App\Entity\Client;
;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
//use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
//use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
//use Symfony\Component\Validator\Constraints\Url;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Context\ExecutionContext;

class RestaurantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("email", TextType::class, [
                "label" => "Email",
                "required" => true,
                "constraints" => [
                    new Length(["min" => 2, "max" => 180, "minMessage" => "Le nom d'utilisateur ne doit pas faire moins de 2 caractères", "maxMessage" => "Le nom d'utilisateur ne doit pas faire plus de 180 caractères"]),
                    new NotBlank(["message" => "L'email ne doit pas être vide !"])
                ]
            ])
            ->add("name", TextType::class, [
                "label" => "name",
                "required" => true,
            ])
            ->add("nb_perssones",TextType::class, [
                "label" => "nombre de personne",
                "required" => true,
            ])
            ->add("role", ChoiceType::class, [
                'choices' => [
                    'Utilisateur' => "ROLE_USER",
                    'Administrateur' => "ROLE_ADMIN"
                ]
            ])
            ->add("password", PasswordType::class, [
                "label" => "Mot de passe",
                "required" => true,
                "constraints" => [
                    new NotBlank(["message" => "Le mot de passe ne peut pas être vide !"])
                ]
            ])
            ->add("confirm", PasswordType::class, [
                "label" => "Confirmer le mot de passe",
                "required" => true,
                "constraints" => [
                    new NotBlank(["message" => "Le mot de passe ne peut pas être vide !"]),
                    // new EqualTo(["propertyPath" => "password", "message" => "Les mots de passe doivent être identique !"])
                    new Callback(['callback' => function ($value, ExecutionContext $ec) {
                        dump($ec->getRoot()['password']->getViewData() !== $value);
                        if ($ec->getRoot()['password']->getViewData() !== $value) {
                            $ec->addViolation("Les mots de passe doivent être identique !");
                        }
                    }])
                ]
            ]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            "data_class" => Client::class,
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'csrf_token_id'   => 'client_item',
        ]);
    }
}
