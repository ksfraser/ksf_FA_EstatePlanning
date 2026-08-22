<?php
// Unique integer — do not reuse. KSF modules: 114–143 assigned, 144+ available.
define('SS_ksf_FA_EstatePlanning', 145 << 8);

class hooks_ksf_FA_EstatePlanning extends hooks
{
    var $module_name = 'ksf_FA_EstatePlanning';
    var $version     = '1.0.0';

    function install_tabs($app)
    {
        set_ext_domain('modules/ksf_FA_EstatePlanning');
        $app->add_application(new estateplanning_app());
        set_ext_domain();
    }

    function install_access()
    {
        $security_sections[SS_ksf_FA_EstatePlanning] = _('Estate Planning');
        $security_areas['SA_ESTATEPLANNING_VIEW'] = array(
            SS_ksf_FA_EstatePlanning | 1,
            _('View Estate Planning'),
        );
        return array($security_areas, $security_sections);
    }

    function activate_extension($company, $check_only = true)
    {
        $updates = array('install.sql' => array('ksf_estateplanning_records'));
        return $this->update_databases($company, $updates, $check_only);
    }
}

/**
 * Application class for the Estate Planning module.
 */
class estateplanning_app extends application
{
    function __construct()
    {
        parent::__construct(
            _('Estate Planning'),
            _($this->help_context = '&Estate Planning')
        );
        $this->add_module(_('Estate Planning'));
        $this->add_lapp_function(
            0,
            _('&Overview'),
            'modules/ksf_FA_EstatePlanning/pages/overview.php',
            'SA_ESTATEPLANNING_VIEW',
            MENU_INQUIRY
        );
        $this->add_extensions();
    }
}