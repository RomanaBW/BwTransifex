<?php
/**
 * BwTransifex Component
 *
 * BwTransifex Project controller class for the component frontend
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
use Joomla\CMS\MVC\Controller\FormController;
use Joomla\CMS\MVC\Model\BaseDatabaseModel;

/**
 * BwTransifex Project Controller
 *
 * @package BwTransifex
 *
 * @since 1.0.0
 */
class ProjectController extends FormController
{
    /**
     * Constructor
     *
     * @param array $config     An optional associative array of configuration settings.
     *                          Recognized key values include 'name', 'default_task', 'model_path', and
     *                          'view_path' (this list is not meant to be comprehensive).
     *
     * @throws Exception
     *
     * @since 1.0.0
     */
    public function __construct($config = array())
    {
        parent::__construct($config);
    }

    /**
     * Proxy for getModel.
     *
     * @param string $name   The name of the model.
     * @param string $prefix The prefix for the PHP class name.
     * @param array  $config An optional associative array of configuration settings.
     *
     * @return BaseDatabaseModel
     *
     * @throws Exception
     *
     * @since 1.0.0
     */
    public function getModel($name = 'Project', $prefix = 'Site', $config = array('ignore_request' => true)): BaseDatabaseModel
    {
        return $this->factory->createModel($name, $prefix, $config);
    }
}
