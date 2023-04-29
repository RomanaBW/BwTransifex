<?php
/**
 * BwTransifex Component
 *
 * BwTransifex installer class for the component
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
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Installer\InstallerAdapter;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\Session\Session;

/**
 * The main BwTransifex installation class
 *
 * @package BwTransifex
 *
 * @since 1.0.0
 */
class com_bwtransifexInstallerScript
{
    /**
     * @var InstallerAdapter $parentInstaller
     *
     * @since 1.0.0
     */
    public InstallerAdapter $parentInstaller;

    /**
     * @var string $minimum_php_version
     *
     * @since 1.0.0
     */
    private string $minimum_php_version = "8.1";

    /**
     * @var string $minimum_joomla_release
     *
     * @since 1.0.0
     */
    private string $minimum_joomla_release = "3.10.11";

    /**
     * @var string release
     *
     * @since 1.0.0
     */
    private string $release = '';

    /**
     * BwTransifex component preflight function
     * Called before any type of action
     *
     * @param string             $type   Which action is happening (install|uninstall|discover_install|update)
     * @param   InstallerAdapter $parent The object responsible for running this script
     *
     * @return  boolean  True on success
     *
     * @throws Exception
     *
     * @since 1.0.0
     */
    public function preflight(string $type, InstallerAdapter $parent): bool
    {
        $app     = Factory::getApplication();
        $session = $app->getSession();

        $this->parentInstaller = $parent->getParent();
        $manifest              = $parent->getManifest();

        // Get component manifest file version
        $this->release = (string) $manifest->version;
        $session->set('release', $this->release, 'bwtransifex');

        if ($type !== 'uninstall')
        {
            // Abort if the minimum Joomla version is not met
            if (version_compare(JVERSION, $this->minimum_joomla_release, 'lt'))
            {
                $app->enqueueMessage(Text::sprintf('COM_BWTRANSIFEX_INSTALLATION_ERROR_JVERSION',
                    $this->minimum_joomla_release), 'error');

                return false;
            }

            // Abort if the minimum php version is not met
            if (version_compare(phpversion(), $this->minimum_php_version, 'lt'))
            {
                $app->enqueueMessage(Text::sprintf('COM_BWTRANSIFEX_INSTALLATION_ERROR_PHP_VERSION', $this->minimum_php_version), 'error');

                return false;
            }

            // Abort if the component being installed is older than the currently installed version
            if ($type == 'update')
            {
                $oldRelease = $this->getManifestVar('version');
                $app->setUserState('com_bwtransifex.update.oldRelease', $oldRelease);

                if (version_compare($this->release, $oldRelease, 'lt'))
                {
                    $app->enqueueMessage(Text::sprintf('COM_BWTRANSIFEX_INSTALLATION_ERROR_INCORRECT_VERSION_SEQUENCE',
                        $oldRelease, $this->release), 'error');

                    return false;
                }
            }
        }

        return true;
    }

    /**
     * BwTransifex component install function
     *
     * @throws Exception
     *
     * @since 1.0.0
     */
    public function install(): void
    {
        $this->showFinished(false);
    }

    /**
     * BwTransifex component uninstall function
     *
     * @since 1.0.0
     */
    public function uninstall(): void
    {
    }

    /**
     * BwTransifex component update function
     *
     * @throws Exception
     *
     * @since 1.0.0
     */
    public function update(): void
    {
        $this->showFinished(true);
    }

	/**
	 * BwTransifex component postflight function
	 *
     * @param   string            $type    type of installation

	 * @return bool
	 *
	 * @throws Exception
	 *
	 * @since 1.0.0
	 */
	public function postflight(string $type): bool
    {
        if ($type == 'install')
        {
            // Set BwTransifex default settings in the extensions table at install
            $this->setDefaultParams();
        }

        return true;
    }

    /**
     * Method to get the database object depending on Joomla! main version
     *
     * @return mixed
     *
     * @since 1.0.0
     */
    protected function getDb()
    {
        if (version_compare(JVERSION, '4.0.0', 'ge'))
        {
            $db = Factory::getContainer()->get('db');
        }
        else
        {
            $db = Factory::getDbo();
        }

        return $db;
    }

    /**
     * get a variable from the manifest file (actually, from the manifest cache).
     *
     * @param string $name
     *
     * @return  string
     *
     * @throws Exception
     *
     * @since 1.0.0
     */
    private function getManifestVar(string $name): string
    {
        $manifest = array();
        $db       = $this->getDb();
        $query    = $db->getQuery(true);

        $query->select($db->quoteName('manifest_cache'));
        $query->from($db->quoteName('#__extensions'));
        $query->where($db->quoteName('element') . " = " . $db->quote('com_bwtransifex'));

        try
        {
            $db->setQuery($query);

            $manifest = json_decode($db->loadResult(), true);
        }
        catch (RuntimeException $e)
        {
            Factory::getApplication()->enqueueMessage($e->getMessage(), 'error');
        }

        return $manifest[$name];
    }

    /**
     * Preset default values for params of component at extensions table
     *
     * @return  void
     *
     * @throws Exception
     *
     * @since 1.0.0
     */
    private function setDefaultParams(): void
    {
        $params_default = array();
        $config	= Factory::getApplication()->getConfig();

//        $params_default['default_from_name']               = $config->get('fromname');

        $params	= json_encode($params_default);

        $db    = $this->getDb();
        $query = $db->getQuery(true);

        $query->update($db->quoteName('#__extensions'));
        $query->set($db->quoteName('params') . " = " . $db->quote($params));
        $query->where($db->quoteName('element') . " = " . $db->quote('com_bwtransifex'));

        try
        {
            $db->setQuery($query);
            $db->execute();
        }
        catch (RuntimeException $e)
        {
            Factory::getApplication()->enqueueMessage($e->getMessage(), 'error');
        }
    }

    /**
     * shows the HTML after installation/update
     *
     * @param boolean $update
     *
     * @return  void
     *
     * @throws Exception
     *
     * @since 1.0.0
     */
    public function showFinished(bool $update): void
    {
        $lang = Factory::getApplication()->getLanguage();

        // First load english files
        $lang->load('com_bwtransifex.sys', JPATH_ADMINISTRATOR, 'en_GB', true);
        $lang->load('com_bwtransifex', JPATH_ADMINISTRATOR, 'en_GB', true);

        // The load current language
        $lang->load('com_bwtransifex.sys', JPATH_ADMINISTRATOR, null, true);
        $lang->load('com_bwtransifex', JPATH_ADMINISTRATOR, null, true);

        $show_update = false;
        $show_right  = false;
        $lang_ver    = substr($lang->getTag(), 0, 2);

        if ($lang_ver != 'de')
        {
            $forum    = "https://www.boldt-webservice.de/en/forum-en/forum/bwtransifex.html";
            $manual = "https://www.boldt-webservice.de/index.php/en/forum-en/manuals/bwtransifex-manual.html";
        }
        else
        {
            $forum = "https://www.boldt-webservice.de/de/forum/bwtransifex.html";
            $manual = "https://www.boldt-webservice.de/index.php/de/forum/handb%C3%BCcher/handbuch-zu-bwtransifex.html";
        }

        if ($update)
        {
            $string_special = Text::_('COM_BWTRANSIFEX_INSTALLATION_UPDATE_SPECIAL_NOTE_DESC');
        }
        else
        {
            $string_special = Text::_('COM_BWTRANSIFEX_INSTALLATION_INSTALLATION_SPECIAL_NOTE_DESC');
        }

        $string_new         = Text::_('COM_BWTRANSIFEX_INSTALLATION_UPDATE_NEW_DESC');
        $string_improvement = Text::_('COM_BWTRANSIFEX_INSTALLATION_UPDATE_IMPROVEMENT_DESC');
        $string_bugfix      = Text::_('COM_BWTRANSIFEX_INSTALLATION_UPDATE_BUGFIX_DESC');

        if (($string_bugfix != '' || $string_improvement != '' || $string_new != '') && $update)
        {
            $show_update = true;
        }

        if ($show_update || $string_special != '')
        {
            $show_right = true;
        }

        $asset_path = 'media/com_bwtransifex';
        $image_path = 'media/com_bwtransifex/images';
        ?>

        <div id="bw_install_header" class="text-center">
            <a href="https://www.boldt-webservice.de" target="_blank">
                <img class="img-fluid border-0" src="<?php echo Uri::root() . $asset_path . '/images/bw_header.png'; ?>" alt="Boldt Webservice" />
            </a>
        </div>
        <div class="top_line"></div>

        <div id="bw_installation_outer" class="row">
            <div class="col-lg-12 text-center p-2 mt-2">
                <h1><?php echo Text::_('COM_BWTRANSIFEX_INSTALLATION_WELCOME') ?></h1>
            </div>
            <div id="bw_installation_left" class="col-lg-6 mb-2">
                <div class="bw_installation_welcome">
                    <p><?php echo Text::_('COM_BWTRANSIFEX_DESCRIPTION') ?></p>
                </div>
                <div class="bw_installation_finished text-center">
                    <h2>
                        <?php
                        if ($update)
                        {
                            echo Text::sprintf('COM_BWTRANSIFEX_UPGRADE_SUCCESSFUL', $this->release);
                        }
                        else
                        {
                            echo Text::sprintf('COM_BWTRANSIFEX_INSTALLATION_SUCCESSFUL', $this->release);
                        }
                        ?>
                    </h2>
                </div>
                <?php
                if ($show_right)
                { ?>
                    <div class="cpanel text-center mb-3">
                        <div class="icon btn" >
                            <a href="<?php echo Route::_('index.php?option=com_bwtransifex'); ?>">
                                <?php echo HtmlHelper::_(
                                    'image',
                                    $image_path . '/icon-48-bwtransifex.png',
                                    Text::_('COM_BWTRANSIFEX_INSTALLATION_GO_BWTRANSIFEX')
                                ); ?>
                                <span><?php echo Text::_('COM_BWTRANSIFEX_INSTALLATION_GO_BWTRANSIFEX'); ?></span>
                            </a>
                        </div>
                        <div class="icon btn">
                            <a href="<?php echo $manual; ?>" target="_blank">
                                <?php echo HtmlHelper::_(
                                    'image',
                                    $image_path . '/icon-48-manual.png',
                                    Text::_('COM_BWTRANSIFEX_INSTALLATION_MANUAL')
                                ); ?>
                                <span><?php echo Text::_('COM_BWTRANSIFEX_INSTALLATION_MANUAL'); ?></span>
                            </a>
                        </div>
                        <div class="icon btn">
                            <a href="<?php echo $forum; ?>" target="_blank">
                                <?php echo HtmlHelper::_(
                                    'image',
                                    $image_path . '/icon-48-forum.png',
                                    Text::_('COM_BWTRANSIFEX_INSTALLATION_FORUM')
                                ); ?>
                                <span><?php echo Text::_('COM_BWTRANSIFEX_INSTALLATION_FORUM'); ?></span>
                            </a>
                        </div>
                    </div>
                    <?php
                } ?>
            </div>

            <div id="bw_installation_right" class="col-lg-6">
                <?php
                if ($show_right)
                {
                    if ($string_special != '')
                    { ?>
                        <div class="bw_installation_specialnote">
                            <h2><?php echo Text::_('COM_BWTRANSIFEX_INSTALLATION_SPECIAL_NOTE_LBL') ?></h2>
                            <p class="urgent"><?php echo $string_special; ?></p>
                        </div>
                        <?php
                    } ?>

                    <?php
                    if ($show_update)
                    { ?>
                        <div class="bw_installation_updateinfo mb-3 p-3">
                            <h2 class="mb-3"><?php echo Text::_('COM_BWTRANSIFEX_INSTALLATION_UPDATEINFO') ?></h2>
                            <?php echo Text::_('COM_BWTRANSIFEX_INSTALLATION_CHANGELOG_INFO'); ?>
                            <?php if ($string_new != '')
                            { ?>
                                <h3 class="mb-2"><?php echo Text::_('COM_BWTRANSIFEX_INSTALLATION_UPDATE_NEW_LBL') ?></h3>
                                <p><?php echo $string_new; ?></p>
                            <?php
                            } ?>
                            <?php if ($string_improvement != '')
                            { ?>
                                <h3 class="mb-2"><?php echo Text::_('COM_BWTRANSIFEX_INSTALLATION_UPDATE_IMPROVEMENT_LBL') ?></h3>
                                <p><?php echo $string_improvement; ?></p>
                            <?php
                            } ?>
                            <?php if ($string_bugfix != '')
                            { ?>
                                <h3 class="mb-2"><?php echo Text::_('COM_BWTRANSIFEX_INSTALLATION_UPDATE_BUGFIX_LBL') ?></h3>
                                <p><?php echo $string_bugfix; ?></p>
                            <?php
                            } ?>
                        </div>
                        <?php
                    }
                }
                else
                { ?>
                    <div class="cpanel text-center mb-3">
                        <div class="icon btn" >
                            <a href="<?php echo Route::_('index.php?option=com_bwtransifex&token=' . Session::getFormToken()); ?>">
                                <?php echo HtmlHelper::_(
                                    'image',
                                    $image_path . '/icon-48-bwtransifex.png',
                                    Text::_('COM_BWTRANSIFEX_INSTALLATION_GO_BWTRANSIFEX')
                                ); ?>
                                <span><?php echo Text::_('COM_BWTRANSIFEX_INSTALLATION_GO_BWTRANSIFEX'); ?></span>
                            </a>
                        </div>
                        <div class="icon btn">
                            <a href="<?php echo $manual; ?>" target="_blank">
                                <?php echo HtmlHelper::_(
                                    'image',
                                    $image_path . '/icon-48-bwtransifex.png',
                                    Text::_('COM_BWTRANSIFEX_INSTALLATION_MANUAL')
                                ); ?>
                                <span><?php echo Text::_('COM_BWTRANSIFEX_INSTALLATION_MANUAL'); ?></span>
                            </a>
                        </div>
                        <div class="icon btn">
                            <a href="<?php echo $forum; ?>" target="_blank">
                                <?php echo HtmlHelper::_(
                                    'image',
                                    $image_path . '/icon-48-bwtransifex.png',
                                    Text::_('COM_BWTRANSIFEX_INSTALLATION_FORUM')
                                ); ?>
                                <span><?php echo Text::_('COM_BWTRANSIFEX_INSTALLATION_FORUM'); ?></span>
                            </a>
                        </div>
                    </div>
                    <?php
                } ?>
            </div>
            <div class="clr clearfix"></div>

            <div class="bw_installation_footer col-12 text-center my-3">
                <p class="small">
                    <?php echo Text::_('&copy; 2023-');
                    echo date(" Y") ?> by
                    <a href="https://www.boldt-webservice.de" target="_blank">Boldt Webservice</a>
                </p>
            </div>
        </div>
    <?php
    }
}
