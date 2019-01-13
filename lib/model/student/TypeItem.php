<?php


/**
 * Skeleton subclass for representing a row from the 'sch_type_item' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Fri Sep 28 00:21:34 2012
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model.student
 */
class TypeItem extends BaseTypeItem {

  public function  __toString()
  {
    return $this->getName();
  }
  
  public function getNameState()
  {
      $r = '';
      switch ($this->getIdState())
      {
	 case 1:
	    $r = 'Nuevo';
	    break;
	 case 2:
	    $r = 'Activo';
	    break;
	 case 3:
	    $r = 'Inactivo';
	    break;
      }
      return $r;
  }
  
   public function changeStateId($id_state, $con = null)
   {
      $this->setIdState($id_state);
      $this->save($con);
   }
  
} // TypeItem