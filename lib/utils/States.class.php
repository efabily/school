<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class StatesClass {

  private static $states_list = array (
    'MyStandardStates' => array('New', 'Active', 'Inactive'),
    //  added before this line different states of the MyStandardStates    
    'AccountStates' => array('Abierto', 'Cerrado', 'Anulado', 'Eliminado'),
    'CashBoxStates' => array('Abierta', 'Cerrada', 'Observada'),
      
    //  added after this line different states of the MyStandardStates
    
  );

  static public function getStateName(BaseObject $object, $gender = '')
  {
    return __(self::getStateFromIndexType($object->getIdState(), get_class($object)).$gender);
  }

  static public function getStatesNames($type = '')
  {
    $type_name = $type.'States';

    if (!array_key_exists($type_name, self::$states_list))
    {
      $type_name = 'MyStandardStates';
    }
    
    return self::$states_list[$type_name];
  }

  static private function getStatesInteger($type = null)
  {
    return self::getStatesNames($type);
  }
  
  static private function getStateFromIndexType($index, $type = null)
  {
    $states = self::getStatesInteger($type);

    return $states[$index - 1];
  }
  
  
  /**
   *
   * @param String $type
   * @return Array
   */
  public static function getArrayStateName($type = '')
  {
    $array_name = self::getStatesNames($type);
    
    $array = array(0 => ' ');
    
    for( $i = 0; $i < count($array_name); $i++)
    {
      $array[$i+1] = $array_name[$i];
    }
    
    return $array;
  }
  
}