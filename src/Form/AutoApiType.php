<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AutoApiType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('brand', TextType::class, [
                'label' => 'ИД производителя'
            ])
            ->add('articul', TextType::class, [
                'label' => 'Артикул'
            ])
            ->add('storage', ChoiceType::class, [
                'choices' => [
                    'Только склад АС' => 'as',
                    'АС и транзитные' => 'tranzit',
                ],
                'label' => 'Учитывать склады'
            ])
            ->add('send', SubmitType::class, [
                'label' => 'Отправить запрос'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
