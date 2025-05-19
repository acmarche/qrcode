<?php

namespace AcMarche\QrCode;

use AcMarche\QrCode\Entity\QrCode;
use AcMarche\QrCode\Form\QrBtcType;
use AcMarche\QrCode\Form\QrEmailType;
use AcMarche\QrCode\Form\QrGeoType;
use AcMarche\QrCode\Form\QrPhoneNumberType;
use AcMarche\QrCode\Form\QrSmsType;
use AcMarche\QrCode\Form\QrUrlType;
use AcMarche\QrCode\Form\QrWifiType;
use LaraZeus\QrCode\DataTypes\BTC;
use LaraZeus\QrCode\DataTypes\Email;
use LaraZeus\QrCode\DataTypes\Geo;
use LaraZeus\QrCode\DataTypes\PhoneNumber;
use LaraZeus\QrCode\DataTypes\SMS;
use LaraZeus\QrCode\DataTypes\WiFi;
use LaraZeus\QrCode\Generator;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormFactoryInterface;

 class QrBuilder
{
    private string $logoPath;
    public array $corrections  =  ['L' => '7%',
                                    'M' => '15%',
                                    'Q' => '25%',
                                    'H' => '30%',];

    public function __construct(
        private FormFactoryInterface $formBuilder,
        #[Autowire('%kernel.project_dir%')] private string $projectDir,
        #[Autowire(env: 'QRCODE_DIR')] private string $qrCodeDir,
    ) {
        $this->logoPath = $this->projectDir.'/public/images/Marche_logo.png';
    }

    public function buildForm(string $type, QrCode $qrCode): Form
    {
        return match ($type) {
            'sms' => $this->formBuilder->create(QrSmsType::class, $qrCode),
            'phoneNumber' => $this->formBuilder->create(QrPhoneNumberType::class, $qrCode),
            'geo' => $this->formBuilder->create(QrGeoType::class, $qrCode),
            'wifi' => $this->formBuilder->create(QrWifiType::class, $qrCode),
            'email' => $this->formBuilder->create(QrEmailType::class, $qrCode),
            'btc' => $this->formBuilder->create(QrBtcType::class, $qrCode),
            default => $this->formBuilder->create(QrUrlType::class, $qrCode),
        };

    }

    public function generate(string $type, array $data): Email|Generator|BTC|WiFi|SMS|Geo|PhoneNumber
    {
        $qr = match ($type) {
            'sms' => new SMS(),
            'phone' => new PhoneNumber(),
            'geo' => new Geo(),
            'wifi' => new Wifi(),
            'email' => new Email(),
            'btc' => new BTC(),
            default => new Generator(),
        };

        $qr->create($data);

        return $qr;
    }

    public static function getDefaultOptions(array $options = []): array
    {
        return array_merge([
            'size' => '300',
            'type' => 'png',
            'margin' => '1',
            'color' => 'rgba(74, 74, 74, 1)',
            'back_color' => 'rgba(252, 252, 252, 1)',
            'style' => 'square',
            'hasGradient' => false,
            'gradient_form' => 'rgb(69, 179, 157)',
            'gradient_to' => 'rgb(241, 148, 138)',
            'gradient_type' => 'vertical',
            'hasEyeColor' => false,
            'eye_color_inner' => 'rgb(241, 148, 138)',
            'eye_color_outer' => 'rgb(69, 179, 157)',
            'eye_style' => 'square',
            'correction' => 'H',
            'percentage' => '.2',
            'uploadOptions' => [
                'disk' => 'public',
                'directory' => null,
            ],
        ], $options);
    }
}