<?php

declare(strict_types=1);

/**
 * Test bootstrap for ksf_FA_EstatePlanning.
 *
 * The module's unit tests exercise the hook class directly, so the small
 * slice of FrontAccounting that hooks.php touches is stubbed here: the
 * `hooks` base class, the `application` base class and the two global
 * helpers. Without them the suite cannot even be loaded, because
 * hooks.php declares `class hooks_ksf_FA_EstatePlanning extends hooks`.
 */

if (!function_exists('_')) {
    /**
     * FA's translation passthrough.
     *
     * @param string $text Text to translate
     * @return string
     */
    function _($text)
    {
        return $text;
    }
}

if (!function_exists('set_ext_domain')) {
    /**
     * FA's extension-domain switch.
     *
     * @param string|null $domain Domain to switch to
     * @return bool
     */
    function set_ext_domain($domain = null)
    {
        return true;
    }
}

if (!defined('MENU_INQUIRY')) {
    define('MENU_INQUIRY', 1);
}

if (!class_exists('hooks')) {
    /**
     * Minimal stand-in for FA core's hooks base class.
     */
    class hooks
    {
        /** @var string */
        public $module_name = '';

        /** @var string */
        public $version = '';

        /**
         * @param int   $company    Company number
         * @param array $updates    Schema update map
         * @param bool  $check_only Check only
         * @return bool
         */
        public function update_databases($company, $updates, $check_only = false)
        {
            return true;
        }
    }
}

if (!class_exists('application')) {
    /**
     * Minimal stand-in for FA core's application base class.
     */
    class application
    {
        /**
         * @param string|null $name        Application name
         * @param string|null $helpContext Help context
         */
        public function __construct($name = null, $helpContext = null)
        {
        }

        /**
         * @param mixed $app Application to add
         * @return void
         */
        public function add_application($app)
        {
        }

        /**
         * @param mixed $module Module label
         * @return void
         */
        public function add_module($module)
        {
        }

        /**
         * @param int    $id       Function id
         * @param string $label    Label
         * @param string $url      URL
         * @param string $security Security area
         * @param int    $access   Menu access
         * @return void
         */
        public function add_lapp_function($id, $label, $url, $security, $access)
        {
        }

        /**
         * @return void
         */
        public function add_extensions()
        {
        }
    }
}

require_once dirname(__DIR__) . '/hooks.php';
