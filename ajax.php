<?php
class wbAjax
{
    public function __construct(&$app)
    {
        header('Content-Type: charset=utf-8');
        header('Content-Type: application/json');
        $this->app = $app;
    }

    public function __call($mode, $params)
    {
        if (!is_callable(@$this->$mode)) {
            echo json_encode(null);
        } else {
            @$this->$mode();
        }
        die;
    }

    public function api_auth() {
        $app = $this->app;
        $user = $app->vars("_post");
        // сделать запрос на сервер для проверки юзера
        $user["role"] = "chatown";
        $_SESSION["user"] = $user;
        echo json_encode(["redirect"=>"/cabinet"]);
    }

    public function checkcode() {
      $res = false;
      $code1 = intval($_SESSION["smscode"]);
      $code2 = intval($_POST["smscode"]);
      if ($code1 == $code2) $res = true;
      return json_encode(["result"=>$res]);
    }
}
?>
