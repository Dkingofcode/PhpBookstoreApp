<?php 



$loader = new Twig_Loader_Filesystem(__DIR__ . '/views');
$twig = new Twig_Environment($loader);

$bookModel = new BookModel(Db::getInstance());
$book = $bookModel->get(1);
$params = ['book' => $book];
echo $twig->loadTemplate('book.twig')->render($params);









?>