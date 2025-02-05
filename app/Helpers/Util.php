<?php

namespace App\Helpers;

class Util {
	public static function estado($char){
    	$texto = '';
    	if($char=='A'){
        	$texto = 'Activo';
    	}else if($char=='I'){
        	$texto = 'Inactivo';
    	}else if($char=='E'){
        	$texto = 'Eliminado';
    	}else if($char=='N'){
        	$texto = 'Anulado';
    	}
	return $texto;
	}

	public static function bagde($char){
    	$estilo = '';
    	if($char=='A'){
        	$estilo = 'success';
    	}else if($char=='I'){
        	$estilo = 'danger';
    	}else if($char=='E'){
        	$estilo = 'warning';
    	}else if($char=='N'){
        	$estilo = 'dark';
    	}
    	return $estilo;
	}

  public static function role($char){
    $texto = '';
    if($char=='A'){
        $texto = 'Administrador';
    }else if($char=='U'){
        $texto = 'Usuario';
    }else{
      $texto = 'Visitante';
    }
    return $texto;
  }

  public static function cstatus($char){
    $texto = '';
    if($char=='1'){
        $texto = 'Aceptado';
    }else if($char=='2'){
        $texto = 'Por definir';
    }else if($char=='0'){
      $texto = 'Rechazado';
    }
    return $texto;
  }

  public static function cbagde($char){
    $estilo = '';
    if($char=='1'){
      $estilo = 'success';
    }else if($char=='2'){
      $estilo = 'warning';
    }else if($char=='0'){
      $estilo = 'danger';
    }
    return $estilo;
  }
}
