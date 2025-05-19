<?php

namespace AcMarche\QrCode\Form;

use AcMarche\QrCode\Entity\QrCode;
use Endroid\QrCode\Label\LabelAlignment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QrCodeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
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
                'format',
                ChoiceType::class,
                [
                    'required' => true,
                    'label' => 'Format',
                    'choices' => ['SVG' => 'SVG', 'PNG' => 'PNG', 'EPS' => 'EPS'],
                ],
            )
            ->add(
                'color',
                ColorType::class,
                [
                    'required' => false,
                    'label' => 'Couleur',
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
                'style',
                ChoiceType::class,
                [
                    'required' => true,
                    'label' => 'Forme',
                    'choices' => ['square' => 'square', 'dot' => 'dot', 'round' => 'round'],
                ],
            )
            ->add(
                'marge',
                ChoiceType::class,
                [
                    'required' => true,
                    'label' => 'Marge',
                    'choices' => [
                        '0' => '0',
                        '1' => '1',
                        '3' => '3',
                        '7' => '7',
                        '9' => '9',
                    ],
                ],
            )
            ->add(
                'percentage',
                ChoiceType::class,
                [
                    'required' => true,
                    'label' => 'percentage',
                    'choices' => [
                        '.1' => 'S',
                        '.2' => 'M',
                        '.3' => 'L',
                        '.4' => 'XL',
                    ],
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
                    'label' => 'Votre logo',
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
                'addDefaultLogo',
                CheckboxType::class,
                [
                    'label' => 'Ajouter le logo de la Ville',
                    'required' => false,
                ],
            )
            ->add(
                'name',
                TextType::class,
                [
                    'required' => false,
                    'label' => 'Conserver',
                    'help' => 'Indiquez un nom pour archiver et récupérer le QrCode plus tard',
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