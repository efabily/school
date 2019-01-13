<?php

/**
 * Student form.
 *
 * @package    school
 * @subpackage form
 * @author     Your name here
 */
class TutorForm extends BaseStudentForm
{


   public function configure()
   {
      parent::setup();
      
      $this->setWidgets(array(
         'estudiante_nombre' => new sfWidgetFormInputText(array(), array(
         'required' => true
      ))
      ));
      
      $this->setValidators(array(
         'estudiante_nombre' => new sfValidatorString(array(
         'max_length' => 100
      ), array(
         'required' => 'Obligatorio'
      ))
      ));
   }


   public function updateDefaultsFromObject()
   {
      parent::updateDefaultsFromObject();
   }
}