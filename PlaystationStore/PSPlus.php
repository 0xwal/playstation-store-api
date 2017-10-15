<?php
class PSPlus extends PlaystationStore
{
    public function __construct($region = 'US')
    {
        parent::__construct($region);
    }
    public function monthlyGames($start = 0, $size = 30)
    {
        $data = $this->GetDataFromStoreAsObject('STORE-MSF75508-PLUSINSTANTGAME', $start, $size, null);
        $dataAsArray = (array)$data;

        $filtered = array_filter($dataAsArray, function ($key){
            return strpos($key->name, 'PlayStation') === false;
        });
        return $filtered;
    }
    public function themes($start = 0, $size = 30)
    {
        return $this->GetDataFromStoreAsObject('STORE-MSF75508-PLUSTHEMESAVATAR', $start, $size, 'themes');
    }
    public function avatars($start = 0, $size = 30)
    {
        return $this->GetDataFromStoreAsObject('STORE-MSF75508-PLUSTHEMESAVATAR', $start, $size, 'avatars');
    }
    public function indieGames($start = 0, $size = 30)
    {
        return $this->GetDataFromStoreAsObject('STORE-MSF75508-INDIEGAMES', $start, $size, null);
    }
}