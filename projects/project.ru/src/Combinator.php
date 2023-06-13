<?php

namespace Ssrc;

use Ssrc\DataBaseConnect;

class Combinator
{
  public function combin($array, $i)
  {
    $class = new DataBaseConnect();
    $connect = $class->bd();
    $stmt = $connect
      ->query("SELECT * FROM ingredient
      WHERE type_id IN
        (SELECT ingredient_type.id FROM ingredient_type
        WHERE ingredient_type.code=\"$i\" )")
      ->fetchAll();

    $newArray = array();
    foreach ($stmt as $key => $value) {
      foreach ($array as $ter) {
        if (!in_array($value['id'], $ter)) {
          array_push($ter, $value['id']);
          $newArray[] = $ter;
        }
      }
    }
    return $newArray;
  }
}
