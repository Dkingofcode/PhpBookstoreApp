<?php  

use Bookstore\Domain\Book;
use Bookstore\Domain\Customer;
use Bookstore\Domain\Customer\Basic;
use Bookstore\Exceptions\ExceededMaxAllowedException;
use Bookstore\Exceptions\InvalidIdException;

use Bookstore\Utils\Config;

// require_once __DIR__ . '/Book.php';
// require_once __DIR__ . '/Customer.php';

function checkIfValid(Customer $customer, array $books): bool {
    return $customer->getAmountToBorrow() >= count($books);
    }
    

function autoloader($classname){
    $lastSlash = strpos($classname, '\\') + 1;
    $classname = substr($classname, $lastSlash);
    $directory = str_replace('\\', '/', $classname);
    $filename = __DIR__ . '/src/' . $directory . 'php';
    require_once($filename);
}
spl_autoload_register('autoloader');

$book1 = new Book("1984", "George Orwell", 9785267006323, 12);
$book2 = new Book("To Kill a Mockingbird", "Harper Lee", 9780061120084, 2);

//$customer1 = new Customer(1, 'John', 'Doe', 'johndoe@mail.com');
//$customer2 = new Customer(2, 'Mary', 'Poppins', 'mp@mail.com');
// $customer1 = new Customer(3, 'John', 'Doe', 'johndoe@mail.com');
// $customer2 = new Customer(null, 'Mary', 'Poppins', 'mp@mail.com');
// $customer3 = new Customer(7, 'James', 'Bond', '007@mail.com');
// $customer1 = new Basic(5, 'John', 'Doe', 'johndoe@mail.com');
// var_dump(checkIfValid($customer1, [$book1])); // ok
// $customer2 = new Customer(7, 'James', 'Bond', 'james@bond.com');
// var_dump(checkIfValid($customer2, [$book1])); // fails



function createBasicCustomer($id)
{
try {
echo "\nTrying to create a new customer.\n";
return new Basic($id, "name", "surname", "email");
} catch (InvalidIdException $e) {
     echo "You cannot provide a negative id. \n";
}catch(ExceededMaxAllowedException $e){
     echo "No more customers are allowed. \n";
  
}catch (Exception $e){
 echo "Something happened when creating the basic customer: " . $e->getMessage() . "\n";
} finally {
echo "End of function.\n";
}
}


$percentage = 0.16;
$addTaxes = function (array &$book, $index) use (&$percentage) {
if (isset($book['price'])) {
$book['price'] += round($percentage * $book['price'], 2);
}
};

array_walk($books, $addTaxes, 0.16);
var_dump($books);


$percentage = 100000;
array_walk($books, $addTaxes, 0.16);
var_dump($books);
    


//$config = new Config();
$dbConfig = Config::getInstance()->get('db');
$db = new PDO(
    'mysql:host=127.0.0.1;dbname=bookstore',
    $dbConfig['user'],
    $dbConfig['password']
);
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
//var_dump($dbConfig);


createBasicCustomer(1);
createBasicCustomer(-1);
createBasicCustomer(55);
?>