<?php
require_once 'models/model.php';
class productController
{
     public $productModel;
     function __construct()
     {
          $this->productModel = new productModel();
     }
     function listProduct()
     {
          $allProduct = $this->productModel->getAllProduct();
          require_once 'views/listProduct.php';
     }
}
?>