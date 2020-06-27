<?php
class fetchApi {
      function __construct(&$app) {
          header('Content-Type: charset=utf-8');
          header('Content-Type: application/json');
          $this->app = $app;
          if (isset($app->route->call) AND method_exists($this,$app->route->call)) {
              $call = $app->route->call;
              echo $this->$call();
              die;
          }
          echo $this->_error();
          die;
      }

      function rating() {
          $app = $this->app;
          if (isset($app->route->params->owner)) {
              // вычисление рейтинга по пользователю
              $oid = $app->route->params->owner;
              $owner = $app->db->itemRead("users",$oid);
              if (!$owner) $this->_error("Owner not found");
              $chats = $app->db->itemList("chats",[
                  "filter" => [
                      "active" => "off",
                      "manager_id" => $oid
                  ],
                  "return" => "_id, initial_rating, rating"
              ]);
              $count = $chats["count"];
              $chats = $chats["list"];
              $rFinish =  ceil(array_sum(array_column($chats, 'rating')) / $count);

              $owner["rating_start"] = ceil(array_sum(array_column($chats, 'initial_rating')) / $count);
              $owner["rating_finish"] = ceil(array_sum(array_column($chats, 'rating')) / $count);
              $res = $app->db->itemSave("places",$owner);
              if ($res) {
                  $result = [
                      "manager_id" => $oid,
                      "rating_start" => $owner["rating_start"],
                      "rating_finish" => $owner["rating_finish"],
                  ];
                  echo json_encode($result);
                  die;
              }
          } elseif (isset($app->route->params->place)) {
              // вычисление рейтинга по месту
              $pid = $app->route->params->place;
              $place = $app->db->itemRead("places",$pid);
              if (!$place) $this->_error("Place not found");
              $chats = $app->db->itemList("chats",[
                  "filter" => [
                      "active" => "off",
                      "place" => $pid
                  ],
                  "return" => "_id, initial_rating, rating"
              ]);
              $count = $chats["count"];
              $chats = $chats["list"];
              $rFinish =  ceil(array_sum(array_column($chats, 'rating')) / $count);

              $place["rating_start"] = ceil(array_sum(array_column($chats, 'initial_rating')) / $count);
              $place["rating_finish"] = ceil(array_sum(array_column($chats, 'rating')) / $count);
              $res = $app->db->itemSave("places",$place);

              if ($res) {
                  $result = [
                      "place_id" => $pid,
                      "rating_start" => $place["rating_start"],
                      "rating_finish" => $place["rating_finish"],
                  ];
                  echo json_encode($result);
                  die;
              }
          }
      }


      function _error($msg = null) {
          $error = ["error"=>true];
          if ($msg !== null) $error["msg"] = $msg;
          echo json_encode($error);
          die;
      }
}
?>
