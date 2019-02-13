<?php
/**
 * Created by PhpStorm.
 * User: williamdelrosario
 * Date: 2019-02-13
 * Time: 13:54
 */

namespace Process;

use SalariesCsvReader;
use SalaryServices;
use Writer\CsvFileWriter;

/**
 * Class Process
 * @package Process
 */
class Process
{
    /**
     * Start reading inputs and creat a csv
     * @throws \Exception
     */
    public function start()
    {
        $curDir = __DIR__;
        $sourceDir = $curDir.DIRECTORY_SEPARATOR.'Source'.DIRECTORY_SEPARATOR;

        //Get reader
        $salariesReader = new SalariesCsvReader($sourceDir);

        //Get writer
        $csvWriter = new CsvFileWriter();

        //Get services
        $services = new SalaryServices();

        //Open up file handlers
        $processHandle = fopen(
            __DIR__
            .DIRECTORY_SEPARATOR
            .'Output'
            .DIRECTORY_SEPARATOR
            .'salariesOutput'
            .date('Ymd')
            .'.csv',
            'w+'
        );

        //Write csv header
        $csvWriter->writeHeader($processHandle);
        $salaries = $salariesReader->getSalaries();

        foreach ($salaries as $skey => $sval) {
            foreach ($sval as $keySal => $valSal) {
                $csvWriter->writeLine(
                    $processHandle,
                    $sval['salaryId'],
                    $sval['first_name'],
                    $sval['last_name'],
                    $services->getMonthName(),
                    $services->getSalaryPaymentDate(),
                    $services->getBonusPaymentDate(),
                    $services->getMonthsToBePayed()
                );
            }
        }
    }
}
