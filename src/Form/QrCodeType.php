<?php

namespace AcMarche\QrCode\Form;

use AcMarche\QrCode\Entity\QrCode;
use Endroid\QrCode\Label\LabelAlignment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QrCodeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'url',
                UrlType::class,
                [
                    'required' => false,
                    'label' => 'Url web',
                    'help' => 'Url du site web',
                    'attr' => ['autocomplete' => 'off'],
                ],
            )
            ->add(
                'dataFile',
                FileType::class,
                [
                    'label' => 'Fichier',
                    'help' => 'Charger votre fichier, un audio, un txt, une vidéo...',
                    'required' => false,
                ],
            )
            ->add(
                'color',
                ColorType::class,
                [
                    'required' => false,
                    'label' => 'Couleur des traits',
                ],
            )
            ->add(
                'colorBackground',
                ColorType::class,
                [
                    'required' => false,
                    'label' => 'Couleur de fond',
                ],
            )
            ->add(
                'size',
                IntegerType::class,
                [
                    'required' => false,
                    'label' => 'Taille',
                    'help' => 'Taille en pixel (1200 par défaut)',
                ],
            )
            ->add(
                'labelText',
                TextType::class,
                [
                    'required' => false,
                    'label' => 'Label',
                    'help' => 'Le label se mettra en dessous du qr code',
                    'attr' => ['autocomplete' => 'off'],
                ],
            )
            ->add(
                'labelSize',
                IntegerType::class,
                [
                    'required' => false,
                    'label' => 'Taille',
                    'help' => 'Taille en pixel (32 par défaut)',
                ],
            )
            ->add(
                'labelColor',
                ColorType::class,
                [
                    'required' => false,
                    'label' => 'Couleur du texte',
                ],
            )
            ->add(
                'labelAlignment',
                EnumType::class,
                [
                    'class' => LabelAlignment::class,
                    'required' => true,
                    'label' => 'Alignement',
                ],
            )
            ->add(
                'logo',
                FileType::class,
                [
                    'label' => 'Logo',
                    'help' => 'Ajoute un logo au milieu du QrCode',
                    'required' => false,
                ],
            )
            ->add(
                'logoSize',
                IntegerType::class,
                [
                    'required' => false,
                    'label' => 'Taille du logo',
                    'help' => 'Taille en pixel (200 par défaut)',
                ],
            )
            ->add(
                'persistInDatabase',
                CheckboxType::class,
                [
                    'required' => false,
                    'label' => 'Archiver',
                    'help' => 'Archiver pour le consulter plus tard',
                ],
            )
            ->add(
                'name',
                TextType::class,
                [
                    'required' => false,
                    'label' => 'Nom',
                    'help' => 'Indiquez un nom pour votre archive',
                    'attr' => ['autocomplete' => 'off'],
                ],
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(
            [
                'data_class' => QrCode::class,
            ],
        );
    }
}