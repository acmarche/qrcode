<?php

namespace AcMarche\QrCode\Controller;

use AcMarche\QrCode\Entity\QrCode;
use AcMarche\QrCode\Form\QrCodeType;
use AcMarche\QrCode\QrCodeGenerator;
use AcMarche\QrCode\Repository\QrCodeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route(path: '/qrcode')]
#[IsGranted('ROLE_USER')]
class DefaultController extends AbstractController
{
    public function __construct(
        private readonly QrCodeRepository $qrCodeRepository,
        private readonly QrCodeGenerator $qrCodeGenerator,
    ) {}

    #[Route(path: '/', name: 'qrcode_home')]
    public function index(): Response
    {
        $user = $this->getUser();
        $codes = $this->qrCodeRepository->findByUser($user->getUserIdentifier());

        return $this->render(
            '@AcMarcheQrCode/default/index.html.twig',
            [
                'codes' => $codes,
            ],
        );
    }

    #[Route(path: '/new/{uuid}', name: 'qrcode_new')]
    public function new(Request $request, ?string $uuid = null): Response
    {
        if ($uuid) {
            if (!$qrCode = $this->qrCodeRepository->findByUuid($uuid)) {
                $qrCode = new QrCode();
            }
        } else {
            $qrCode = new QrCode();
        }

        $form = $this
            ->createForm(QrCodeType::class, $qrCode);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /* @var QrCode $data */
            $data = $form->getData();
            try {
                $result = $this->qrCodeGenerator->generate($data);

                $this->qrCodeGenerator->saveToFile($result, $qrCode);

                if ($data->persistInDatabase) {
                    $user = $this->getUser();
                    if ($user) {
                        $qrCode->username = $user->getUserIdentifier();
                    }
                    if (!$qrCode->id) {
                        $this->qrCodeRepository->persist($qrCode);
                    }
                    $this->qrCodeRepository->flush();

                    return $this->redirectToRoute('qrcode_new', ['uuid' => $qrCode->uuid]);
                }
            } catch (\Exception $e) {
                $this->addFlash('danger', $e->getMessage());
            }
        }

        return $this->render(
            '@AcMarcheQrCode/default/new.html.twig',
            [
                'form' => $form,
                'filePath' => $qrCode->filePath,
            ],
        );
    }

    #[Route(path: '/show/{uuid}', name: 'qrcode_show')]
    public function show(QrCode $qrCode): Response
    {
        return $this->render(
            '@AcMarcheQrCode/default/show.html.twig',
            [
                'qrcode' => $qrCode,
                'filePath' => $qrCode->filePath,
            ],
        );
    }
}