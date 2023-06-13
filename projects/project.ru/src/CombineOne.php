<?php
namespace Ssrc;
use Ssrc\DataBaseConnect;

class CombineOne
{
  public function dd()
  {
    $class = new DataBaseConnect();
    $connect = $class->bd();
    $dopIndeg = $connect->query('SELECT * FROM ingredient WHERE type_id=1')
    ->fetchAll();

    $stmt = $connect->query('SELECT * FROM ingredient WHERE type_id!=1')
    ->fetchAll();

    $array = array();
    foreach ($stmt as $key => $item) {
      $array[$item['type_id']][$key] = $item;
    }
    $count = 0;
    foreach ($array as $el => $item) {
      if (count($item) > $count) {
        $count = $el;
      }
    }
    $ad = array();

    foreach($array[$count] as $item) {
      foreach($array as $el => $let){
        foreach($let as $deg){
          if($el != $count){
            $data = array(
              $item['id'],
              $deg['id']
            );
            $ad[] = $data;
          }
        }
      }
    }
    $newArray = array();
    foreach($dopIndeg as $key => $value){
      foreach($ad as $ter){
        array_push($ter, $value['id']);
        $newArray[] = $ter;
      }
    }
    return $newArray;
  }
}
