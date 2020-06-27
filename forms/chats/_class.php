<?php
use Adbar\Dot;
class chatsClass extends cmsFormsClass {



  public function _rep_rating_company($dom) {
      $list = wbItemList("chats",$dom->options);
      return $list["list"];
  }


}
