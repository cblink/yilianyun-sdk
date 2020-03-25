<h1 align="center"> yilianyun-sdk-laravel </h1>

<p align="center"> .</p>


## Installing

```shell
$ composer require cblink/yilianyun-sdk-laravel -vvv
```

## Usage

```
use Cblink\Yilianyun\Application;

$config = [
  // 登录后打开 https://dev.10ss.net/admin/listapp ，点击具体的应用进行查看
  'client_id' => 'your-client-id',
  'client_secret' => 'your-client-secret',
  
  'log' => [
      'name' => 'yilianyun',
  ],
  'http' => [
      'timeout' => 10,
      'base_uri' => 'https://open-api.10ss.net',
      'headers' => [
          'accept' => 'application/json',
      ],
  ],
  'cache' => [
      'namespace' => 'yilianyun',
  ],
];

$app = new Application($config);

// 添加打印机
$app->printer->addPrinter($machine_code, $msign, $print_name, $phone);

// 从账号下终端打印机
$app->printer->removePrinter($machine_code);

// 创建文本打印任务
$app->printer->createPrinterTask($machine_code, $content, $origin_id);

// 取消终端所有未打印任务
$app->printer->cancelUnprintTaskByMachineCode($machine_code);

// 获取终端状态
$app->printer->getMachineStatusByMachineCode($machine_code);

// 获取终端的打印任务状态
$app->printer->getStatusStatusByMachineCodeAndPlatformTaskNo($machine_code);

```

## Contributing

You can contribute in one of three ways:

1. File bug reports using the [issue tracker](https://github.com/cblink/yilianyun-sdk-laravel/issues).
2. Answer questions or fix bugs on the [issue tracker](https://github.com/cblink/yilianyun-sdk-laravel/issues).
3. Contribute new features or update the wiki.

_The code contribution process is not very formal. You just need to make sure that you follow the PSR-0, PSR-1, and PSR-2 coding guidelines. Any new code contributions must be accompanied by unit tests where applicable._

## License

LGPL