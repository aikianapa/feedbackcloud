<?php
class financesClass extends cmsFormsClass {


  function beforeItemShow(&$item) {
        if (isset($item["date"])) $item["date"] = date("d.m.Y",strtotime($item["date"]));
        if (isset($item["company"])) $item["company"] = $this->app->correlation("users",$item["company"],"name");
  }

}
?>
