<?php
wbRouterAdd("/chat/(:any)/(:any)","/controller:form/form:chat/mode:owner/place_id:$1/item:$2");
//wbRouterAdd("/chat/owner/(:any)/(:any)","/controller:form/form:chat/mode:owner");
wbRouterAdd("/chat/(:any)","/controller:form/form:chat/mode:view/item:$1");
wbRouterAdd("/chat","/controller:form/form:chat/mode:view/item:common");
wbRouterAdd("/qr","/controller:module/mode:qrscan");

function chatAfterItemRead($Item) {
  $place = wbitemRead("places",$Item["place"]);
  $Item["owner"] = $place["_creator"];
  return $Item;
}

function chat_owner($app) {
    $Item = _chatRead($app->vars("_route.item"));
    if (!$Item) return wbPage404()->fetch();
    $_ENV["chat_base"] = "/tpl/chat/";
    return $app->getTpl("chat.inc.php")->fetch();
}

function chat_view($app) {
    $_ENV["chat_base"] = "/modules/cabinet/tpl/";
    return $app->fromFile($_ENV["path_app"]."/modules/cabinet/tpl/cabinet_user.php")->fetch();
}

function ajax_chat() {
    $app = _chatCreate();
    $mode = $app->vars("_route.params.0");
    $call = "chat{$mode}";
    if (is_callable($call)) return @$call($app);
}

function chatListChats($app) {
  // получаем список чатов в указанном месте
  $user = _chatCheckUser();
  $place = $app->itemRead("places",$app->vars("_post.chat"));
  if ($place["_creator"] !== $user) return false;
  $list = $app->itemList("chat",'active = "on" AND place = "'.$place["id"].'"');
  foreach($list as &$item) {
      $item = [
        "token" => $item["token"]
        ,"chat_id" => $item["chat_id"]
        ,"place" => $item["place"]
        ,"client_name" => $item["client_name"]
        ,"client_avatar" => $item["client_avatar"]
      ];
  }
  return json_encode($list);
}

function chatGet($app) {
  $user = _chatCheckUser();
  $chat = _chatRead($app->chat_id);
  $place_id = $app->vars("_post.chat");
  if (isset($chat["place"])) $place_id = $chat["place"];
  $place = $app->itemRead("places",$place_id);
  $owner = $app->itemRead("users",$place["_creator"]);
  if (!$place) return;

  
//  $last = intval($app->vars("_post.last"));
	if ($chat AND $owner["id"] !== $user) {
		if ($chat["client_name"] !== $app->vars("_post.name")) $chat["client_name"] = $app->vars("_post.name");
		if ($chat["client_avatar"] !== $app->vars("_post.avatar")) $chat["client_avatar"] = $app->vars("_post.avatar");
		$app->itemSave("chat",$chat,true);
	}
	
	if (!$chat) $chat = $app->chat;
  if (!$user AND $app->vars("_env.user.role") !== "chatown") {
		$msg = [];
  } else {
		$msg = $chat["msg"];
  }
  if ($last > 0 ) $msg = array_slice($msg, $last);
  $data = [
		"place_id"=>$place["id"],
		"place_name"=>$place["header"],
		"chat_start"=>$chat["_created"],
		"owner_id"=>md5($place["_creator"]),
		"owner_name"=>$owner["first_name"]." ".$owner["last_name"],
		"owner_avatar"=>"",
		"client_name"=>$chat["client_name"],
		"client_avatar"=>$chat["client_avatar"],
		"msg"=> $msg,
		"token"=> $app->token
    ];
    if (@is_file($app->vars("_env.path_app")."/uploads/users/{$owner['id']}/{$owner['avatar'][0]['img']}")) {
		$data["owner_avatar"] = "/thumb/60x60/src/uploads/users/{$owner['id']}/{$owner['avatar'][0]['img']}";
	}
    echo json_encode($data);
    die;
}

function chatMsg($app) {
  $user = _chatCheckUser();
  if (!$user) return;
  $chat = $app->chat_id;
  $post = $app->vars("_post.data");
  $post["id"] = wbNewId();
  $post["user"] = $user;
  $post["date"] = date("Y-m-d H:i:s");
  $post["text"] = htmlspecialchars($post["text"]);
  $data = _chatRead($chat);
  if (!$data) $data = $app->chat;
  $data["msg"][$post["id"]] = $post;
  $app->itemSave("chat",$data,true);
  return json_encode($post);

}

function _chatCreate() { // _ чтобы нельзя было вызвать из $mode
  // если в куках нет id юзера, создаём
  // далее будем проверять наличие id, если его нет, то запрос невалиден
  $app = &$_ENV["app"];
  $user = $app->itemRead("users",$app->vars("_post.user"));
  if ($user["role"] == "chatown") {
	if ($app->vars("_post.key") AND $app->vars("_post.key") > "") {
		$app->chat_id = $app->vars("_post.key");
	} else if (isset($_SERVER["HTTP_REFERER"])) {
		$ref = trim(str_replace("/"," ",$_SERVER["HTTP_REFERER"]));
		$ref = explode(" ",$ref);
		$app->chat_id = end($ref);
	}
    return $app; // владелец места не может создать чат, входит по ID чата
  }
  if (!$app->vars("_cook.user")) {
      if ($app->vars("_post.user")) {
          $token = chatToken($app->vars("_post.user"));
      } else {
          $token = chatToken();
      }
  } else {
      $token = chatToken($app->vars("_cook.user"));
  }
  $app->chat_id = md5($token);
  $chat = _chatRead($app->chat_id);
  if (!$chat) {
      $chat = [
		   "id" => $app->newId()
          ,"chat_id" => $app->chat_id
          ,"token" => $token
          ,"place" => $app->place_id
          ,"active" => "on"
          ,"_creator" => $app->vars("_post.user")
          ,"msg" => []
      ];
  }
  $app->chat = $chat;
  return $app;
}

function chatToken($user_id = null) {
  $app = &$_ENV["app"];

  if (!$user_id AND $app->vars("_cook.user")) $user_id = $app->vars("_cook.user");
  if (!$user_id AND $app->vars("_post.user")) $user_id = $app->vars("_post.user");
  if (!$user_id) {
      $user_id = wbNewId();
      setcookie("user",$user_id,time()+(3600*24*100),"/");
      $app->vars("_cook.user",$user_id);
  }
  $place_id = $app->vars("_post.chat");
  $place = $app->itemRead("places",$place_id);
  if (!$place) throw new \Exception("Отсутствует place ID", 1);
  if ($place["active"] !== "on") throw new \Exception("Отключен place ID", 1);

  if ($user_id == $place["_creator"]) {
	  $token = $app->vars("_post.key");
    $app->chat_id = md5($token);
  } else {
	  if ($app->vars("_post.key")) {
		  $chat = _chatRead($app->vars("_post.key"));
		  if ($chat !== null) return $app->vars("_post.key");
	  }
	  $secret = "lk;wqe;klrtjhwe;r|супер|секрет|weklrjth elk rjh";
	  $token = md5($user_id.$secret.$place_id);
	  if ($app->vars("_post.key") && $token !== $app->vars("_post.key"))  throw new \Exception("Невалидный токен", 1);
  }
  $app->token = $token;
  $app->user_id = $user_id;
  $app->place_id = $place_id;
  $app->owner_id = $place["_creator"];
  return $token;
}


function _chatCheckUser() {
	$app = &$_ENV["app"];
	$user_id = $app->vars("_post.user");
	$token = chatToken($user_id);
	if ($token == $app->vars("_post.key") OR $user_id == $app->owner_id) return $user_id;
	if ($token !== $app->vars("_post.key")) return false;
    return $app->vars("_cookie.user");
}


function _chatRead($chat_id) {
	$app = &$_ENV["app"];
	$list = $app->itemList("chat", 'active = "on" AND chat_id = "'.$chat_id.'"');
	if (!count($list)) return null;
	return chatAfterItemRead(array_shift($list));
}
?>
