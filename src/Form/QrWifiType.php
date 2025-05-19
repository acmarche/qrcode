<?php

namespace AcMarche\QrCode\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class QrWifiType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'ssid',
                TextType::class,
                [
                    'required' => true,
                    'label' => 'Nom du Wifi',
                    'help' => 'Son ssid',
                    'attr' => ['autocomplete' => 'off'],
                ],
            )
            ->add(
                'password',
                TextType::class,
                [
                    'required' => false,
                    'label' => 'Mot de passe',
                    'attr' => ['autocomplete' => 'off'],
                ],
            )
            ->add(
                'encryption',
                ChoiceType::class,
                [
                    'required' => true,
                    'label' => 'Méthode de cryptage',
                    'help' => 'WEP or WPA',
                    'choices' => ['WEP' => "WEP", 'WPA' => 'WPA'],
                    'attr' => ['autocomplete' => 'off'],
                ],
            )
            ->add(
                'isHidden',
                CheckboxType::class,
                [
                    'required' => true,
                    'label' => 'Le wifi est caché',
                    'help' => 'Si oui, cochez la case',
                    'attr' => ['autocomplete' => 'off'],
                ],
            );
    }

    public function getParent(): string
    {
        return QrCodeType::class;
    }
}