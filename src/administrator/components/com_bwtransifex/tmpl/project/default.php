<?php
/**
 * BwTransifex Component
 *
 * BwTransifex template 'project' for the component backend
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

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Router\Route;

// Load the tooltip behavior for the notes
/** @var Joomla\CMS\WebAsset\WebAssetManager $wa */
$wa = $this->document->getWebAssetManager();
$wa->useScript('keepalive')
    ->useScript('form.validate');
HTMLHelper::_('bootstrap.popover', '.hasPopover', array('placement' => 'bottom'));

$detailText = Text::_('COM_BWTRANSIFEX_PROJECT_' . ((int) $this->item->id === 0 ? 'NEW' : 'EDIT'), true);
?>

<div id="bwp_editform">
    <form action="<?php echo Route::_('index.php?option=com_bwtransifex&layout=default&id=' . (int) $this->item->id); ?>"
        method="post" name="adminForm" id="item-form" aria-label="<?php echo $detailText; ?>" class="form-validate">
        <div class="main-card">
            <?php
            echo HTMLHelper::_('uitab.startTabSet', 'project_tabs', ['active' => 'details', 'recall' => true, 'breakpoint' => 768]);

            echo HTMLHelper::_('uitab.addTab', 'project_tabs', 'details', Text::_('COM_BWTRANSIFEX_PROJECT_DETAILS'));
            ?>
            <div class="card card-body mb-3">
                <div class="row">
                    <div class="col-lg-6">
                        <?php echo $this->form->renderField('name'); ?>
                        <?php echo $this->form->renderField('description'); ?>
                        <?php echo $this->form->renderField('access'); ?>
                        <?php echo $this->form->renderField('published'); ?>
                    </div>
                    <div class="col-lg-9">
                        <div class="control-group">
                            <div class="control-label">
                                <?php echo $this->form->getLabel('created'); ?>
                            </div>
                            <div class="controls">
                                <?php echo $this->form->getInput('created'); ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="control-label">
                                <?php echo $this->form->getLabel('created_by'); ?>
                            </div>
                            <div class="controls">
                                <?php echo $this->form->getInput('created_by'); ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="control-label">
                                <?php echo $this->form->getLabel('modified_by'); ?>
                            </div>
                            <div class="controls">
                                <?php echo $this->form->getInput('modified_by'); ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="control-label">
                                <?php echo $this->form->getLabel('modified'); ?>
                            </div>
                            <div class="controls">
                                <?php echo $this->form->getInput('modified'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <?php echo LayoutHelper::render('joomla.edit.global', $this); ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            echo HTMLHelper::_('uitab.endTab');

            echo HTMLHelper::_('uitab.addTab', 'project_tabs', 'publishing', Text::_('JGLOBAL_FIELDSET_PUBLISHING'));
            ?>
            <div>
                <?php echo $this->form->renderFieldset('publish'); ?>
            </div>
            <?php
            echo HTMLHelper::_('uitab.endTab');

            if ($this->permissions['com']['admin'] || $this->permissions['admin']['project'])
            {
                echo HTMLHelper::_('uitab.addTab', 'project_tabs', 'rules', Text::_('COM_BWTRANSIFEX_PROJECT_FIELDSET_RULES'));
                ?>
                <div class="card card-body mb-3 com_config">
                    <?php echo $this->form->getInput('rules'); ?>
                </div>
                <?php
                echo HTMLHelper::_('uitab.endTab');
            }
            echo HTMLHelper::_('uitab.endTabSet');
            ?>
        </div>

        <input type="hidden" name="task" value="" />
        <input type="hidden" name="id" value="<?php echo $this->item->id; ?>" />

        <?php echo HTMLHelper::_('form.token'); ?>
    </form>
</div>
<?php echo LayoutHelper::render('footer', null, JPATH_ADMINISTRATOR . '/components/com_bwtransifex/layouts/footer'); ?>

