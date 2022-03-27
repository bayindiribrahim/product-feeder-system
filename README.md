# product-feeder-system

### Installation

You can install the package via composer:

```bash
composer require bayindir/product-feeder-system
```
## Usage

### 1.1 Use with facade for all platforms

```php
<?php
include_once "vendor/autoload.php";

use Src\Concrete\CimriManager;
use Src\Concrete\FacebookManager;
use Src\Concrete\GoogleManager;
use Src\Facades\Platforms;

$products = [
    [
        "id" => 1,
        "name" => "productName",
        "category" => "categoryName",
    ],
    [
        "id" => 2,
        "name" => "productName2",
        "category" => "categoryName2",
    ],
    [
        "id" => 2,
        "name" => "productName3",
        "category" => "categoryName3",
    ]
];

$instance = new Platforms(new FacebookManager(), new CimriManager(), new GoogleManager());
return $instance->exporter($products);
```

### 1.2 Or use concretes for a specific platforms

```php
$instance = new FacebookManager(); //or CimriManager, or GoogleManager
return $instance->exportFile($products);
```
