<?php


/**
 * Skeleton subclass for performing query and update operations on the 'sch_item' table.
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
class ItemPeer extends BaseItemPeer {

   public static function saveItem($data, $item = null,  $con = null)
   {
      if(!is_object($item))
      {
	 $item = new Item();
      }

      PropertySetter::set($item, $data);

      $item->save($con);

      return $item;
   }

   /**
    *
    * @param Int $id_state
    * @param Int $type_item_id
    * @return Items
    */
   public static function getItems($id_state = null, $type_item_id = null)
   {
      $criteria = new Criteria();
      $criteria->add(self::ID, 1, Criteria::GREATER_THAN);
      if($id_state)
      {
	 $criteria->add(self::ID_STATE, $id_state);
      }

      if($type_item_id)
      {
	 $criteria->add(self::TYPE_ITEM_ID, $type_item_id);
      }

      return self::doSelect($criteria);
   }


   public static function getItemsByGrade($id_state = null, $grade_id = null, $type_item_id = null, $one = null)
   {
      $criteria = new Criteria();
      $criteria->add(self::ID, 1, Criteria::GREATER_THAN);

      $criteria->addJoin(self::ID, ItemGradePeer::ITEM_ID);
      $criteria->add(ItemGradePeer::GRADE_ID, $grade_id);

      if($id_state)
      {
	 $criteria->add(self::ID_STATE, $id_state);
         $criteria->add(ItemGradePeer::ID_STATE, $id_state);
      }

      if($type_item_id)
      {
	 $criteria->add(self::TYPE_ITEM_ID, $type_item_id);
      }

      if($one)
      {
	 return self::doSelectOne($criteria);
      } else {
	 return self::doSelect($criteria);
      }

   }


   public static function getItemNoGrade($id_state = null, $type_item_id = null)
   {
        $criteria = new Criteria();
        $criteria->add(self::ID, 1, Criteria::GREATER_THAN);

        $criteria->addJoin(self::ID, ItemGradePeer::ITEM_ID, Criteria::LEFT_JOIN);
        $criteria->add(ItemGradePeer::ITEM_ID, Null, Criteria::ISNULL);

        if($id_state)
        {
            $criteria->add(self::ID_STATE, $id_state);
        }

        if($type_item_id)
        {
            $criteria->add(self::TYPE_ITEM_ID, $type_item_id);
        }

        return self::doSelect($criteria);

   }



   public static function getItemsByDirectSales($id_state = null)
   {
      $criteria = new Criteria();
      // Mayor a 3
      $criteria->add(self::TYPE_ITEM_ID, 3, Criteria::GREATER_THAN);
      if($id_state)
      {
	 $criteria->add(self::ID_STATE, $id_state);
      }

      return self::doSelect($criteria);
   }

   public static function getMounth($value)
   {
      $r = '';

      switch ($value)
      {
	 case 1:
	    $r = 'Enero';
	    break;
	 case 2:
	    $r = 'Febrero';
	    break;
	 case 3:
	    $r = 'Marzo';
	    break;
	 case 4:
	    $r = 'Abril';
	    break;
	 case 5:
	    $r = 'Mayo';
	    break;
	 case 6:
	    $r = 'Junio';
	    break;
	 case 7:
	    $r = 'Julio';
	    break;
	 case 8:
	    $r = 'Agosto';
	    break;
	 case 9:
	    $r = 'Septiembre';
	    break;
	 case 10:
	    $r = 'Octubre';
	    break;
	 case 11:
	    $r = 'Noviembre';
	    break;
	 case 12:
	    $r = 'Diciembre';
	    break;
      }

      return $r;
   }


   /**
    *
    * @param Int $item_id
    * @return string
    */
   public static function getArrState($item_id = null)
   {
      $array_state = array(
	  0 => ' '
	 ,1 => 'Nuevo'
	 ,2 => 'Activo'
	 ,3 => 'Inactivo'
      );

      return $array_state;
   }


   public static function getItemsServices($id_state = null)
   {
      $criteria = new Criteria();
      $criteria->add(self::TYPE_ITEM_ID, 2, Criteria::GREATER_THAN);

      if($id_state)
      {
	 $criteria->add(self::ID_STATE, $id_state);
      }

      $criteria->addGroupByColumn(self::ID);

      return self::doSelect($criteria);
   }

   public static function getArrayItemsServices()
   {
      $items = self::getItemsServices();

      $array = array();

      foreach ($items as $item)
      {
	 $array[$item->getId()] = $item->getName();
      }

      return $array;
   }

   public static function getItemsAll($id_state = null)
   {
      $criteria = new Criteria();
      $criteria->add(self::TYPE_ITEM_ID, 2, Criteria::ALT_NOT_EQUAL);
      if($id_state)
      {
	 $criteria->add(self::ID_STATE, $id_state);
      }

      $criteria->addGroupByColumn(self::ID);

      return self::doSelect($criteria);
   }

   public static function getArraysItems($array_item = null)
   {
      $criteria = new Criteria();
      $criteria->add(self::TYPE_ITEM_ID, 2, Criteria::GREATER_THAN);

      if (is_array($array_item) &&  count($array_item) > 0)
      {
	$ban = true;
	foreach ($array_item as $item_id)
	{
	  if ($ban)
	  {
	     $criteria->add(self::ID, $item_id);
	     $ban = false;
	  } else {
	    $criteria->addOr(self::ID, $item_id);
	  }
	}
      } else {
	 $criteria->setLimit(1);
      }

      return self::doSelect($criteria);
   }

   public static function getItemReporteIngresoDia($period_id, $from_date, $to_date)
   {
      $criteria = new Criteria();

      $criteria->add(self::TYPE_ITEM_ID, 2, Criteria::GREATER_THAN);

      $criteria->addJoin(self::ID, ItemForSalePeer::ITEM_ID);
      $criteria->addJoin(ItemForSalePeer::SALES_ID, SalesPeer::ID);

      $criteria->addJoin(SalesPeer::ID, SaleAccountPeer::SALES_ID);
      $criteria->addJoin(SaleAccountPeer::ACCOUNT_ID, AccountPeer::ID);
      $criteria->addJoin(AccountPeer::CONTRACT_ID, ContractPeer::ID);
      $criteria->add(ContractPeer::PERIOD_ID, $period_id);
      $criteria->addJoin(ContractGradePeer::CONTRACT_ID, ContractPeer::ID);

      $criteria->add(ContractGradePeer::ID_STATE, 2);

      $criteria->addJoin(SalesPeer::ID, SalesDepositPeer::SALES_ID);
      $criteria->addJoin(SalesDepositPeer::DEPOSIT_ID, DepositPeer::ID);
      $criteria->addJoin(DepositPeer::ID, MovementCashboxDepositPeer::DEPOSIT_ID);
      $criteria->addJoin(MovementCashboxDepositPeer::MOVEMENT_CASHBOX_ID, MovementCashboxReceiptPeer::MOVEMENT_CASHBOX_ID);
      $criteria->addJoin(MovementCashboxReceiptPeer::RECEIPT_ID, ReceiptPeer::ID);
      $criteria->addJoin(ReceiptPeer::NIGHT_AUDIT_ID, NightAuditPeer::ID);
      $criteria->add(NightAuditPeer::DATE, $from_date, Criteria::GREATER_EQUAL);
      $criteria->addAnd(NightAuditPeer::DATE, $to_date, Criteria::LESS_EQUAL);

      $criteria->addGroupByColumn(self::ID);

      return self::doSelect($criteria);
   }



} // ItemPeer
