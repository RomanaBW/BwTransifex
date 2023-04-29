<?php
/**
 * BwTransifex Component
 *
 * BwTransifex display controller class for the component backend
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

// No direct access
defined('_JEXEC') or die('Restricted access');

use Exception;
use Joomla\CMS\MVC\Controller\BaseController;

/**
 * Define the main BwTransifex controller class
 *
 * @package BwTransifex
 *
 * @since 1.0.0
 */
class DisplayController extends BaseController
{
    /**
     * The default view.
     *
     * @var    string
     *
     * @since 1.0.0
     */
    protected $default_view = 'Project';

    /**
     * Method to display a view.
     *
     * @param boolean $cachable  If true, the view output will be cached
     * @param array   $urlparams An array of safe URL parameters and their variable types, for valid values see {@link \JFilterInput::clean()}.
     *
     * @return DisplayController This object to support chaining.
     *
     * @throws Exception
     *
     * @since 1.0.0
     */
    public function display($cachable = false, $urlparams = array()): DisplayController
    {
        return parent::display();
    }
}

