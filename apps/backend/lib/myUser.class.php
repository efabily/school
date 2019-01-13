<?php

class myUser extends sfGuardSecurityUser
{
   public function getId() {
    // Example if you use sfGuardPlugin :
    return $this->getGuardUser()->getId();
  }
   
}
