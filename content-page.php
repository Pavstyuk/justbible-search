<?php // admin page of plugin 
?>
<div class="wrap">
    <h1><?php esc_html_e('Just Bible Search Plugin Instructions', 'justbible-search') ?></h1>
    <p><?php esc_html_e("All you need to do is simply paste the plugin's shortcode into any page of your site to display search form.", 'justbible-search') ?></p>

    <h2><?php esc_html_e('Default ShortCode', 'justbible-search') ?></h2>
    <div>
        <code><b>[just_bible_search]</b></code>
        <p><?php esc_html_e('The short code displays form for Bible searching with default settings.', 'justbible-search') ?></p>
    </div>

    <h2><?php esc_html_e('Advanced ShortCode with attributes', 'justbible-search') ?></h2>
    <div>
        <code><b>[just_bible_search translation="nasb, rbo, rst" title="<?php esc_html_e('Search for words in the Bible', 'justbible-search') ?>" placeholder="<?php esc_html_e('What are you looking for?', 'justbible-search') ?>" button="<?php esc_html_e('Start Searching', 'justbible-search') ?>"]</b></code>
        <p><?php esc_html_e('You can additionally specify one or more shortcode attributes.', 'justbible-search') ?></p>
    </div>
    <h2><?php esc_html_e('Possible ShortCode attributes', 'justbible-search') ?></h2>
    <div>
        <p>
            <code><b>translation</b></code> - <?php esc_html_e('specify options of Bible translation. This plugin has only three translations in this moment:', 'justbible-search') ?> <b>nasb, rbo, rst</b><br />
            <code><b>title</b></code> - <?php esc_html_e('adds a title before the search form', 'justbible-search') ?><br />
            <code><b>placeholder</b></code> - <?php esc_html_e('changes the text in the search query input field', 'justbible-search') ?><br />
            <code><b>button</b></code> - <?php esc_html_e('changes the text on the button in the form', 'justbible-search') ?>
        </p>
    </div>

    <h2><?php esc_html_e('More about translations', 'justbible-search') ?></h2>
    <div>
        <p>
            <b>nasb</b> - New American Standard Bible, 1995<br />
            <b>rbo</b> - <?php esc_html_e('Modern Russian Translation of the Russian Bible Society, 2015', 'justbible-search') ?><br />
            <b>rst</b> - <?php esc_html_e('Russian Synodal Translation, Russian Bible Society, 1876', 'justbible-search') ?><br />
        </p>
    </div>

</div>

<p id="footer-left" style="margin-top: 80px">
    <a href='https://justbible.ru/' target='_blank'>justbible.ru</a><br />
    <?php esc_html_e('Version', 'justbible-search') ?> <?php echo esc_html(JBS_VER) ?>
</p>