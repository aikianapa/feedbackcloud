<?php
function qrscan__init(&$obj) {
    if (is_a($obj,"wbdom")) {
      $dom = &$obj;
      $out = $dom->app->fromFile(__DIR__ ."/qrscan_ui.php");
      $out->data = $dom->data;
      $out->data["_base"] = $_ENV["modules"]["qrscan"]["dir"]."/";
      $out->fetch();
      $dom->find("head")->append($out->find("head")->html());
      if ($dom->is("input")) {
          $dom->replace($out);
      }
    } else {
      $app = &$obj;
      $out = $app->fromFile(__DIR__ ."/qrscan_ui.php");
      $out->data = [];
      $out->data["_base"] = $_ENV["modules"]["qrscan"]["dir"]."/";
      $out->fetch();
      echo $out;
      die;
    }


}

?>
