<?php

namespace App\Form\Type;

use App\Controller\Contact;
use App\Entity\Contacts;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class, ['attr' => ['class' => 'form-control mb-3']]);
        $builder->add('address', TextType::class, ['attr' => ['class' => 'form-control mb-3']]);
        $builder->add('phone_number', TextType::class, ['attr' => ['class' => 'form-control mb-3']]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => Contacts::class,
            ]
        );
    }
}
