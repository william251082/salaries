<?php
/**
 * Created by PhpStorm.
 * User: williamdelrosario
 * Date: 2019-02-13
 * Time: 13:54
 */

use Reader\CsvReader;

class SalariesCsvReader extends CsvReader
{
    private $salaries = [];

    public function __construct(string $sourceDir)
    {
        $standardFile = 'sampleCsvToRead.csv';

        if ( ! file_exists($sourceDir.$standardFile)) {
            die('Missing CSV file');
        }

        if (($standardHandle = fopen($sourceDir.$standardFile, "r")) === false) {
            die('Cannot read CSV standard file');
        }

        $neededColumns = [
            'salaryId',
            'first_name',
            'last_name',
            'current_month',
            'salary_payment_date',
            'bonus_payment_date',
            'remaining_payment_months'
        ];

        $salaryIndex = [];

        // Read salary information from standard sheet(sampleCsvToRead.csv)
        $row = 0;
        while (($data = fgetcsv($standardHandle, 0, ",")) !== false) {
            //Skip header field
            if ($row === 0) {
                $row++;
                $salaryIndex = $this->getColumnIndexes($neededColumns, $data);
                continue;
            }

            $salaryId = $data[$salaryIndex['salaryId']];
            $newRow = $this->getNewRow($salaryIndex, $data);
            $this->salaries[$salaryId ] = $newRow;
        }
        fclose($standardHandle);
    }

    /**
     * Get salaries
     * @return array
     */
    public function getSalaries(): array
    {
        return $this->salaries;
    }
}
