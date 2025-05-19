<?php

namespace AcMarche\QrCode\Entity;

use AcMarche\QrCode\Repository\QrCodeRepository;
use Doctrine\ORM\Mapping as ORM;
use Endroid\QrCode\Label\LabelAlignment;
use Knp\DoctrineBehaviors\Contract\Entity\TimestampableInterface;
use Knp\DoctrineBehaviors\Model\Timestampable\TimestampableTrait;
use Symfony\Component\HttpFoundation\File\UploadedFile;

#[ORM\Table(name: 'qrcode')]
#[ORM\Entity(repositoryClass: QrCodeRepository::class)]
class QrCode implements TimestampableInterface
{
    use UuidTrait, TimestampableTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    public ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    public ?string $url = null;

    #[ORM\Column(length: 30, nullable: false)]
    public string $type = 'url';

    #[ORM\Column(length: 10, nullable: false)]
    public string $color = '#000000';

    #[ORM\Column(length: 10, nullable: false)]
    public string $colorBackground = '#FFFFFF';

    #[ORM\Column(type: 'smallint', nullable: false)]
    public int $size = 1200;

    #[ORM\Column(length: 10, nullable: false)]
    public string $format = 'SVG';

    #[ORM\Column(length: 10, nullable: false)]
    public string $style = 'square';

    #[ORM\Column(type: 'smallint', nullable: false)]
    public $margin = 10;

    #[ORM\Column(length: 150, nullable: true)]
    public ?string $labelText = null;

    #[ORM\Column(length: 10, nullable: true)]
    public string $labelColor = '#000000';

    #[ORM\Column(type: 'smallint', nullable: true)]
    public int $labelSize = 32;

    #[ORM\Column(length: 50, nullable: true, enumType: LabelAlignment::class)]
    public LabelAlignment $labelAlignment = LabelAlignment::Center;

    public ?UploadedFile $logo = null;

    #[ORM\Column(length: 150, nullable: true)]
    public ?string $logoPath = null;

    #[ORM\Column(type: 'smallint', nullable: true)]
    public int $logoSize = 200;

    #[ORM\Column(length: 50, nullable: true)]
    public bool $logoPunchoutBackground = false;

    #[ORM\Column(length: 50, nullable: false)]
    public ?string $username = null;

    #[ORM\Column(length: 150, nullable: false)]
    public ?string $name = null;

    #[ORM\Column(length: 150, nullable: true)]
    public ?string $filePath = null;

    #[ORM\Column(length: 150, nullable: true)]
    public ?string $message = null;
    #[ORM\Column(length: 150, nullable: true)]
    public ?string $amount = null;
    #[ORM\Column(length: 150, nullable: true)]
    public ?string $email = null;
    #[ORM\Column(length: 150, nullable: true)]
    public ?string $phoneNumber = null;
    #[ORM\Column(length: 150, nullable: true)]
    public ?string $bankAccount = null;
    #[ORM\Column(length: 150, nullable: true)]
    public ?string $for = null;
    #[ORM\Column(length: 150, nullable: true)]
    public ?string $subject = null;
    #[ORM\Column(length: 150, nullable: true)]
    public ?string $latitude = null;
    #[ORM\Column(length: 150, nullable: true)]
    public ?string $longitude = null;
    #[ORM\Column(length: 150, nullable: true)]
    public ?string $ssid = null;
    #[ORM\Column(length: 150, nullable: true)]
    public ?string $password = null;
    #[ORM\Column(length: 150, nullable: true)]
    public ?string $encryption = null;
    #[ORM\Column(nullable: true)]
    public bool|null $isHidden = false;

    public string $percentage = '0';
    public int $marge = 0;
    public bool $addDefaultLogo = false;

    public function __construct()
    {
        $this->uuid = $this->generateUuid();
    }

}
