<?php
use Adbar\Dot;
class chatsClass extends cmsFormsClass {



  public function _rep_rating_company($dom) {
      $list = wbItemList("chats",$dom->options);
      return $list["list"];
  }

  public function beforeItemShow(&$item) {
      $tem["_show"] = [];
      $item["show"]["countmsg"] = count($item["msg"]);
      $item["show"]["place"] = wbCorrelation("places",$item["place"],"name");
      $item["show"]["date"] = date("d.m.Y",strtotime($item["_created"]));
  }

}
