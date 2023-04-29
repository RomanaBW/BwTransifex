<?php
/**
 * BwTransifex Component
 *
 * BwTransifex table class for the component backend
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

namespace BoldtWebservice\Component\BwTransifex\Administrator\Table;

// No direct access
defined('_JEXEC') or die('Restricted access');

use Exception;
use Joomla\CMS\Table\Table;
use Joomla\Database\DatabaseDriver;

/**
 * BwTransifex table class
 *
 * @package BwTransifex
 *
 * @since 1.0.0
 */
class ProjectTable extends Table
{
    /**
     * @var int|null Primary Key
     *
     * @since 1.0.0
     */
    public ?int $id = null;

    /**
     * @var string description
     *
     * @since 1.0.0
     */
    public string $description = '';

    /**
     * @var int access
     *
     * @since 1.0.0
     */
    public int $access = 1;

    /**
     * @var int state
     *
     * @since 1.0.0
     */
    public int $state = 0;

    /**
     * @var string|null creation date of the project
     *
     * @since 1.0.0
     */
    public ?string $created = '0000-00-00 00:00:00';

    /**
     * @var int|null user ID
     *
     * @since 1.0.0
     */
    public ?int $created_by = 0;

    /**
     * @var string|null last modification date of the project
     *
     * @since 1.0.0
     */
    public ?string $modified = '0000-00-00 00:00:00';

    /**
     * @var int|null user ID
     *
     * @since 1.0.0
     */
    public ?int $modified_by = 0;

    /**
     * Constructor
     *
     * @param   DatabaseDriver  $db  Database connector object
     *
     * @since 1.0.0
     */
    public function __construct($db)
    {
        parent::__construct('#__bwtransifex', 'id', $db);
    }

    /**
     * Overloaded check method to ensure data integrity
     *
     * @access public
     *
     * @return boolean True
     *
     * @throws Exception
     *
     * @since 1.0.0
     */
    public function check(): bool
    {
        parent::check();

        return true;
    }
}

