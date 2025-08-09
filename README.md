# php-date-helpers
PHP Date Helpers: greg_to_jalali, jalali_to_greg date conversion and ...

    /**
     * Summary of greg_to_jalali
     * @param mixed $gy
     * @param mixed $gm
     * @param mixed $gd
     * @param mixed $mod
     * @return int[]|string
     */
     greg_to_jalali($gy, $gm, $gd, $mod = ''): array|string

    /**
     * Summary of jalali_to_greg
     * @param mixed $jy
     * @param mixed $jm
     * @param mixed $jd
     * @param mixed $mod
     * @return array<int|mixed>|string
     */
    jalali_to_greg($jy, $jm, $jd, $mod = ''): array|string

    /**
     * Summary of is_valid_jalali_date
     * @param mixed $jy
     * @param mixed $jm
     * @param mixed $jd
     * @return bool
     */
     is_valid_jalali_date($jy, $jm, $jd): bool
     
    /**
     * Summary of get_last_day_of_jalali_month
     * @param mixed $jy
     * @param mixed $jm
     * @return int|bool
     */
     get_last_day_of_jalali_month($jy, $jm): bool|int

     /**
     * Summary of get_jalali_month_text
     * @param mixed $jm
     * @return bool|string
     */
     get_jalali_month_text($jm): bool|string
     
