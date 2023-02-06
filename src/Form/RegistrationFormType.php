<?php

namespace App\Form;


use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Context\ExecutionContext;


class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add("name", TextType::class, [
                "label" => "Nom",
                "required" => true
            ])
            ->add("nb_personnes",TextType::class, [
                "label" => "nombre de personne",
                "required" => true,
            ])
            ->add('email')
            /*->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])*/
            ->add('Password', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
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

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
