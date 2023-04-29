<?php
/**
 * BwTransifex Component
 *
 * BwTransifex layout 'footer'
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

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\Language\Text;

?>

<div class="bwat-footer col-md-12">
    <div class="card card-footer text-center mt-3">
        <p class="bwat_copyright">
            <a href="<?php echo $this->project_url ?>" target="_blank" title="<?php echo Text::_('BWTRANSIFEX_PROJECT_URL_DESCRIPTION'); ?>"><?php echo Text::sprintf('BWTRANSIFEX_VERSION_S',
                    $displayData['view']->version); ?></a>
        </p>
        <p class="bwat-review">
            <?php echo Text::_('COM_BWTRANSIFEX_REVIEW_MESSAGE'); ?>
        </p>
    </div>
</div>
