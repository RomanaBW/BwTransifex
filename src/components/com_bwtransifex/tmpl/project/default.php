<?php
/**
 * BwTransifex Component
 *
 * BwTransifex template 'project' for the component frontend
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

// No direct access
defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\Factory;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Uri\Uri;

// Get provided style file
$app = Factory::getApplication();
$wa  = $app->getDocument()->getWebAssetManager();

$wa->useStyle('com_bwtransifex.bwtransifex_site');

// Get user defined style file
$templateName = $app->getTemplate();
$css_filename = 'templates/' . $templateName . '/css/com_bwtransifex.css';

if (file_exists(JPATH_BASE . '/' . $css_filename))
{
    $wa->registerAndUseStyle('customCss', Uri::root() . $css_filename);
}

?>

<div id="bwtransifex" class="mt">
    <div id="bw_com_project">
        <?php // if project unpublished - only backlink
            if (($this->params->get('show_page_heading', '0') != 0) && ($this->params->get('page_heading', '') != '')) { ?>
                <h1 class="contentheading<?php echo $this->escape($this->params->get('pageclass_sfx', '')); ?>">
                    <?php echo $this->escape($this->params->get('page_heading', '')); ?>
                </h1>
                <?php
                if ($this->page_title)
                { ?>
                    <h2></h2><?php
                } ?>
                <?php
            }
            else
            { ?>
                <?php
                if ($this->page_title)
                { ?>
                    <h1></h1><?php
                } ?>
                <?php
            } ?>

        <?php
        if ($this->params->get('show_boldt_link', '1') === '1')
        { ?>
            <?php echo LayoutHelper::render('footer', null, JPATH_SITE . '/components/com_bwtransifex/layouts/footer'); ?>
            <?php
        } ?>
    </div>
</div>
