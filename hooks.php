<?php
// hooks.php
// Unique integer ID for this module
#define('SS_ksf_FA_EstatePlanning', 150 << 8);

class hooks_ksf_FA_EstatePlanning extends hooks
{
    var $module_name = 'ksf_FA_EstatePlanning';
    var $version = '1.0.0';

    // Integration with FA SQL database
    function install_tabs($app)
    {
        set_ext_domain('modules/ksf_FA_EstatePlanning');
        $app->add_application(new EstatePlanningApp());
        set_ext_domain();
    }

    // Security configuration
    function install_access()
    {
        $security_sections['SS_ksf_FA_EstatePlanning'] = 'Estate Planning';
        $security_areas['SA_ESTATEPLANNING_VIEW'] = array(
            SS_ksf_FA_EstatePlanning | 1, '_('View Estate Planning')'
        );
        return array($security_areas, $security_sections);
    }

    // Database activation
    function activate_extension($company, $check_only = true)
    {
        $updates = [
            'install.sql' => array('kmf_estateplanning_records')
        ];
        return $this->update_databases($company, $updates, $check_only);
    }
}


/\*\/

/\*\/
class EstatePlanningApp extends application
{
    public function __construct()
    { $this->name = 'Estate Planning'; 
       $this->add_module('Estate Planning');
    }
\/\*
\/\*