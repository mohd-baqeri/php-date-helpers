<?php
    /**
     * Summary of greg_to_jalali
     * @param mixed $gy
     * @param mixed $gm
     * @param mixed $gd
     * @param mixed $mod
     * @return int[]|string
     */
    function greg_to_jalali($gy, $gm, $gd, $mod = ''): array|string
    {
        $g_d_m = array(0, 31, 59, 90, 120, 151, 181, 212, 243, 273, 304, 334);
        if ($gy > 1600) {
            $jy = 979;
            $gy -= 1600;
        } else {
            $jy = 0;
            $gy -= 621;
        }
        $gy2 = ($gm > 2) ? ($gy + 1) : $gy;
        $days = (365 * $gy) + ((int) (($gy2 + 3) / 4)) - ((int) (($gy2 + 99) / 100)) + ((int) (($gy2 + 399) / 400)) - 80 + $gd + $g_d_m[$gm - 1];
        $jy += 33 * ((int) ($days / 12053));
        $days %= 12053;
        $jy += 4 * ((int) ($days / 1461));
        $days %= 1461;
        if ($days > 365) {
            $jy += (int) (($days - 1) / 365);
            $days = ($days - 1) % 365;
        }
        $jm = ($days < 186) ? 1 + (int) ($days / 31) : 7 + (int) (($days - 186) / 30);
        $jm = ($jm < 10) ? '0' . $jm : $jm; // Ensure month is two digits
        $jd = 1 + (($days < 186) ? ($days % 31) : (($days - 186) % 30));
        $jd = ($jd < 10) ? '0' . $jd : $jd; // Ensure day is two digits
        return ($mod == '') ? array($jy, $jm, $jd) : $jy . $mod . $jm . $mod . $jd;
    }


    /**
     * Summary of jalali_to_greg
     * @param mixed $jy
     * @param mixed $jm
     * @param mixed $jd
     * @param mixed $mod
     * @return array<int|mixed>|string
     */
    function jalali_to_greg($jy, $jm, $jd, $mod = ''): array|string
    {
        if ($jy > 979) {
            $gy = 1600;
            $jy -= 979;
        } else {
            $gy = 621;
        }
        $days = (365 * $jy) + (((int) ($jy / 33)) * 8) + ((int) ((($jy % 33) + 3) / 4)) + 78 + $jd + (($jm < 7) ? ($jm - 1) * 31 : (($jm - 7) * 30) + 186);
        $gy += 400 * ((int) ($days / 146097));
        $days %= 146097;
        if ($days > 36524) {
            $gy += 100 * ((int) (--$days / 36524));
            $days %= 36524;
            if ($days >= 365)
                $days++;
        }
        $gy += 4 * ((int) ($days / 1461));
        $days %= 1461;
        if ($days > 365) {
            $gy += (int) (($days - 1) / 365);
            $days = ($days - 1) % 365;
        }
        $gd = $days + 1;
        foreach (array(0, 31, (($gy % 4 == 0 and $gy % 100 != 0) or ($gy % 400 == 0)) ? 29 : 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31) as $gm => $v) {
            if ($gd <= $v)
                break;
            $gd -= $v;
        }

        $gm = ($gm < 10) ? '0' . $gm : $gm; // Ensure month is two digits
        $gd = ($gd < 10) ? '0' . $gd : $gd; // Ensure day is two digits
        return ($mod == '') ? array($gy, $gm, $gd) : $gy . $mod . $gm . $mod . $gd;
    }


    /**
     * Summary of is_valid_jalali_date
     * @param mixed $jy
     * @param mixed $jm
     * @param mixed $jd
     * @return bool
     */
    function is_valid_jalali_date($jy, $jm, $jd): bool
    {
        $g_date = jalali_to_greg($jy, $jm, $jd);
        $j_date = greg_to_jalali($g_date[0], $g_date[1], $g_date[2]);
        return ($j_date[0] == $jy && $j_date[1] == $jm && $j_date[2] == $jd);
    }


    /**
     * Summary of get_last_day_of_jalali_month
     * @param mixed $jy
     * @param mixed $jm
     * @return int|bool
     */
    function get_last_day_of_jalali_month($jy, $jm): bool|int
    {
        if ($jm >= 1 && $jm <= 6)
            return 31;
        if ($jm >= 7 && $jm <= 11)
            return 30;
        if ($jm == 12) {
            return is_valid_jalali_date($jy, 12, 30) ? 30 : 29;
        }
        return false; // invalid month
    }


    /**
     * Summary of get_jalali_month_text
     * @param mixed $jm
     * @return bool|string
     */
    function get_jalali_month_text($jm): bool|string
    {
        $jmText = '';
        switch ($jm) {
            case 1:
                $jmText = 'حمل';
                break;
            case 2:
                $jmText = 'ثور';
                break;
            case 3:
                $jmText = 'جوزا';
                break;
            case 4:
                $jmText = 'سرطان';
                break;
            case 5:
                $jmText = 'اسد';
                break;
            case 6:
                $jmText = 'سنبله';
                break;
            case 7:
                $jmText = 'میزان';
                break;
            case 8:
                $jmText = 'عقرب';
                break;
            case 9:
                $jmText = 'قوس';
                break;
            case 10:
                $jmText = 'جدی';
                break;
            case 11:
                $jmText = 'دلو';
                break;
            case 12:
                $jmText = 'حوت';
                break;
            default:
                $jmText = false; // invalid month
                break;
        }
        return $jmText;
    }
?>
