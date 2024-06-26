<?php
/**
 * @version		$Id: menu.php 9233 2007-10-15 21:14:45Z jinx $
 * @package		Joomla
 * @copyright	Copyright (C) 2005 - 2007 Open Source Matters. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 * Joomla! is free software. This version may have been modified pursuant to the
 * GNU General Public License, and as distributed it includes or is derivative
 * of works licensed under the GNU General Public License or other free or open
 * source software licenses. See COPYRIGHT.php for copyright notices and
 * details.
 */

/**
 * The directory of JoomlaMenu
*/

// requires object
require_once(BACKEND_ROOT_DIR . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR .
  'utils' . DIRECTORY_SEPARATOR .'Menu' . DIRECTORY_SEPARATOR . 'object.php');

// requires tree
require_once(BACKEND_ROOT_DIR . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR .
  'utils' . DIRECTORY_SEPARATOR .'Menu' . DIRECTORY_SEPARATOR . 'tree.php');

class JAdminCSSMenu extends JTree
{
	/**
	 * CSS string to add to document head
	 * @var string
	 */
	var $_css = null;

	function __construct()
	{
		$this->_root = new JMenuNode('ROOT');
		$this->_current = & $this->_root;
	}

  /*
	function addSeparator()
	{
		$this->addChild(new JMenuNode(null, null, 'separator', false));
	}*/

	function renderMenu($container = 'container4', $class = 'menu4')
	{
		global $mainframe;

		$depth = 1;

		$container='class="'.$container.'"';

		$class='class="'.$class.'"';

    /* render the header */
    //echo '<div '.$container.'>' . "\n";
    echo '	<div '.$class.'>' . "\n";
    
		/*
		 * Recurse through children if they exist
		 */
 
		while ($this->_current->hasChildren())
		{
			echo "<ul>\n";
			foreach ($this->_current->getChildren() as $child)
			{
				$this->_current = & $child;
				$this->renderLevel($depth++);
			}
			echo "</ul>\n";
		}
		echo "\t" . '</div>';
    //echo '</div>';

}

	function renderLevel($depth)
	{
		/*
		 * Build the CSS class suffix
		 */
		$class = '';
		
		/*
		if ($this->_current->hasChildren()) {
			$class = ' class="node"';
		}

		if($this->_current->class == 'separator') {
			$class = ' class="separator"';
		}

		if($this->_current->class == 'disabled') {
			$class = ' class="disabled"';
		}*/

		/*
		 * Print the item as a submenu if it has childrens and only if is not a root element
		 */
		if ($this->_current->hasChildren() && $this->_current->getParent()->title != 'ROOT') {
			$class = ' class="'.$this->_current->class.' subsubl"';
		} else {
      $class = ' class="'.$this->_current->class.'"';
    }
    //$class = ' class="'.$this->_current->class.' subsubl"';
    //$class = ' class="'.$this->_current->class.'"';

		echo "<li".$class.">";
		
				/*
		 * Print a link if it exists
		 */
		if ($this->_current->link != null) {
			echo "<a  href=\"".$this->_current->link."\">".$this->_current->title."</a>";
		} elseif ($this->_current->title != null) {
			echo "<a>".$this->_current->title."</a>\n";
		} else {
			echo "<span></span>";
		}

    //die(print_r($this->_current->getParent()->title));
		/*
		 * Recurse through children if they exist
		 */
		while ($this->_current->hasChildren())
		{
			echo '<ul>'."\n";
			foreach ($this->_current->getChildren() as $child)
			{
				$this->_current = & $child;
				$this->renderLevel($depth++);
			}
			echo "</ul>\n";
		}
		echo "</li>\n";
	}

	/**
	 * Method to get the CSS class name for an icon identifier or create one if
	 * a custom image path is passed as the identifier
	 *
	 * @access	public
	 * @param	string	$identifier	Icon identification string
	 * @return	string	CSS class name
	 * @since	1.5
	 */
	function getIconClass($identifier)
	{
		global $mainframe;

		static $classes;

		// Initialize the known classes array if it does not exist
		if (!is_array($classes)) {
			$classes = array();
		}

		/*
		 * If we don't already know about the class... build it and mark it
		 * known so we don't have to build it again
		 */
		if (!isset($classes[$identifier])) {
			if (substr($identifier, 0, 6) == 'class:') {
				// We were passed a class name
				$class = substr($identifier, 6);
				$classes[$identifier] = "icon-16-$class";
			} else {
				// We were passed an image path... is it a themeoffice one?
				if (substr($identifier, 0, 15) == 'js/ThemeOffice/') {
					// Strip the filename without extension and use that for the classname
					$class = preg_replace('#\.[^.]*$#', '', basename($identifier));
					$classes[$identifier] = "icon-16-$class";
				} else {
					if ($identifier == null) {
						return null;
					}
					// Build the CSS class for the icon
					$class = preg_replace('#\.[^.]*$#', '', basename($identifier));
					$class = preg_replace( '#\.\.[^A-Za-z0-9\.\_\- ]#', '', $class);

					$this->_css  .= "\n.icon-16-$class {\n" .
							"\tbackground: url($identifier) no-repeat;\n" .
							"}\n";

					$classes[$identifier] = "icon-16-$class";
				}
			}
		}
		return $classes[$identifier];
	}
}

class JMenuNode extends JNode
{
	/**
	 * Node Title
	 */
	var $title = null;

	/**
	 * Node Id
	 */
	var $id = null;


	/**
	 * Node Link
	 */
	var $link = null;

	/**
	 * CSS Class for node
	 */
	var $class = null;

	/**
	 * Active Node?
	 */
	var $active = false;


	function __construct($title, $link = null, $class = null, $active = false)
	{
		$this->title	= $title;
		//$this->link		= JFilterOutput::ampReplace($link);
		$this->link		= $link;
		$this->class	= $class;
		$this->active	= $active;
		$this->id		= str_replace(" ","-",$title);

	}
}
