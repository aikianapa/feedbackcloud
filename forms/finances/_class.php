<?php
use Adbar\Dot;
class financesClass extends cmsFormsClass {
  function beforeItemShow(&$item) {
        if (isset($item["date"])) $item["date"] = date("d.m.Y",strtotime($item["date"]));
        if (isset($item["company"])) $item["inn"] = $this->app->correlation("users",$item["company"],"inn");
        if (isset($item["company"])) $item["company"] = $this->app->correlation("users",$item["company"],"name");
  }

  function afterItemSave(&$item) {
        $this->updateCompanyPayment($item);
        return $item;
  }

  function afterItemRemove($item) {
          $this->updateCompanyPayment($item, $mode = "remove");
  }

  function updateCompanyPayment($item, $mode = "update") {
        $company = $this->app->itemRead("users",$item["company"]);
        if (!isset($company["payments"]) OR !((array)$company["payments"] === $company["payments"])) $company["payments"] = [];
        $payment = [
            "id"   => $item["id"],
            "date" => $item["date"],
            "month" => $item["month"]
        ];
        $ids = array_column((array)$company["payments"],"id");
        $idx = array_search($item["id"],$ids);

        if ($idx === false)  {
            $company["payments"][] = $payment;
        } else {
            if ($mode == "remove") {
                unset($company["payments"][$idx]);
            } else {
                $company["payments"][$idx] = $payment;
            }
        }
        usort($company["payments"], function($a, $b) {
            // сортировка по дате
            return $a['date'] <=> $b['date'];
        });

        $trial = $this->app->vars('_sett.trial');
        $expired = date("Y-m-d H:i:s",strtotime("{$company['_created']} +{$trial} days"));
        foreach($company["payments"] as $pay) {
            $start = $pay['date'];
            if ($start < $expired) $start = $expired;
            $end = date("Y-m-d H:i:s",strtotime("{$start} +{$pay['month']} month"));
            if ($end > $expired) $expired = $end;
        }
        $company["expired"] = $expired;
        $this->app->itemSave("users",$company);
        return $item;
  }

}
?>
