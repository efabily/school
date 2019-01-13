<?php


/**
 * Skeleton subclass for performing query and update operations on the 'sch_period' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Wed Sep 12 01:53:15 2012
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model.student
 */
class PeriodPeer extends BasePeriodPeer {
   
   public static function savePeriod($data, $period = null,  $con = null)
   {
      if(!is_object($period))
      {
	 $period = new Period();
      }
      
      PropertySetter::set($period, $data);
      
      $period->save($con);
      
      return $period;
   }
   
   /**
    * Devuelve el periodo actualmente activo
    * 
    * @param Int $id_state
    * @return Period
    */
   public static function getPeriod($id_state)
   {
      $criteria = new Criteria();
      $criteria->add(self::ID_STATE, $id_state);
      
      return self::doSelectOne($criteria);
   }
   
   public static function getPeriods()
   {
      $criteria = new Criteria();
      
      $criteria->addDescendingOrderByColumn(self::ID);
      
      $periods =  self::doSelect($criteria);                  

       if (count($periods) > 1)
       {
	 $all_period = array('0' => '');
       } else {
	 $all_period = array();
       }

       foreach ($periods as $period)
       {
	 $all_period[$period->getId()] = $period->getName();
       }

       return $all_period;
   }
   
   public static function lastPeriod()
   {
      $criteria = new Criteria();
      
      $criteria->add(self::ID_STATE, 2);
      $criteria->addDescendingOrderByColumn(self::ID);
      
      return self::doSelectOne($criteria);
   }
   
   public static function ultimoPeriodoCerrado()
   {
      $criteria = new Criteria();
      $criteria->add(self::ID_STATE, 3);
      $criteria->addDescendingOrderByColumn(self::ID);
      
      return self::doSelectOne($criteria);
   }
   
   public static function getAnotherAssetExchange($id_state, $period_id)
   {
      $criteria = new Criteria();
      
      $criteria->add(self::ID_STATE, $id_state);
      
      $criteria->add(self::ID, $period_id, Criteria::NOT_EQUAL);
      
      return self::doSelectOne($criteria);      
   }
   
   
} // PeriodPeer