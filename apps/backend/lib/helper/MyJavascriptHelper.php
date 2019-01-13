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
 * @version    SVN: $Id: MyJavascriptHelper.php 2008-09-17  $
 */

  function form_remote_tag_and_link($options = array(), $options_1 = array(), $options_html = array())
  {
    $options = _parse_attributes($options);
    $options_html = _parse_attributes($options_html);

    $options['form'] = true;

    $options['after'] = jq_remote_function($options_1);   // mi aporte

    $options_html['submit'] = jq_remote_function($options).' return false;';
    $options_html['action'] = isset($options_html['action']) ? $options_html['action'] : url_for($options['url']);
    $options_html['method'] = isset($options_html['method']) ? $options_html['method'] : 'post';

    return tag('form', $options_html, true);
  }

  function form_remote_tag_and_one_link($options = array(), $options_html = array())
  {
    $options = _parse_attributes($options);
    $options_html = _parse_attributes($options_html);

    $options['form'] = true;

    $options_html['submit'] = jq_remote_function($options).' return false;';
    $options_html['action'] = isset($options_html['action']) ? $options_html['action'] : url_for($options['url']);
    $options_html['method'] = isset($options_html['method']) ? $options_html['method'] : 'post';

    return tag('form', $options_html, true);
  }

  function form_remote_tag_and_link_full($options = array(), $options_html = array(), $full_options = array())
  {
    $options = _parse_attributes($options);
    $options_html = _parse_attributes($options_html);

    $options['form'] = true;
        
    $options['after'] = after_full($full_options);  // mi aporte

    $options_html['submit'] = jq_remote_function($options).' return false;';
    $options_html['action'] = isset($options_html['action']) ? $options_html['action'] : url_for($options['url']);
    $options_html['method'] = isset($options_html['method']) ? $options_html['method'] : 'post';

    return tag('form', $options_html, true);
  }

  function link_to_remote_multiple($name, $options = array(), $options_1 = array(), $html_options = array())
  {
    $options['after'] = jq_remote_function($options_1);  // mi aporte        
    
    return jq_link_to_function($name, jq_remote_function($options), $html_options);
    
  }

  /*  $full_options debe tener el siguiente formato
   *  array( 'after' => array('options' => $options | 'after' => array())...
   *
   */

  function link_to_remote_multiple_full($name, $options = array(), $html_options = array(), $full_options = array())
  {
    $options['after'] = after_full($full_options);  // mi aporte
    
    return jq_link_to_function($name, jq_remote_function($options), $html_options);
  }

  function after_full($full_options = array())
  {
    $temp_option = array();

    foreach ($full_options as $full_option)
    {
      $full_option['after'] = $temp_option;

      $temp_option = jq_remote_function($full_option);
    }
    
    return $temp_option;
  }
