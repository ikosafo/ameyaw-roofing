<?php

class Report extends tableDataObject{

    const TABLENAME = 'inspections';

    public static function listSales($salesFrom, $salesTo) {
        global $healthdb;

        $startDateTime = "$salesFrom 00:00:00";
        $endDateTime = "$salesTo 23:59:59";

        $getList = "SELECT * FROM `inspections` i JOIN `invoice` v ON i.inspectionid = v.inspectionid
         where i.`status` = 1 AND i.`paymentPeriod` BETWEEN '$startDateTime' AND '$endDateTime' ORDER BY i.`updatedAt` DESC";
        $healthdb->prepare($getList);
        $resultList = $healthdb->resultSet();
        return $resultList;
    }
}