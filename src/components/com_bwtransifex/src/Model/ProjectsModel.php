<?php
/**
 * BwTransifex Component
 *
 * BwTransifex list model class for the component frontend
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

namespace BoldtWebservice\Component\BwTransifex\Site\Model;

// No direct access
defined('_JEXEC') or die('Restricted access');

use Exception;
use Joomla\CMS\MVC\Model\ListModel;

/**
 * BwTransifex Projects Model
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
     * @throws Exception
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        parent::__construct();
    }
}
