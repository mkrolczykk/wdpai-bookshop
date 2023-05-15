<?php

class EmployeeListResp {

    private $employeeId;

    private $employeeName;

    private $employeeSurname;

    public function __construct($employeeId, $employeeName, $employeeSurname)
    {
        $this->employeeId = $employeeId;
        $this->employeeName = $employeeName;
        $this->employeeSurname = $employeeSurname;
    }

    public function getEmployeeId()
    {
        return $this->employeeId;
    }

    public function getEmployeeName()
    {
        return $this->employeeName;
    }

    public function getEmployeeSurname()
    {
        return $this->employeeSurname;
    }

}
