<?php
class placesClass extends cmsFormsClass {

  function beforeItemEdit(&$item) {
      if (isset($item['tables111'])) {
          foreach((array)$item['tables'] as $key => $table) {
              if ($table['active'] == true ) $table['active'] = 'on' ;
              if ($table['active'] !== "on" ) $table['active'] = '' ;
              $item['tables'][$key] = $table;
          }
      }
  }

}
?>
