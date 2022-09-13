<?php

namespace App\Controller;

use App\Form\SearchType;
use App\Services\QrcodeService;
use JeroenDesloovere\VCard\VCard;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/",name="index")
     * @param Request $request
     * @param QrcodeService $qrcodeService
     * @return Response
     *
     */
public  function index(Request $request,QrcodeService $qrcodeService):Response{

    $form = $this->createForm(SearchType::class, null);
    $form->handleRequest($request);

    $vcard = new VCard();
    $vcard->addName("alaeldin Musa", "suliman");
    $vcard->addCompany("sudan");
    $vcard->addJobtitle("Developer");
    $vcard->addPhoneNumber(123314445588, 'PREF;WORK');
    $vcard->addEmail("alaeldin91@gmail.com");
    $vcard->addPhoneNumber(12334, 'WORK');
    $response = new Response($vcard->getOutput());
    $qrCode = $qrcodeService->qrcode($response->getContent());
    return $this->render('default/index.html.twig', [
        'form' => $form->createView(),
          'qrCode' => $qrCode,
    ]);

}

}