<?php
/**
 * BwTransifex Component
 *
 * BwTransifex lists model class for the component backend
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
use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Model\ListModel;
use Joomla\CMS\Table\Table;

/**
 * BwTransifex Model
 *
 * @package BwTransifex
 *
 * @since 1.0.0
 */
class ProjectsModel extends ListModel
{
    /**
     * Constructor
     *
     * @param   array  $config  An optional associative array of configuration settings.
     *
     * @throws Exception
     *
     * @since 1.0.0
     *
     */
    public function __construct($config = array())
    {
        if (empty($config['filter_fields']))
        {
            $config['filter_fields'] = array(
                'a.ordering',
                'a.state',
                'a.access',
                'a.description',
                'a.created',
                'a.created_by',
                'a.modified',
                'a.modified_by',
                'a.id',
            );
        }

        parent::__construct($config);
    }

    /**
     * Method to auto-populate the model state.
     *
     * Note. Calling getState in this method will result in recursion.
     *
     * @throws Exception
     *
     * @since 1.0.0
     */
    protected function populateState($ordering = null, $direction = null): void
    {
        // Initialise variables.
        $app = Factory::getApplication();

        // Load the filter state.
        $search = $this->getUserStateFromRequest($this->context . '.filter.search', 'filter_search', null, 'string');
        $this->setState('filter.search', $search);

        $filtersearch = $this->getUserStateFromRequest($this->context . '.filter.search_filter', 'filter_search_filter');
        $this->setState('filter.search_filter', $filtersearch);

        $state = $this->getUserStateFromRequest($this->context . '.filter.state', 'filter_state', '', 'string');
        $this->setState('filter.state', $state);

        // Check if the ordering field is in the white list, otherwise use the incoming value.
        $filter_order = $app->getUserStateFromRequest($this->context . '.filter_order', 'filter_order', $ordering, 'string');

        if (!in_array($filter_order, $this->filter_fields))
        {
            $filter_order = $ordering;
            $app->setUserState($this->context . '.filter_order', $filter_order);
        }

        $this->setState('list.ordering', $filter_order);

        // Check if the ordering direction is valid, otherwise use the incoming value.
        $filter_order_dir = $app->getUserStateFromRequest($this->context . '.filter_order_Dir', 'filter_order_Dir', $direction, 'cmd');

        if (!in_array(strtoupper($filter_order_dir), array('ASC', 'DESC', '')))
        {
            $filter_order = $direction;
            $app->setUserState($this->context . '.filter_order_Dir', $filter_order_dir);
        }

        $this->setState('list.direction', $filter_order_dir);

        // Load the parameters.
        $params = ComponentHelper::getParams('com_bwtransifex');
        $this->setState('params', $params);
    }

    /**
     * Method to get a store id based on model configuration state.
     *
     * This is necessary because the model is used by the component and
     * different modules that might need different sets of data or different
     * ordering requirements.
     *
     * @param	string		$id	A prefix for the store id.
     *
     * @return	string		A store id.
     *
     * @since	1.0.0
     */
    protected function getStoreId($id = ''): string
    {
        // Compile the store id.
        $id	.= ':' . $this->getState('filter.search');
        $id	.= ':' . $this->getState('filter.search_filter');
        $id	.= ':' . $this->getState('filter.parent_state');
        $id	.= ':' . $this->getState('filter.state');

        return parent::getStoreId($id);
    }

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
}
