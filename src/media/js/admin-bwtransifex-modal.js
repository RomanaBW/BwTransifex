/**
 * BwTransifex
 *
 * BwTransifex
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

(() => {
  ready(function() {
    let frames = document.getElementsByTagName('iframe');
  })


  /**
    * Javascript to …
    * */

  document.addEventListener('DOMContentLoaded', () => {
    // Get the elements
    const elements = document.querySelectorAll('.select-link');
  });

  function doAjax(uri, data, successCallback)
  {
    Joomla.request({
      url: uri,
      method: 'POST',
      data: data,
      perform: true,
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      },
      onSuccess: function onSuccess(response) {
        alert(response);
        successCallback(response);
      },
      onError: function onError(xhr) {
        alert('Error: ' + xhr);
        let message = document.createElement('div');
        message.innerHTML = '<p class="text-danger">AJAX Error: ' + xhr.statusText + '<br />' + xhr.responseText + '</p>';
      }
    });
  }

})();
