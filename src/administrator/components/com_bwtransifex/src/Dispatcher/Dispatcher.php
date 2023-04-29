<?php
/**
 * BwTransifex Component
 *
 * BwTransifex dispatcher class for the component backend
 *
 * @version %%version_number%%
 * @package BwTransifex
 * @subpackage BwTransifex Component
 * @author Romana Boldt
 * @copyright (C) %%copyright_year%% Boldt Webservice <forum@boldt-webservice.de>
 * @support https://www.boldt-webservice.de/en/forum-en/forum/bwtransifex.html
 * @license GNU/GPL, see LICENSE.txt
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
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace BoldtWebservice\Component\BwTransifex\Administrator\Dispatcher;

defined('JPATH_PLATFORM') or die;

use Exception;
use Joomla\CMS\Dispatcher\ComponentDispatcher;

/**
 * ComponentDispatcher class for com_bwtransifex
 *
 * @since 1.0.0
 */
class Dispatcher extends ComponentDispatcher
{
    protected string $defaultController = 'Project';

    protected array $viewMap = [
        'Project'  => 'Project',
        'Projects' => 'Projects',
    ];

    /**
     * Dispatch a controller task. Redirecting the user if appropriate.
     *
     * @return  void
     *
     * @throws Exception
     *
     * @since 1.0.0
     */
    public function dispatch(): void
    {
        $this->loadLanguage();
        $this->applyViewAndController();

        parent::dispatch();
    }

    /**
     * Load the language
     *
     * @return  void
     *
     * @since 1.0.0
     */
    protected function loadLanguage(): void
    {
        $jLang = $this->app->getLanguage();

        $jLang->load($this->option, JPATH_ADMINISTRATOR);

        if (!$this->app->isClient('administrator'))
        {
            $jLang->load($this->option, JPATH_SITE);
        }
    }

    /**
     * Apply view and controller
     *
     * @return  void
     *
     * @since 1.0.0
     */
    protected function applyViewAndController(): void
    {
        $controller = $this->input->getCmd('controller');
        $view       = $this->input->getCmd('view');
        $task       = $this->input->getCmd('task', 'default');

        if (str_contains($task, '.'))
        {
            // Explode the controller.task command.
            [$controller, $task] = explode('.', $task);
        }

        if (empty($controller) && empty($view))
        {
            $controller = $this->defaultController;
            $view       = $this->defaultController;
        }
        elseif (empty($controller) && !empty($view))
        {
            $view       = $this->mapView($view);
            $controller = $view;
        }
        elseif (!empty($controller) && empty($view))
        {
            $view = $controller;
        }
        else
        {
            $view = $controller;
        }

        $controller = strtolower($controller);
        $view       = strtolower($view);

        $this->input->set('view', $view);
        $this->input->set('controller', $controller);
        $this->input->set('task', $task);
    }

    /**
     * Get correct view
     *
     * @param string $view
     *
     * @return string
     *
     * @since 1.0.0
     */
    protected function mapView(string $view): string
    {
        $view = strtolower($view);

        return $this->viewMap[$view] ?? $view;
    }
}
