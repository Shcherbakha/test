<?php
/**
 * Created by PhpStorm.
 * User: Gennadiy
 * Date: 07.12.2015
 * Time: 13:33
 */
error_reporting(E_ALL);
//Make work faster
ob_start("ob_gzhandler");
if (count($argv) == 0) exit;
foreach ($argv as $arg)
    $i = $arg;
//Source for show
$site = $i;
$target = file_get_contents($site);
$list = '';
preg_match_all('|href="([^"]{1,655})">|', $target, $out, PREG_PATTERN_ORDER);
//preg_match_all('|(<a[^h]{1,68}href=")([^"]{1,655})(">.{1,400}</a>)|', $target, $out, PREG_PATTERN_ORDER);
for ($i = 0; $i < count($out[0]); $i++) {
    $list[$i] = $out[1][$i]. "\r\n";
}
//Looking only unique
$list_uniq = array_unique($list);
$string = implode($list);
$pattern = '/(href=")(\/[^"]{1,50}\">)/i';
$replacement = "$1$site$2";
echo preg_replace($pattern, $replacement, $string);