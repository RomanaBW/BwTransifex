<?php
/**
 * BwTransifex Component
 *
 * BwTransifex details model class for the component backend
 *
 * @version %%version_number%%
 * @package BwTransifex
 * @subpackage BwTransifex Component
 * @author Romana Boldt
 * @copyright (C) %%copyright_year%% Boldt Webservice <forum@boldt-webservice.de>
 * @support https://www.boldt-webservice.de/en/forum-en/forum/bwtransifex.html
 * @license GNU/GPL, see LICENSE.txt
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

namespace BoldtWebservice\Component\BwTransifex\Administrator\Model;

// No direct access
defined('_JEXEC') or die('Restricted access');

use Exception;
use Joomla\CMS\Form\Form;
use Joomla\CMS\MVC\Model\AdminModel;
use Joomla\CMS\Table\Table;

/**
 * Project Model
 *
 * @package BwTransifex
 *
 * @since 1.0.0
 */
class ProjectModel extends AdminModel
{
    /**
     * Returns a reference to a Table object, always creating it.
     *
     * @param   string  $name     The table type to instantiate
     * @param   string  $prefix   A prefix for the table class name. Optional.
     * @param   array   $options  Configuration array for model. Optional.
     *
     * @return        Table    A database object
     *
     * @throws Exception
     *
     * @since 1.0.0
     */
    public function getTable($name = 'Project', $prefix = 'Administrator', $options = array()): Table
    {
        return parent::getTable($name, $prefix, $options);
    }

	/**
	 * Method for getting a form.
	 *
	 * @param   array    $data      Data for the form.
	 * @param   boolean  $loadData  True if the form is to load its own data (default case), false if not.
	 *
	 * @return  Form|false    A JForm object on success, false on failure
	 *
	 * @since   4.0.0
	 *
	 * @throws Exception
	 */
	public function getForm($data = [], $loadData = true)
	{
		// Get the form.
		$form     = $this->loadForm('com_bwtransifex.project', 'Project', array('control' => 'jform', 'load_data' => $loadData));

		if (empty($form))
		{
			return false;
		}

		return $form;
	}
}
