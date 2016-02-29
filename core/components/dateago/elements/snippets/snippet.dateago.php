<?php
/**
 * Formats date to "10 minutes ago" or "Yesterday in 22:10"
 * This algorithm taken from https://github.com/livestreet/livestreet/blob/7a6039b21c326acf03c956772325e1398801c5fe/engine/modules/viewer/plugs/function.date_format.php
 *
 * @var array $scriptProperties
 * @var string $input Date to format
 */
if (empty($input)) {
    return false;
}
if (!empty($options) && $options = $modx->fromJSON($options)) {
    $scriptProperties = array_merge($scriptProperties, $options);
}

require_once(MODX_CORE_PATH . 'components/dateago/include/declension.php');
$modx->lexicon->load('dateago:default');

$date = preg_match('/^\d+$/', $input)
    ? $input
    : strtotime($input);
$current = !empty($scriptProperties['current'])
    ? $scriptProperties['current']
    : time();
$dateFormat = $scriptProperties['dateFormat'];
$delta = $current - $date;

if (!empty($scriptProperties['dateNow']) && $delta > 0) {
    if ($delta < $scriptProperties['dateNow']) {
        return $modx->lexicon('da_now');
    }
}

if (!empty($scriptProperties['dateMinutes']) && $delta > 0) {
    $minutes = round(($delta) / 60);
    if ($minutes < $scriptProperties['dateMinutes']) {
        if ($minutes > 0) {
            return declension($minutes, $modx->lexicon('da_minutes', array('minutes' => $minutes)));
        } else {
            return $modx->lexicon('da_minutes_less');
        }
    }
}

if (!empty($scriptProperties['dateHours']) && $delta > 0) {
    $hours = round(($delta) / 3600);
    if ($hours < $scriptProperties['dateHours']) {
        if ($hours > 0) {
            return declension($hours, $modx->lexicon('da_hours', array('hours' => $hours)));
        } else {
            return $modx->lexicon('da_hours_less');
        }
    }
}

if (!empty($scriptProperties['dateDay']) && $delta > 0) {
    switch (date('Y-m-d', $date)) {
        case date('Y-m-d'):
            $day = $modx->lexicon('da_today');
            break;
        case date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') - 1, date('Y'))):
            $day = $modx->lexicon('da_yesterday');
            break;
        case date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') + 1, date('Y'))):
            $day = $modx->lexicon('da_tomorrow');
            break;
        default:
            $day = null;
    }
    if ($day) {
        $format = str_replace("day", preg_replace("#(\w{1})#", '\\\${1}', $day), $scriptProperties['dateDay']);

        return date($format, $date);
    }
}

$month_arr = $modx->fromJSON($modx->lexicon('da_months'));
$m = date("n", $date);
$month = $month_arr[$m - 1];

$format = preg_replace("~(?<!\\\\)F~U", preg_replace('~(\w{1})~u', '\\\${1}', $month), $dateFormat);

return date($format, $date);