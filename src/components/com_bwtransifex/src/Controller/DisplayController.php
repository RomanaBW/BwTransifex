<?php
/**
 * BwTransifex Component
 *
 * BwTransifex display controller class for the component frontend
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

namespace BoldtWebservice\Component\BwTransifex\Site\Controller;

// No direct access
defined('_JEXEC') or die('Restricted access');

use Exception;
use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\CMS\MVC\Model\BaseDatabaseModel;

/**
 * BwTransifex master display controller.
 *
 * @since 1.0.0
 */
class DisplayController extends BaseController
{
    /**
     * The default view.
     *
     * @var    string
     * @since 1.0.0
     */
    protected $default_view = 'Project';

    /**
     * Constructor.
     *
     * @param 	array	$config		An optional associative array of configuration settings.
     *
     * @return void
     *
     * @throws Exception
     *
     * @since	1.0.0

     * @see		JController
     */
    public function __construct($config = array())
    {
        $this->factory = Factory::getApplication()->bootComponent('com_bwtransifex')->getMVCFactory();

        parent::__construct($config, $this->factory);
    }

    /**
     * Method to get a model object, loading it if required.
     *
     * @param   string  $name    The model name. Optional.
     * @param   string  $prefix  The class prefix. Optional.
     * @param   array   $config  Configuration array for model. Optional.
     *
     * @return    BaseDatabaseModel    The model.
     *
     * @since 1.0.0
     */
    public function getModel($name = 'Project', $prefix = 'Site', $config = array()): BaseDatabaseModel
    {
        return $this->factory->createModel($name, $prefix, $config);
    }
}
