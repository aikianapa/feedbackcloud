<?php
class modCabinet {
  function __construct($app) {
      $this->app = $app;
      $mode = $app->route->mode;
      echo $this->$mode();
      die;
  }

  function __call($mode, $params)  {
      header('Content-Type: charset=utf-8');
      header('Content-Type: text/html');

      if (!is_callable(@$this->$mode)) {
          header( "HTTP/1.1 404 Not Found" );
          echo "Error 404";
      }
      die;
  }

  function init()
  {
      $this->app->path = __DIR__;
      $cabinet = $this->app->fromFile(__DIR__."/tpl/cabinet_ui.php");
      $cabinet->fetch();
      return $cabinet;
  }

  function tpl() {
      $file = __DIR__."/tpl/cabinet_".$this->app->route->params[0].".php";
      $tpl = $this->app->fromFile($file);
      if (!$tpl) $tpl = $this->app->fromString("<div>Not found: {$file}</div>");
      $tpl->fetch();
      // исправление баги со скобками в атрибутах src и href
      $tpl = str_replace(['%7B','%7D'],['{','}'],$tpl->outer());
      $tpl = html_entity_decode($tpl);

      return $tpl;
  }

}
?>

<?php


function cabinet__tpl(&$app) {
  $tpl = $app->vars("_route.params.0");
  $out = $app->fromFile(__DIR__."/tpl/cabinet_{$tpl}.php",true);
  $out->fetch();
  if ($out->find("[data-prop]")->length) return $out->find("[data-prop]")[0]->outerHtml();
  return $out->outerHtml();
}

function cabinet__modprop(&$app) {
  $module = $app->vars("_route.params.0");
  $path = $app->vars("_env.modules.{$module}.dir");
  $out = $app->fromString("",true);
  $out->html($app->fromFile(__DIR__."/tpl/cabinet_modules.php",true)->find("[data-prop='modal']"));
  $out->data("module",$module);
  $out->fetch();
  $sett = $app->vars("_env.path_app").$path."/{$module}_sett.php";
  if (is_file($sett)) {
      $set = $app->fromFile($sett,true);

      $out->find(".modal-body form")->append($set);
  }
  $out->find(".modal-title")->text($app->vars("_env.modules.{$module}.label"));
  echo $out->fetch();
  die;
}



?>
