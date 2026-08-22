<?php
/**
 * Estate Planning Module Overview Page
 *
 * @path_to_root ../../..
 * @page_security SA_ESTATEPLANNING_VIEW
 */

$page_security = 'SA_ESTATEPLANNING_VIEW';
$path_to_root = '../..';
include_once($path_to_root . "/includes/session.inc");
add_access_extensions();
$page = page(_('Estate Planning Overview'));

start_table();
    row(_('Welcome to the Estate Planning Module'), '');
end_table();

start_table($tb_style);
   $th = array(_('Feature'), _('Status'));
    table_header($th);
    alternative_click_shift();
    table_row();
        label_cell(_('Tax Calculator'));
        data_cell(_('Available'));
    end_row();
    table_row();
        label_cell(_('Beneficiary Analysis'));
        data_cell(_('Available'));
    end_row();
    table_row();
        label_cell(_('Trust Modeling'));
        data_cell(_('Planned'));
    end_row();
end_table();

end_page();
