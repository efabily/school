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
 
function my_format_number($number)
{
	return numbers::my_format_number($number);
}

function my_format_number_calc($number)
{
	return numbers::my_format_number_calc($number);
}

function my_round($number)
{
  return numbers::my_round($number);
}

function my_format_round_calc($number)
{
  return numbers::my_format_round_calc($number);
}