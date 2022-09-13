<?php

namespace App\Services;
use Endroid\QrCode\Builder\BuilderInterface;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Label\Alignment\LabelAlignmentCenter;
use Endroid\QrCode\Label\Margin\Margin;

class QrcodeService
{
    /**
     * @var BuilderInterface
     */
  protected BuilderInterface $builder;
    public function __construct(BuilderInterface $builder)
    {
        $this->builder = $builder;

    }

    public function qrcode($query): string
    {
        $objDateTime = new \DateTime('NOW');
        $dateString = $objDateTime->format('d-m-Y H:i:s');

       $path = dirname(__DIR__, 2).'/public/assets/';
        //setQrCode
        $result =$this->builder->data($query)
            ->encoding(new Encoding('UTF-8'))
            ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
            ->size(400)
            ->margin(10)
            ->labelText($dateString)
            ->labelAlignment(new LabelAlignmentCenter())
            ->labelMargin(new Margin(15, 5, 5, 5))
            ->logoPath($path.'img/logo.png')
            ->logoResizeToWidth('100')
            ->logoResizeToHeight('100')
            ->backgroundColor(new Color(221, 158, 3))
            ->build();
        //generate name
     //   $namePng = uniqid('', '') . '.png';
        //Save image QrCode
   //     $result->saveToFile(($path.'qr-code/'.$namePng));
        return $result->getDataUri();

    }

}