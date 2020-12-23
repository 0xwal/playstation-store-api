<?php

//require_once 'PlaystationStore/PlaystationStore.php';
//require_once 'PlaystationStore/Games.php';
//require_once 'PlaystationStore/PSPlus.php';

require_once 'vendor/autoload.php';

$playstationStore = new PlaystationStore('US');
$freeToPlay = $playstationStore->Games->freeToPlay();
$customData = [];

foreach ($freeToPlay as $item)
{
    $customData[] = (object)[
        'name' => $item->name,
        'data' => (object)[
          'imageUrl' => $item->images[0]->url,
          'price' => $item->default_sku->display_price
      ]
    ];
}

//echo json_encode($customData);
foreach ($customData as $item) {
    echo "Game Name: {$item->name}";
    echo "<br />";
    echo "Price: {$item->data->price}";
    echo "<br/>";
    echo "<img src={$item->data->imageUrl} />";
    echo "<hr />";
}