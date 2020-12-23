<?php

class PlaystationStore
{
    protected static $storeUrl = 'https://store.playstation.com/chihiro-api/viewfinder/SA/en/999/';
    private $region;

    public function __construct($region = 'US')
    {
        $this->region = $region;
    }

    public function __get($name)
    {
        return new $name($this->getRegion());
    }

    public function search($query, $size)
    {
        $query = str_replace(' ', '_', $query);
        $query = urlencode($query);
        return $this->getDataFromUrl("https://store.playstation.com/store/api/chihiro/00_09_000/tumbler/SA/en/999/{$query}?suggested_size={$size}&mode=game");
    }

    protected function GetDataFromStoreAsObject($store, $start, $size, $type)
    {
        $contentType = ! $type ? null : "&game_content_type={$type}";
        $options = "?size={$size}&gkb=1&geoCountry={$this->getRegion()}&start={$start}$contentType";
        $gameObject = $this->getDataFromUrl(self::$storeUrl . $store . $options);

        if ($this->isGamesEmpty($gameObject))
            return [];
        return $gameObject->links;
    }

    public function getRegion()
    {
        return $this->region;
    }

    public function setRegion($region)
    {
        $this->region = $region;
    }

    protected function getDataFromUrl($path)
    {
        $dataRequest = file_get_contents($path);
        return json_decode($dataRequest);
    }

    protected function isGamesEmpty($object)
    {
        if (! isset($object->links) || empty($object->links))
            return true;
        return false;
    }
}