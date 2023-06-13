<?php

namespace Ssrc;

use Ssrc\CombineOne;
use Ssrc\Combinator;

class Api
{
  public function pizza($request)
  {
    // print_r($request);
    $new = new CombineOne();
    $newCom = new Combinator();
    $varArray = $new->dd();
    $arr = array();
    for ($i = 0; $i < strlen($request); $i++) {
      $arr[] = $request[$i];
    }
    $count_values = array_count_values($arr);
    foreach ($count_values as $key => $value) {
      if ($value > 1) {
        $newArray[$key] = $value - 1;
      }
    }
    if (!empty($newArray)) {
      foreach ($newArray as $dt => $zet) {
        $i = 0;
        while ($i < $zet) {
          $varArray = $newCom->combin($varArray, $dt);
          $i++;
        }
      }
    }
    return $this->normalize($varArray);
  }

  private function normalize($varArray)
  {
    $class = new DataBaseConnect();
    $connect = $class->bd();
    $stmt = $connect
    ->query('SELECT ingredient.*, ingredient_type.title as titleType FROM ingredient INNER JOIN ingredient_type ON ingredient.type_id = ingredient_type.id')
    ->fetchAll(\PDO::FETCH_UNIQUE);
    $newArray = array();
    foreach ($varArray as $item) {

      $product = array();
      $price = 0;
      foreach ($item as $key => $value) {
        $product[] = array('value' => $stmt[$value]['title'], 'type' => $stmt[$value]['titleType']);
        $price = $price + (int)$stmt[$value]['price'];
      }
      $newArray[] = array(
        'price' => $price,
        'product' => $product
      );
    }
    $resultArray = array(json_encode($newArray, JSON_UNESCAPED_UNICODE), count($newArray));
    return $resultArray;
  }
}
