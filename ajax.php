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
        $res = true;
        $app = $this->app;
        $code1 = intval($app->vars('_sess.phone'));
        $code2 = intval($app->vars('_post.smscode'));
        if ($code1 == $code2) $res = false;
        return json_encode(["error"=>$res]);
    }

    public function fetch() {
        include(__DIR__."/fetch.php");
        $fetch = new fetchApi($this->app);
    }
    
    public function getcode() {
        $app = $this->app;
        $phone = $app->digitsOnly($app->vars('_post.phone'));
        $res = $app->authPostContents($app->route->host."/module/twilio/sms?phone=+{$phone}");
        return $res;
        
        
        $res = json_decode($res);
        return json_encode(['error'=>$res->error]);
    }
    
    public function reguser() {
        $app = $this->app;
        $phone = $app->digitsOnly($app->vars('_post.phone'));
        $res = $app->authGetContents("https://api.feedbackcloud.ru/query/users?phone={$phone}");
        $res = json_decode($res,true);
        if (count($res)) return json_encode(['error'=>true,'msg'=>'user_exists']);
        if ($app->vars('_post.smscode')  !==  $app->vars('_sess.smscode')) {
            return json_encode(['error'=>true,'msg'=>'invalid_code']);
        }
        unset($_POST['smscode']);
        unset($_POST['password_check']);
        $user = $app->vars('_post');
        $user['role'] = 'chatown';
        $user['password'] = $app->passwordMake($user['password']);
        $user['first_name'] = $user['name'];
        $app->itemSave('users',$user);
        return json_encode(['error'=>false]);
    }

}
?>
