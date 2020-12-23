<?php

class Games extends PlaystationStore
{

    public function freeToPlay($start = 0, $size = 30)
    {
        return $this->GetDataFromStoreAsObject('STORE-MSF75508-FREETOPLAYSEEALL', $start, $size, 'games');
    }

    public function onlyOnPlaystation($start = 0, $size = 30)
    {
        return $this->GetDataFromStoreAsObject('STORE-MSF75508-ONLYONPSTIONPS4', $start, $size, 'games');
    }

    public function priceDrop($start, $size)
    {
        return $this->GetDataFromStoreAsObject('STORE-MSF75508-PRICEDROPSCHI', $start, $size, 'games,bundles,addons');
    }

    public function newRelease($start = 0, $size = 30)
    {
        return $this->GetDataFromStoreAsObject('STORE-MSF75508-COMINGSOON', $start, $size, 'bundles');
    }

    public function digitalZone($start = 0, $size = 30)
    {
        return $this->GetDataFromStoreAsObject('STORE-MSF75508-DIGITALZONE', $start, $size, null);
    }
}