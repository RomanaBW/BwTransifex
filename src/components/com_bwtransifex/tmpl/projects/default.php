<?php
/**
 * BwTransifex Component
 *
 * BwTransifex template 'Projects' for the component frontend
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

// no direct access
defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\Router\Route;
use Joomla\CMS\HTML\HTMLHelper;

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

$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
$limitstart	= $this->escape($this->state->get('list.start'));
$moduleId	= $this->escape($this->state->get('module.id', null));

$actionSuffix = '&Itemid=' . $this->Itemid;

if ($moduleId !== null && $moduleId !== '')
{
    $actionSuffix = '&mid=' . $moduleId;
}

?>

<div id="bwtransifex" class="mt">
    <div id="bw_com_projects">
        <?php if (($this->params->get('show_page_heading', '0') != 0) && ($this->params->get('page_heading', '') != '')) : ?>
            <h1 class="componentheading<?php echo $this->params->get('pageclass_sfx', ''); ?>">
                <?php echo $this->escape($this->params->get('page_heading', '')); ?>
            </h1>
        <?php endif; ?>

        <form action="<?php echo Route::_('index.php?option=com_bwtransifex&view=projects' . $actionSuffix); ?>" method="post"
            name="adminForm" id="adminForm">
            <table id="bw_projects_table<?php echo $this->params->get('pageclass_sfx', ''); ?>">
                <thead>
                <tr>
                    <th>
                    </th>
                    <th>
                    </th>
                    <th class="clicks_head">
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php
                if (count($this->items) > 0)
                {
                    foreach ($this->items as $i => $item)
                    {
                        ?>
                        <tr class="row<?php echo $i % 2; ?>">
                            <td>
                            </td>
                            <td>
                            </td>
                            <td></td>
                        </tr>
                        <?php
                    }
                }
                else
                { ?>
                <tr class="row0">
                    <td colspan="3"><?php echo Text::_('COM_BWTRANSIFEX_NO_PROJECTS_FOUND'); ?></td> <?php
                    } ?>
                </tbody>
            </table>

            <?php
            if ($this->pagination->pagesTotal > 1)
            { ?>
                <div class="pagination">
                    <?php echo $this->pagination->getPagesLinks(); ?>
                    <p class="counter"><?php echo $this->pagination->getPagesCounter(); ?> </p>
                </div>
                <?php
            } ?>

            <input type="hidden" name="option" value="com_bwtransifex" />
            <input type="hidden" name="task" value="" />
            <input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
            <input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
            <input type="hidden" name="limitstart" value="<?php echo $limitstart; ?>" />
            <input type="hidden" name="id" value="" />
            <?php echo HtmlHelper::_('form.token'); ?>
        </form>

        <?php
        if ($this->params->get('show_boldt_link', '1') === '1')
        { ?>
            <?php echo LayoutHelper::render('footer', null, JPATH_SITE . '/components/com_bwtransifex/layouts/footer'); ?>
            <?php
        } ?>
    </div>
</div>
