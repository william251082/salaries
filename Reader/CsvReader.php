<?php
/**
 * Created by PhpStorm.
 * User: williamdelrosario
 * Date: 2019-02-13
 * Time: 14:18
 */

namespace Reader;

/**
 * Class CsvReader
 * @package Reader
 */
class CsvReader
{
    /**
     * @param array $needed
     * @param array $headerRow
     * @return array
     */
    protected function getColumnIndexes(array $needed, array $headerRow): array
    {
        $indexes = [];
        foreach ($headerRow as $i => $name) {
            if (in_array($name, $needed)) {
                $indexes[$name] = $i;
            }
        }

        return $indexes;
    }

    /**
     * @param array $indexes
     * @param array $dataRow
     * @param array $ignored
     * @return array
     */
    protected function getNewRow(array $indexes, array $dataRow, array $ignored = []): array
    {
        $newData = [];
        foreach ($indexes as $name => $indexVal) {
            if (in_array($name, $ignored)) {
                continue;
            }
            $newData[$name] = $dataRow[$indexVal];
        }

        return $newData;
    }
}
