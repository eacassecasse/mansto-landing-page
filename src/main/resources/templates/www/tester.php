
<?php
require_once '../../../app/domain/model/Product.php';
require_once '../../../app/domain/model/ProductValidity.php';
require_once '../../../app/domain/model/Storage.php';
require_once '../../../app/domain/model/StoredProduct.php';
require_once '../../../app/domain/model/Supplier.php';
require_once '../../../app/domain/model/SupplierPrice.php';
require_once '../../../app/domain/model/SupplierProduct.php';
require_once '../../../app/domain/model/User.php';
require_once '../../../app/core/config.php';
require_once '../../../app/core/ConnectionFactory.php';
require_once '../../../app/domain/repository/Generic.php';
require_once '../../../app/domain/repository/GenericRepository.php';
require_once '../../../app/domain/repository/ProductRepository.php';
require_once '../../../app/domain/repository/ProductValidityRepository.php';
require_once '../../../app/domain/repository/StorageRepository.php';
require_once '../../../app/domain/repository/StoredProductRepository.php';
require_once '../../../app/domain/repository/SupplierPriceRepository.php';
require_once '../../../app/domain/repository/SupplierProductRepository.php';
require_once '../../../app/domain/repository/SupplierRepository.php';
require_once '../../../app/domain/repository/UserRepository.php';
require_once '../../../app/domain/service/ProductService.php';
require_once '../../../app/domain/service/ProductValidityService.php';
require_once '../../../app/domain/service/StorageService.php';
require_once '../../../app/domain/service/StoredProductService.php';
require_once '../../../app/domain/service/SupplierPriceService.php';
require_once '../../../app/domain/service/SupplierProductService.php';
require_once '../../../app/domain/service/SupplierService.php';
require_once '../../../app/domain/service/UserService.php';
require '../../../app/domain/exception/BusinessException.php';
require '../../../app/domain/exception/EntityNotFoundException.php';


header("Content-Type: application/json; charset= UTF-8");

set_exception_handler(function (BusinessException $ex) {
    $problem = handleBusinessException($ex);
    $problem->setStatus(http_response_code());
    $jsonProblem = json_encode($problem);
    
    echo $jsonProblem;
});

$username = "eacassecasse@servor.com";
$password = "@Pas1swod23";

$user = new User();
$user->setEmail($username);
$user->setPassword($password);

$service = new UserService();
$repository = new UserRepository();

$productsJSON = json_encode($service->findAll());

var_dump($productsJSON);

class Book {
    
}

$book = new Book();
$book->id = 101;
$book->label = "Lorem Ipsum";

$jsonData = json_encode($book);

echo $jsonData ."\n";





