<?php
/**
 * @link https://github.com/himiklab/yii2-sitemap-module
 * @copyright Copyright (c) 2014 HimikLab
 * @license http://opensource.org/licenses/MIT MIT
 *
 * @var array $urls
 */
echo '<?xml version = "1.0" encoding = "UTF-8"?>' . PHP_EOL;
?>
<sitemapindex
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/siteindex.xsd"
        xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    <sitemap>
        <loc>https://gems.ua/sitemap_stat.xml</loc>
    </sitemap>
    <?php

    list($rub, $kop) = explode(".", sizeof($urls) / 50000);
    $rub++;
    for ($i = 1;
         $i <= $rub;
         $i++) {
        echo '
    <sitemap>
        <loc>https://gems.ua/sitemap.xml?page=' . $i . ' </loc >
    </sitemap >
';
    }

    ?>


</sitemapindex>