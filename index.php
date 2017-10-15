<?php
header('Content-Type: application/json');

require_once 'PlaystationStore/PlaystationStore.php';
require_once 'PlaystationStore/Games.php';
require_once 'PlaystationStore/PSPlus.php';

$playstationStore = new PlaystationStore();
$freeToPlay = $playstationStore->Games->freeToPlay();
$customData = [];

foreach ($freeToPlay as $item)
{
    $customData[] = [
        'name' => $item->name ,
        'data' => [
          'imageUrl' => $item->images[0]->url,
          'price' => $item->default_sku->display_price
      ]
    ];
}

echo json_encode($customData);