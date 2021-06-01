<?php
require __DIR__ . '/vendor/autoload.php';
use InvalidArgumentException;
use Sunrise\Vin\Vin;

class modVin {

    function __construct($app) {
        $this->app = &$app;
        $out = false;
        $mode = $app->vars("_route.mode");
        $this->init();
        if ($mode > '' && $mode !== 'init') {
            method_exists($this,$mode) ? $out=@$this->$mode() : null;
        } 
        if ($out) echo $out;
        die;
    }

    function init() {

    }

    function getvin($number = 'WBANJ51020CV06259') {
        
        try {
            $vin = new Vin($number);
        } catch (InvalidArgumentException $e) {
            // It isn't a valid VIN...
        }

        $this->vin = (object)[
             'vin'      => $vin->getVin()
            ,'wmi'      => $vin->getWmi()
            ,'vds'      => $vin->getVds()
            ,'vis'      => $vin->getVis()
            ,'region'   => $vin->getRegion()
            ,'country'  => $vin->getCountry()
            ,'vendor'   => $vin->getManufacturer()
            ,'year'     => $vin->getModelYear()
        ];
    }

    function css() {
        $app = &$this->app;
        $this->getvin();
        $file = '_'.$app->route->params[1];
        $css = file_get_contents(__DIR__. '/'.$file);
        if (!$css) {
            http_response_code(404);
        } else {
            $css = str_replace('undefined.jpg',strtolower($this->vin->vendor).'.jpg',$css);
            header("Content-type: text/css; charset=utf-8");
            echo $css;
        }
        die;
    }
}
?>