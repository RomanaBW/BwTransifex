<?php
/**
 * BwTransifex Component
 *
 * BwTransifex component class for the component backend
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

namespace BoldtWebservice\Component\BwTransifex\Administrator\Extension;

defined('JPATH_PLATFORM') or die;

use Exception;
use JLoader;
use Joomla\CMS\Component\Router\RouterServiceInterface;
use Joomla\CMS\Component\Router\RouterServiceTrait;
use Joomla\CMS\Extension\BootableExtensionInterface;
use Joomla\CMS\Extension\MVCComponent;
use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLRegistryAwareTrait;
use BoldtWebservice\Component\BwTransifex\Administrator\Service\Html\BwTransifex;
use Joomla\CMS\MVC\Model\DatabaseAwareTrait;
use Psr\Container\ContainerInterface;

/**
 * Component class for com_bwtransifex
 *
 * @since 1.0.0
 */
class BwTransifexComponent extends MVCComponent implements BootableExtensionInterface, RouterServiceInterface
{
    use HTMLRegistryAwareTrait;
    use DatabaseAwareTrait;
    use RouterServiceTrait;

    protected static $dic;

    /**
     * Booting the extension. This is the function to set up the environment of the extension like
     * registering new class loaders, etc.
     *
     * If required, some initial set up can be done from services of the container, e.g.
     * registering HTML services.
     *
     * @param   ContainerInterface  $container  The container
     *
     * @return  void
     *
     * @since 1.0.0
     */
    public function boot(ContainerInterface $container)
    {
        $this->getRegistry()->register('bwtransifex', new BwTransifex);

        JLoader::registerNamespace('BoldtWebservice\\Component\\BwTransifex\\Administrator\\Extension', BWTRANSIFEX_ADMINISTRATOR . '/src/Extension');
        JLoader::registerNamespace('BoldtWebservice\\Component\\BwTransifex\\Administrator\\Helper', BWTRANSIFEX_ADMINISTRATOR . '/src/Helper');
        JLoader::registerNamespace('BoldtWebservice\\Component\\BwTransifex\\Administrator\\Field', BWTRANSIFEX_ADMINISTRATOR . '/src/Field');
        JLoader::registerNamespace('BoldtWebservice\\Component\\BwTransifex\\Administrator\\Model', BWTRANSIFEX_ADMINISTRATOR . '/src/Model');
        JLoader::registerNamespace('BoldtWebservice\\Component\\BwTransifex\\Administrator\\Controller', BWTRANSIFEX_ADMINISTRATOR . '/src/Controller');
        JLoader::registerNamespace('BoldtWebservice\\Component\\BwTransifex\\Administrator\\View', BWTRANSIFEX_ADMINISTRATOR . '/src/View');
        JLoader::registerNamespace('BoldtWebservice\\Component\\BwTransifex\\Administrator\\Table', BWTRANSIFEX_ADMINISTRATOR . '/src/Table');
        JLoader::registerNamespace('BoldtWebservice\\Component\\BwTransifex\\Administrator\\Service', BWTRANSIFEX_ADMINISTRATOR . '/src/Service');
        JLoader::registerNamespace('BoldtWebservice\\Component\\BwTransifex\\Administrator\\Service\\Html', BWTRANSIFEX_ADMINISTRATOR . '/src/Service/Html');
        JLoader::registerNamespace('BoldtWebservice\\Component\\BwTransifex\\Administrator\\Libraries', BWTRANSIFEX_ADMINISTRATOR . '/libraries');

        JLoader::registerNamespace('BoldtWebservice\\Component\\BwTransifex\\Site\\Dispatcher', BWTRANSIFEX_SITE . '/src/Dispatcher');
        JLoader::registerNamespace('BoldtWebservice\\Component\\BwTransifex\\Site\\Service', BWTRANSIFEX_SITE . '/src/Service');
        JLoader::registerNamespace('BoldtWebservice\\Component\\BwTransifex\\Site\\Controller', BWTRANSIFEX_SITE . '/src/Controller');
        JLoader::registerNamespace('BoldtWebservice\\Component\\BwTransifex\\Site\\Model', BWTRANSIFEX_SITE . '/src/Model');
        JLoader::registerNamespace('BoldtWebservice\\Component\\BwTransifex\\Site\\View', BWTRANSIFEX_SITE . '/src/View');
        JLoader::registerNamespace('BoldtWebservice\\Component\\BwTransifex\\Site\\Helper', BWTRANSIFEX_SITE . '/Helper');

        self::$dic = $container;
    }

    /**
     *
     * @return mixed
     *
     * @throws \Exception
     *
     * @since 1.0.0
     */
    public static function getContainer()
    {
        if (empty(self::$dic))
        {
            Factory::getApplication()->bootComponent('com_bwtransifex');
        }

        return self::$dic;
    }
}
