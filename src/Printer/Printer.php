<?php

namespace Cblink\YilianyunSdk\Printer;

use Cblink\YilianyunSdk\Client;

class Printer extends Client
{
    public function addPrinter($machine_code, $msign, $print_name = '', $phone = '')
    {
        return $this->post('/printer/addprinter', compact('machine_code', 'msign', 'print_name', 'phone'));
    }

    public function removePrinter($machine_code)
    {
        return $this->post('/printer/addprinter', compact('machine_code'));
    }

    public function createPrinterTask($machine_code, $content, $origin_id)
    {
        return $this->post('/print/index', compact('machine_code', 'content', 'origin_id'));
    }

    public function cancelUnprintTaskByMachineCode($machine_code)
    {
        return $this->post('/print/index', compact('machine_code'));
    }

    public function getMachineStatusByMachineCode($machine_code)
    {
        return $this->post('/printer/getprintstatus', compact('machine_code'));
    }

    public function getStatusStatusByMachineCodeAndPlatformTaskNo($machine_code, $order_id)
    {
        return $this->post('/printer/getorderstatus', compact('machine_code', 'order_id'));
    }
}