<?php

namespace App\Utils;

use App\Entity\Kontratua;

class CheckImportedData
{
    public function isImportedDataFixed(Kontratua $kontratua): array
    {
        $resp = ['result'=>true];
        if ( !$kontratua->getArduraduna() ) {
            $resp['result'] = false;
            $resp['data'][] = "Arduraduna zehaztu gabe dago.";
        }
        if ( !$kontratua->getMota() ) {
            $resp['result'] = false;
            $resp['data'][] = "Mota zehaztu gabe dago.";
        }

        if ( !$kontratua->getEgoera() ) {
            $resp['result'] = false;
            $resp['data'][] = "Egoera zehaztu gabe dago.";
        }
        if ( !$kontratua->getProzedura() ) {
            $resp['result'] = false;
            $resp['data'][] = "Prozedura zehaztu gabe dago.";
        }
        if ( !$kontratua->getSaila() ) {
            $resp['result'] = false;
            $resp['data'][] = "Saila zehaztu gabe dago.";
        }

        foreach ($kontratua->getLotes() as $lote) {

            if ( !$lote->getName() ) {
                $resp['result'] = false;
                $resp['data'][] = "Lotearen izena zehaztu gabe dago.";
            }
            if ( !$lote->getSinadura() ) {
                $resp['result'] = false;
                $resp['data'][] = "Sinadura fetxa zehaztu gabe dago.";
            }
            if ( !$lote->getKontratista()){
                $resp['result'] = false;
                $resp['data'][] = "Kontratista zehaztu gabe dago.";
            }
            if ( !$lote->getIraupena()){
                $resp['result'] = false;
                $resp['data'][] = "Iraupena zehaztu gabe dago.";
            }
        }

        return $resp;
    }
}
