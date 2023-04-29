<?php

/**
 * BwTransifex Component
 *
 * BwTransifex lists controller class for the component backend
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

namespace BoldtWebservice\Component\BwTransifex\Administrator\Controller;

// no direct access
defined('_JEXEC') or die('Restricted access');

use Exception;
use Joomla\CMS\MVC\Controller\AdminController;
use Joomla\CMS\MVC\Model\BaseDatabaseModel;

/**
 * BwTransifex Controller
 *
 * @package BwTransifex
 *
 * @since 1.0.0
 */
class ProjectsController extends AdminController
{
    /**
     * Constructor
     *
     * @param	array	$config		An optional associative array of configuration settings.
     *
     * @throws  Exception
     *
     * @since	1.0.0
     *
     * @see		JController
     */
    public function __construct($config = array())
    {
        parent::__construct($config, $this->factory);

        $this->factory = $this->app->bootComponent('com_bwtransifex')->getMVCFactory();

		// Register Extra tasks
		$this->registerTask('add', 'edit');
		$this->registerTask('apply', 'save');
    }

    /**
    /**
     * Display
     *
     * @param   boolean  $cachable   If true, the view output will be cached
     * @param   boolean  $urlparams  An array of safe url parameters and their variable types, for valid values see {@link FilterInput::clean()}.
     *
     * @return  ProjectsController		This object to support chaining.
     *
     * @throws Exception
     *
     * @since 1.0.0
     */
    public function display($cachable = false, $urlparams = false): ProjectsController
    {
        parent::display();

        return $this;
    }

    /**
     * Proxy for getModel.
     *
     * @param	string	$name   	The name of the model.
     * @param	string	$prefix 	The prefix for the PHP class name.
     * @param	array	$config		An optional associative array of configuration settings.
     *
     * @return bool|BaseDatabaseModel
     *
     * @since 1.0.0
     */
    public function getModel($name = 'Projects', $prefix = 'Administrator', $config = array('ignore_request' => true))
    {
        return $this->factory->createModel($name, $prefix, $config);
    }
}
