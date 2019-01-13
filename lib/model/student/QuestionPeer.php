<?php


/**
 * Skeleton subclass for performing query and update operations on the 'tbl_question' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Tue Sep  4 00:14:39 2012
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model.student
 */
class QuestionPeer extends BaseQuestionPeer {

   /**
    *
    * @param Int $id_state
    * @param String $question_s
    * @param String $reply
    * @param String $label
    * @param String $description
    * @param Int $student_id
    * @param Question $question || null
    * @param PropelPDO $con
    */
   public static function saveQuestion($id_state, $question_s, $reply, $label, $description, $contract_id, $question = null, $con = null)
   {
      if(!is_object($question))
      {
	 $question = new Question();	 	 
      }
      
      $question->setIdState($id_state);
      $question->setQuestion($question_s);
      $question->setReply($reply);
      $question->setLabel($label);
      $question->setDescription($description);
      $question->setContractId($contract_id);
      $question->save($con);      
      
      return $question;
   }
   
   
   /**
    *     
    * @param String $question || null
    * @param Int $id_state || null
    * @param Int $student_id    
    * @return Attribute
    */
   public static function getAttributeByKeyAndStudent($contract_id, $question = null, $id_state = null)
   {
       $criteria = new Criteria();       
       $criteria->add(self::CONTRACT_ID, $contract_id);
       
       if($question)
       {
	  $criteria->add(self::QUESTION, $question);
       }       
       
       if($id_state)
       {
           $criteria->add(self::ID_STATE, $id_state);
       }
       
       return self::doSelectOne($criteria);
   }
   
   
   
   
   
} // QuestionPeer