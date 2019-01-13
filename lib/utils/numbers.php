<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 * (c) 2004 David Heinemeier Hansson
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
 
 /**
 * MyJavascriptHelper.
 *
 * @package    symfony
 * @subpackage myhelper
 * @author     Yassel Diaz Gomez <yasseldg@gmail.com>
 * @version    SVN: $Id: MyNumberHelper.php 2008-09-17  $
 */
 
class numbers
{
  /**
   * Ej: number_format($number, 2, ',','.');<br>
   *     resultado: 1.234,57
   * 
   */
  public static function my_format_number($number)
  {
    if (is_null($number))
    {
      return null;
    }
  
  	return number_format($number, 2, ',','.');
  }
  
  /**
   * English notation without thousands separator<br>
   * Ej: $number = 1234.5678;<br>
   *     $english_format_number = number_format($number, 2, '.', '');<br>
   *     resultado: 1234.57
   * 
   */
  public static function my_other_format_number($number)
  {
    if (is_null($number))
    {
      return null;
    }

  	return number_format($number, 2, '.','');
  }

  /**
   * French notation<br>
   * Ej: $number = 1234.56;<br>
   *     $nombre_format_francais = number_format($number, 2, ',', ' ');<br>
   *     resultado: 1 234,56
   * 
   * @param type $number
   * @return type 
   */
  public static function my_format_number_coma($number)
  {
    if (is_null($number))
    {
      return null;
    }

  	return number_format($number, 2, ',','');
  }

  /**
   * English notation without thousands separator<br>
   * Ej: $number = 1234.5678;<br>
   *     $english_format_number = number_format($number, 2, '.', '');<br>
   *     resultado: 1234.57
   * 
   */
  public static function my_format_number_calc($number)
  {
    if (is_null($number))
    {
      return null;
    }
  
  	return number_format($number, 2, '.','');
  }
  
  public static function my_format_round_calc($number)
  {
    if (is_null($number))
    {
      return null;
    }

  	return number_format(ceil($number), 2, '.','');
  }  
  
  /**
   * redondea segun numero<br>
   * 
   * ej: 5.6 redondea a 6 y 4.3 redondea a 4
   * 
   * @param type $number
   * @return type 
   */  
  public static function my_round($number)
  {
    if (is_null($number))
    {
      return null;
    }
    
    if(($number - intval($number)) > 0.50)
    {
      return ceil($number);
    } else {
      return floor($number);
    }
  }

  public static function extract_digit($sValue)
  {
    $sValue = preg_replace('/[^[:digit:]]/', '', $sValue);
    
    return trim($sValue);
  }
  
 
  
}