<?php

namespace Cblink\Yilianyun\Test\Printer;

use Cblink\Yilianyun\Test\TestCase;
use Cblink\Yilianyun\Printer\Printer;

class PrinterTest extends TestCase
{
    /** @test */
    public function addPrinter()
    {
        $this->make(Printer::class)
            ->addPrinter('test-machine_code', 'test-msign', 'test-print_name', 'test-phone')
            ->assertPostUri('/printer/addprinter')
            ->assertPostFormParams([
                'machine_code' => 'test-machine_code',
                'msign' => 'test-msign',
                'print_name' => 'test-print_name',
                'phone' => 'test-phone',
            ]);
    }

    /** @test */
    public function removePrinter()
    {
        $this->make(Printer::class)
            ->removePrinter('test-machine_code')
            ->assertPostUri('/printer/addprinter')
            ->assertPostFormParams([
                'machine_code' => 'test-machine_code',
            ]);
    }

    /** @test */
    public function createPrinterTask()
    {
        $this->make(Printer::class)
            ->createPrinterTask('test-machine_code', 'test-content', 'test-origin_id')
            ->assertPostUri('/print/index')
            ->assertPostFormParams([
                'machine_code' => 'test-machine_code',
                'content' => 'test-content',
                'origin_id' => 'test-origin_id',
            ]);
    }

    /** @test */
    public function cancelUnprintTaskByMachineCode()
    {
        $this->make(Printer::class)
            ->cancelUnprintTaskByMachineCode('test-machine_code')
            ->assertPostUri('/printer/cancelall')
            ->assertPostFormParams([
                'machine_code' => 'test-machine_code',
            ]);
    }

    /** @test */
    public function getMachineStatusByMachineCode()
    {
        $this->make(Printer::class)
            ->getMachineStatusByMachineCode('test-machine_code')
            ->assertPostUri('/printer/getprintstatus')
            ->assertPostFormParams([
                'machine_code' => 'test-machine_code',
            ]);
    }

    /** @test */
    public function getTaskStatusByMachineCodeAndPlatformTaskNo()
    {
        $this->make(Printer::class)
            ->getTaskStatusByMachineCodeAndPlatformTaskNo('test-machine_code', 'test-order_id')
            ->assertPostUri('/printer/getorderstatus')
            ->assertPostFormParams([
                'machine_code' => 'test-machine_code',
                'order_id' => 'test-order_id',
            ]);
    }
}