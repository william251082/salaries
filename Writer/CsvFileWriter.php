<?php
/**
 * Created by PhpStorm.
 * User: williamdelrosario
 * Date: 2019-02-13
 * Time: 13:54
 */

namespace Writer;

/**
 * Class CsvFileWriter
 * @package Writer
 */
class CsvFileWriter
{
    /**
     * @var array
     */
    private $fields = [
        'salaryId',
        'first_name',
        'last_name',
        'current_month',
        'salary_payment_date',
        'bonus_payment_date',
        'remaining_payment_months'
    ];

    /**
     * @param $handle
     */

    public function writeHeader($handle)
    {
        fputcsv($handle, $this->fields);
    }

    /**
     * @param $handle
     * @param $salaryId
     * @param $first_name
     * @param $last_name
     * @param $current_month
     * @param $salary_payment_date
     * @param $bonus_payment_date
     * @param $remaining_payment_months
     */

    public function writeLine(
        $handle, $salaryId, $first_name, $last_name, $current_month, $salary_payment_date, $bonus_payment_date, $remaining_payment_months
    )
    {
        fputcsv(
            $handle, [$salaryId, $first_name, $last_name, $current_month, $salary_payment_date, $bonus_payment_date, $remaining_payment_months]
        );
    }
}
