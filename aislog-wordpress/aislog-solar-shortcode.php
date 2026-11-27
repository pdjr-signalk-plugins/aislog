<?php

namespace PDJR\AisLogSolarShortcode;

/**********************************************************************
 * Add support for [solar url='...'] shortcode. 
 */

function render_solar_attachment($url) {
  $retval = "";
  $retval .= "<div id='aislog-solar' style='display: flex; flex-direction: column; width: 100%; background: #e0e0e0; margin-top: 20px;'>\n";
  if ($json = json_decode(file_get_contents($url), true)) {
    $totalYield = 0;
    foreach ($json as $solarId => $solar) {
      if (array_key_exists('yieldYesterday', $solar)) {
        $yieldYesterday = ($solar['yieldYesterday']['value'] / 3600000);
        $totalYield += $yieldYesterday;
        $retval .= "<div style='display: flex; flex-direction: row; width: 100%;'>\n";
        $retval .= "<div style='flex: 0.5;'>Solar controller {$solarId}</div>\n";
        $retval .= sprintf("<div style='flex: 0.5;'>%0.2f&nbsp;kWh</div>\n", $yieldYesterday);
        $retval .= "</div>";
        if ($totalYield != $yieldYesterday) {
          $retval .= "<div style='display: flex; flex-direction: row; width: 100%;'>\n";
          $retval .= "<div style='flex: 0.5;'>Total</div>\n";
          $retval .= sprintf("<div style='flex: 0.5;'>%0.2f&nbsp;kWh</div>\n", $totalYield);
          $retval .= "</div>\n";
        }
      }
    }
  }
  $retval .= "</div>\n";
  return($retval);
}

function shortcode($atts, $content = null) {
  $retval = "";
  if ($atts['url']) {
    $retval = render_solar_attachment($atts['url']);
  }
  return($retval);
}

add_shortcode('solar', 'PDJR\AisLogSolarShortcode\shortcode');

?>