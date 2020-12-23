<?php

//require_once 'PlaystationStore/PlaystationStore.php';
//require_once 'PlaystationStore/Games.php';
//require_once 'PlaystationStore/PSPlus.php';

require_once 'vendor/autoload.php';

$monthlyGames = (new PSPlus('gb', 'en'))->monthlyGames();
$freeToPlay = (new Games('gb', 'en'))->freeToPlay();
$games = array_merge($monthlyGames, $freeToPlay);
$customData = [];

foreach ($games as $item)
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
    echo "<img width='64' height='64' src={$item->data->imageUrl} />";
    echo "<hr />";
}