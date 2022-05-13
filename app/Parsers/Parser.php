<?php

namespace App\Parsers;

use App\Parsers\Opensea\Rankings;
use Illuminate\Support\Facades\Storage;

class Parser
{
  public function parse(string $resource = '', int $count = 1)
  {
    $result = [];

    switch ($resource) {
      case 'opensea':
        
        $rankings = new Rankings();
        $collection = $rankings->get($count);

        foreach ($collection as $key => $item) {

          $preview = file_get_contents($item['logo']);
          $preview_name = sha1($preview . time()) . '.png';
          $preview_path = '/images/MarketActivity/preview/' . $preview_name;
          Storage::disk('public')->put($preview_path, $preview);

          $icon_coin = file_get_contents($item['nativePaymentAsset']['asset']['imageUrl']);
          $icon_coin_name = sha1($icon_coin . time()) . '.svg';
          $icon_coin_path = '/images/MarketActivity/icons_coin/' . $icon_coin_name;
          Storage::disk('public')->put($icon_coin_path, $icon_coin);

          $volume = 0;
          if (array_key_exists('totalVolume', $item['statsV2'])) {
            if (is_array($item['statsV2']['totalVolume'])) {
              $volume = floatval($item['statsV2']['totalVolume']['unit']);
            }
          }

          $floor_price = 0;
          if (array_key_exists('floorPrice', $item['statsV2'])) {
            if (is_array($item['statsV2']['floorPrice'])) {
              $floor_price = floatval($item['statsV2']['floorPrice']['unit']);
            }
          }

          $shift = (array_key_exists('oneDayChange', $item['statsV2'])) ? floatval($item['statsV2']['oneDayChange']) : 0;

          $result[] = [
            'icon_coin' => $icon_coin_name,
            'preview' => $preview_name,
            'name' => strval($item['name']),
            'volume' => round($volume, 2),
            'floor_price' => round($floor_price, 2),
            'shift' => round($shift * 100, 2),
          ];
        }

        break;
    }

    return $result;
  }
}