<?php

namespace App\Form;

use App\Entity\Detail;
use App\Entity\Subscription;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\UX\Dropzone\Form\DropzoneType;

class UserFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [])
            ->add('password', RepeatedType::class, [])
            ->add('username', TextType::class, [])
            ->add('fullname', TextType::class, [])
            ->add('image', DropzoneType::class, [
                'mapped' => false, // Déconnexion du lien avec l'entité
                'row_attr' => ['class' => 'mb-3'],
                'label' => '',
                'label_attr' => ['class' => 'form-control'],
                'constraints' => [
                    new Image([
                        'mimeTypes' => [
                            'jpg','jpeg', 'png'
                        ],
                        'mimeTypesMessage' => 'L\'image doit être au format .jpg, .jpeg ou .png',
                    ]),
                ]
            ])

            //Prêt
            ->add('sumbit', SubmitType::class, [
                'label' => 'Modifier mon profil',
                'attr' => ['class' => 'btn btn-primary'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
