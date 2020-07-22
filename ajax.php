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

    public function checkcode() {
      $res = false;
      $code1 = intval($_SESSION["smscode"]);
      $code2 = intval($_POST["smscode"]);
      if ($code1 == $code2) $res = true;
      return json_encode(["result"=>$res]);
    }

    public function fetch() {
        include(__DIR__."/fetch.php");
        $fetch = new fetchApi($this->app);
    }
    
    public function reguser() {
        $app = $this->app;
        $phone = $app->digitsOnly($app->vars('_post.phone'));
        $res = $app->authGetContents("https://api.feedbackcloud.ru/query/users?phone={$phone}");
        $res = json_ecode($res,true);
        if (count($res)) return json_encode(['error'=>true,'msg'=>'user_exists']);
        
        
    }

}
?>
