<?php
/**
 * Created by PhpStorm.
 * User: williamdelrosario
 * Date: 2019-02-13
 * Time: 16:52
 */

class SalaryServices
{
    private function monthsToBePayed(): int
    {
        $currDate = getdate();
        $remainingMonths = 12 - $currDate['mon'];

        return $remainingMonths;
    }

    private function monthName(): string
    {
        $currDate = getdate();
        $monthName = $currDate['month'];

        return $monthName;
    }

    /**
     * @throws Exception
     */
    private function salaryPaymentDate()
    {
        $stringDateTime = ((array) new DateTime('last day of this month'))['date'];
        $date = substr($stringDateTime,0, 10);
        $day = substr($date,8, 2)-2;
        $dateForNewDate = substr($date,0, 8);
        $dateForWeekend = $dateForNewDate.$day;

        return $this->isWeekend($stringDateTime, $date, $dateForWeekend);
    }

    /**
     * @return false|int
     * @throws Exception
     */
    private function bonusPaymentDate()
    {
        $stringCurrDateTime = ((array) new DateTime('first day of this month'))['date'];
        $timestamp = strtotime($stringCurrDateTime." +14 day");
        $date = gmdate("Y-m-d", $timestamp);
        $dateForWeekend = date('Y-m-d', strtotime("next wednesday", strtotime($date)));

        return $this->isWeekend($stringCurrDateTime, $date, $dateForWeekend);
    }

    private function isWeekend($datetime, $date, $dateForWeekend)
    {
        $weekends = (date('N', strtotime($datetime)) >= 6);

        if ($weekends === false) {
            return $date;
        } else {
            return $dateForWeekend;
        }
    }

    /**
     * @return int
     */
    public function getMonthsToBePayed(): int
    {
        return $this->monthsToBePayed();
    }

    /**
     * @return string
     */
    public function getMonthName(): string
    {
        return $this->monthName();
    }

    /**
     * @return bool|string
     * @throws Exception
     */
    public function getSalaryPaymentDate()
    {
        return $this->salaryPaymentDate();
    }

    /**
     * @return false|int
     * @throws Exception
     */
    public function getBonusPaymentDate()
    {
        return $this->bonusPaymentDate();
    }
}
