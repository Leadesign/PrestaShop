<?php
/**
 * 2007-2015 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 *
 *  @author 	PrestaShop SA <contact@prestashop.com>
 *  @copyright  2007-2015 PrestaShop SA
 *  @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 *  International Registered Trademark & Property of PrestaShop SA
 */
namespace PrestaShopBundle\Service\DataProvider\Admin;

use PrestaShop\PrestaShop\Adapter\Admin\AbstractAdminQueryBuilder;

/**
 * Data provider for new Architecture, about Product object model.
 *
 * This class will provide data from DB / ORM about Products for the Admin interface.
 */
interface ProductInterface
{
    /**
     * Will retrieve set of parameters from persistence, for product filters.
     *
     * @return string[] The old filter parameters values
     */
    public function getPersistedFilterParameters();

    /**
     * Is there a specific category selected to filter product?
     *
     * @return boolean True if a category is selected.
     */
    public function isCategoryFiltered();

    /**
     * Is there any column filter value?
     *
     * A filter with empty string '' is considered as not filtering, but 0 or '0' is a filter value!
     *
     * @return boolean True if at least one column is filtered (except categories)
     */
    public function isColumnFiltered();

    /**
     * Will persist set of parameters for product filters.
     *
     * @param string[] $parameters
     */
    public function persistFilterParameters(array $parameters);

    /**
     * Combines new filter values with old ones (persisted), then persists the combination and returns it.
     *
     * @param string[]|null $paramsIn New filter params values to take into account. If not given, the method will simply return persisted values.
     * @return string[] The new filter params values
     */
    public function combinePersistentCatalogProductFilter($paramsIn = array());

    /**
     * Returns a collection of products, using default language, currency and others, from Context.
     *
     * @param integer|string $offset an offset, or the 'last' token
     * @param integer|string $limit a limit, or the 'last' token
     * @param string $orderBy Field name to sort during SQL query
     * @param string $sortOrder 'asc' or 'desc'
     * @param string[] $post filter params values to take into acount (often comes from POST data).
     * @return array[mixed[]] A list of products, as an array of arrays of raw data.
     */
    public function getCatalogProductList($offset, $limit, $orderBy, $sortOrder, $post = array());

    /**
     * Retrieve global product count (for the current shop).
     *
     * No filtering/limit/offset is applied to give this count.
     *
     * @return integer The product count on the current shop
     */
    public function countAllProducts();

    /**
     * Because pagination is tied to memory available on the server side, the choices can vary from one to another platform,
     * depending on the memory_limit allocated to PHP.
     * This will return Elements per page that are recommended to fetch products on the Admin catalog page.
     *
     * @return array[int] A list of pagination limits to show in the select dropbox in paginator component.
     */
    public function getPaginationLimitChoices();

    /**
     * Returns the last SQL query that was compiled on this Provider.
     *
     * @return string The last SQL query that was compiled with $this->compileSqlQuery()
     */
    public function getLastCompiledSql();
}
