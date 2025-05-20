<?php

namespace AcMarche\QrCode\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class QrBtcType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'bankAccount',
                TextType::class,
                [
                    'required' => true,
                    'label' => 'Numéro de téléphone',
                    'help' => 'Format:',
                    'attr' => ['autocomplete' => 'off'],
                ],
            )
            ->add(
                'amount',
                MoneyType::class,
                [
                    'required' => false,
                    'label' => 'Montant',
                    'help' => 'Non requis',
                    'attr' => ['autocomplete' => 'off'],
                ],
            )
            ->add(
                'address',
                TextType::class,
                [
                    'required' => false,
                    'label' => 'A l\'attention de',
                    'help' => 'Destinataire',
                    'attr' => ['autocomplete' => 'off'],
                ],
            )
            ->add(
                'subject',
                TextType::class,
                [
                    'required' => false,
                    'label' => 'Communication',
                    'help' => 'Structurée ou non',
                    'attr' => ['autocomplete' => 'off'],
                ],
            );
    }

    public function getParent(): string
    {
        return QrCodeType::class;
    }
}