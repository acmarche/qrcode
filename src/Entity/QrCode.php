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

    #[ORM\Column(type: 'binary', nullable: true)]
    public ?UploadedFile $dataFile = null;

    #[ORM\Column(length: 10, nullable: false)]
    public string $color = '#000000';

    #[ORM\Column(length: 10, nullable: false)]
    public string $colorBackground = '#FFFFFF';

    #[ORM\Column(type: 'smallint', nullable: false)]
    public int $size = 1200;

    #[ORM\Column(type: 'smallint', nullable: false)]
    public $margin = 10;

    #[ORM\Column(length: 150, nullable: true)]
    public ?string $labelText = null;

    #[ORM\Column(length: 10, nullable: false)]
    public string $labelColor = '#000000';

    #[ORM\Column(type: 'smallint', nullable: false)]
    public int $labelSize = 32;

    #[ORM\Column(length: 50, nullable: true, enumType: LabelAlignment::class)]
    public LabelAlignment $labelAlignment = LabelAlignment::Center;

    public ?UploadedFile $logo = null;

    #[ORM\Column(length: 150, nullable: true)]
    public ?string $logoPath = null;

    #[ORM\Column(type: 'smallint', nullable: false)]
    public int $logoSize = 200;

    #[ORM\Column(length: 50, nullable: true)]
    public bool $logoPunchoutBackground = false;

    #[ORM\Column(length: 50, nullable: true)]
    public ?string $username = null;

    #[ORM\Column(length: 150, nullable: true)]
    public ?string $name = null;

    #[ORM\Column(length: 150, nullable: false)]
    public ?string $filePath = null;

    public bool $addDefaultLogo = false;
    public bool $persistInDatabase = false;

    public function __construct()
    {
        $this->uuid = $this->generateUuid();
    }

}
