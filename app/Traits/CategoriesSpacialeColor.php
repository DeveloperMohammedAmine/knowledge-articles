<?php

namespace App\Traits;

trait categoriesSpacialeColor {

   static public function specialeColor($category) {
      
      $categories = [
         'light',
         'primary',
         'warning',
         'success',
         'dark',
         'danger',
      ];

      return $categories[$category];

   }

}



?>


