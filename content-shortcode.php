<?php

$html = "
<div class='jbs-wrapper'>
    <script defer src='" . plugin_dir_url(__FILE__) . "assets/js/htmx.min.js'></script>
    <script defer src='" . plugin_dir_url(__FILE__) . "assets/js/jbs.min.js?ver=" . JBS_VER . "'></script>
    <link rel='stylesheet' href='" . plugin_dir_url(__FILE__) . "assets/css/jbs.min.css?ver=" . JBS_VER . "' />";

if ($title) {
    $html .= "<h2 class='jbs-title'>$title</h2>";
}

$html .= "
    <form class='jbs-form' method='get' hx-get='" . plugin_dir_url(__FILE__) . "api/search-htmx.php' hx-trigger='submit' hx-target='#jbs-search-results' hx-swap='innerHTML'>
        <select class='jbs-input' name='translation'>";

foreach ($trans_arr as $tran) {
    $tran = trim($tran);
    if ($tran == "nasb") $html .= "<option value='nasb'>New American Standard Bible</option>";
    if ($tran == "rbo") $html .= "<option value='rbo'>" . __('Russian Bible Society', 'justbible-search') . "</option>";
    if ($tran == "rst") $html .= "<option value='rst'>" . __('Russian Synodal Text', 'justbible-search') . "</option>";
}

$html .= "</select>        
        <input type='search' name='search' class='jbs-input' id='jbs-query' placeholder='$placeholder' />
        <button type='submit' class='jbs-button'>$button</button>
    </form>
    <div id='jbs-search-results' class='jbs-search-results'></div>
</div>
";
