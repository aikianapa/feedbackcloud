<?php
class usersClass extends cmsFormsClass
{
    public function beforeItemShow(&$item)
    {
        if (!isset($item["name"]) or $item["name"] == "") {
            if (isset($item["first_name"])) $item["name"] = $item["first_name"];
        }
        $item["trial"] = "";
        if (!isset($item["payments"]) OR count($item["payments"]) == 0) {
            if (isset($item["_created"])) {
                $item["trial"] = intval((strtotime($item["_created"]." +".$this->app->vars("_env.settings.trial")." days") - strtotime("today")) / (3600*24)) ;              
            }
        }
        if (isset($item["phone"]) and $item["phone"] > "") {
            $item["phone"] = wbPhoneFormat($item["phone"]);
        }
    }
    
    function beforeItemSave(&$item) {
        if (isset($item['phone'])) {
            $item['phone'] = preg_replace("/\D/", '', $item['phone']);
        }
    }

}
