<?php

class PlaystationStore
{
    private $endPoint;

    public function __construct($region = 'US', $language = 'en')
    {
        $this->endPoint = $this->createEndpoint($region, $language);
    }

    private function createEndpoint($region, $language)
    {
        return sprintf('https://store.playstation.com/chihiro-api/viewfinder/%s/%s/999/', $region, $language);
    }

    public function search($query, $size)
    {
        $query = str_replace(' ', '_', $query);
        $query = urlencode($query);
        return $this->getDataFromUrl("https://store.playstation.com/store/api/chihiro/00_09_000/tumbler/SA/en/999/{$query}?suggested_size={$size}&mode=game");
    }

    protected function getDataFromUrl($path)
    {
        $dataRequest = file_get_contents($path);
        return json_decode($dataRequest);
    }

    protected function GetDataFromStoreAsObject($store, $start, $size, $type)
    {
        $contentType = ! $type ? null : "&game_content_type={$type}";
        //geoCountry=US&
        $options = "?size={$size}&gkb=1&start={$start}$contentType";
        $gameObject = $this->getDataFromUrl($this->endPoint . $store . $options);

        if ($this->isGamesEmpty($gameObject))
            return [];

        return $gameObject->links;
    }

    protected function isGamesEmpty($object)
    {
        if (! isset($object->links) || empty($object->links))
            return true;
        return false;
    }
}