<?php
use Adbar\Dot;
class chatsClass extends cmsFormsClass {



  public function _rep_rating_company($dom) {
      $list = wbItemList("chats",$dom->options);
      return $list["list"];
  }

  public function beforeItemEdit(&$item) {
    $this->beforeItemShow($item);
  }

  public function beforeItemShow(&$item) {
      $item["show"] = [];
      $item["show"]["countmsg"] = count($item["msg"]);
      $item["show"]["place"] = wbCorrelation("places",$item["place"],"name");
      $item["show"]["date"] = date("d.m.Y",strtotime($item["_created"]));
  }

}
