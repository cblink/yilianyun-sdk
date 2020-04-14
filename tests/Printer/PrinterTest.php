<?php

namespace Cblink\Yilianyun\Test\Printer;

use Cblink\Yilianyun\Test\TestCase;
use Cblink\Yilianyun\Printer\Printer;

class PrinterTest extends TestCase
{
    /** @test */
    public function addPrinter()
    {
        $this->make(Printer::class, $data = [
            'machine_code' => 'test-machine_code',
            'msign' => 'test-msign',
            'print_name' => 'test-print_name',
            'phone' => 'test-phone',
        ])
            ->addPrinter('test-machine_code', 'test-msign', 'test-print_name', 'test-phone')
            ->assertPostUri('/printer/addprinter')
            ->assertPostFormParams($data);
    }

    /** @test */
    public function removePrinter()
    {
        $this->make(Printer::class, $data = [
            'machine_code' => 'test-machine_code',
        ])
            ->removePrinter('test-machine_code')
            ->assertPostUri('/printer/addprinter')
            ->assertPostFormParams($data);
    }

    /** @test */
    public function createPrinterTask()
    {
        $this->make(Printer::class, $data = [
            'machine_code' => 'test-machine_code',
            'content' => 'test-content',
            'origin_id' => 'test-origin_id',
        ])
            ->createPrinterTask('test-machine_code', 'test-content', 'test-origin_id')
            ->assertPostUri('/print/index')
            ->assertPostFormParams($data);
    }

    /** @test */
    public function cancelUnprintTaskByMachineCode()
    {
        $this->make(Printer::class, $data = [
            'machine_code' => 'test-machine_code',
        ])
            ->cancelUnprintTaskByMachineCode('test-machine_code')
            ->assertPostUri('/printer/cancelall')
            ->assertPostFormParams($data);
    }

    /** @test */
    public function getMachineStatusByMachineCode()
    {
        $this->make(Printer::class, $data = [
                'machine_code' => 'test-machine_code',
            ])
            ->getMachineStatusByMachineCode('test-machine_code')
            ->assertPostUri('/printer/getprintstatus')
            ->assertPostFormParams($data);
    }

    /** @test */
    public function getTaskStatusByMachineCodeAndPlatformTaskNo()
    {
        $this->make(Printer::class, $data = [
                'machine_code' => 'test-machine_code',
                'order_id' => 'test-order_id',
            ])
            ->getTaskStatusByMachineCodeAndPlatformTaskNo('test-machine_code', 'test-order_id')
            ->assertPostUri('/printer/getorderstatus')
            ->assertPostFormParams($data);
    }
}