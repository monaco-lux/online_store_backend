<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;

// all entries

$app->get('/products/all', function (Request $request, Response $response) {
    $sql = "SELECT * FROM product_endpoint";

    try
    {
      $db = new DB();
      $conn = $db->connect();

      $stmt = $conn->query($sql);
      $product = $stmt->fetchAll(PDO::FETCH_OBJ);

      $db = null;
      $response->getBody()->write(json_encode($product));
      return $response
        ->withHeader('content-type', 'application/json')
        ->withStatus(200);
    } catch (PDOException $e)
    {
      $error = ["message" => $e->getMessage()];
      $response->getBody()->write(json_encode($error));
      return $response
        ->withHeader('content-type', 'application/json')
        ->withStatus(500);
    }
});

// single entry only

$app->get('/products/{id}', function (Request $request, Response $response, array $args) {
    $id = $args['id'];
    $sql = "SELECT * FROM product_endpoint WHERE id = $id";

    try
    {
      $db = new DB();
      $conn = $db->connect();

      $stmt = $conn->query($sql);
      $product = $stmt->fetch(PDO::FETCH_OBJ);

      $db = null;
      $response->getBody()->write(json_encode($product));
      return $response
        ->withHeader('content-type', 'application/json')
        ->withStatus(200);
    } catch (PDOException $e)
    {
      $error = ["message" => $e->getMessage()];
      $response->getBody()->write(json_encode($error));
      return $response
        ->withHeader('content-type', 'application/json')
        ->withStatus(500);
    }
});

// add products

$app->post('/products/add', function (Request $request, Response $response, array $args) {
    $name = $request->getParam('name');
    $description = $request->getParam('description');
    $image = $request->getParam('image');
    $price = $request->getParam('price');
    $category_id = $request->getParam('category_id');

    $sql = "INSERT INTO product_endpoint (name,description,image,price,category_id) VALUES (:name, :description, :image, :price, :category_id)";

    try
    {
      $db = new DB();
      $conn = $db->connect();

      $stmt = $conn->prepare($sql);
      $stmt->bindParam(':name',$name);
      $stmt->bindParam(':description',$description);
      $stmt->bindParam(':image',$image);
      $stmt->bindParam(':price',$price);
      $stmt->bindParam(':category_id',$category_id);

      $result = $stmt->execute();

      $db = null;
      $response->getBody()->write(json_encode($result));
      return $response
        ->withHeader('content-type', 'application/json')
        ->withStatus(200);
    } catch (PDOException $e)
    {
      $error = ["message" => $e->getMessage()];
      $response->getBody()->write(json_encode($error));
      return $response
        ->withHeader('content-type', 'application/json')
        ->withStatus(500);
    }
});

// delete product
$app->delete('/products/delete/{id}', function (Request $request, Response $response, array $args) {
    $id = $args['id'];
    $sql = "DELETE FROM product_endpoint WHERE id = $id";

    try
    {
      $db = new DB();
      $conn = $db->connect();

      $stmt = $conn->prepare($sql);
      $result = $stmt->execute();

      $db = null;
      $response->getBody()->write(json_encode($result));
      return $response
        ->withHeader('content-type', 'application/json')
        ->withStatus(200);
    } catch (PDOException $e)
    {
      $error = ["message" => $e->getMessage()];
      $response->getBody()->write(json_encode($error));
      return $response
        ->withHeader('content-type', 'application/json')
        ->withStatus(500);
    }
});

?>
