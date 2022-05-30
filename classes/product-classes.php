<?php

class Product extends Db {

    private $imagePth;
    private $productName;
    private $price;
    private $productDesc;
    private $productType;
    private $category;

    public function __construct($imagePth, $productName, $price, $productDesc, $productType, $category){
        $this->imagePth = $imagePth;
        $this->productName = $productName;
        $this->price = $price;
        $this->productDesc = $productDesc;
        $this->productType = $productType;
        $this->category = $category;
    }

    public function increasePrdct(){

        if ($this->emptyInput() == false){
            header("location: ../addproduct.php?error=emptyinput");
            exit();
        }

        $this-> addProduct();
    }

    
    // Checks the admin fill all the spaces
    private function emptyInput(){
        $result;
        if(empty($this->imagePth) || empty($this->productName) || empty($this->price) || empty($this->productDesc) || empty($this->productType) || empty($this->category)){
            $result = false;
        }
        else{
            $result = true;
        }

        return $result;
    }

    
    private function addProduct(){
        $stmt = $this->connect()->prepare("INSERT INTO product (products_image_pth, products_name, products_price, products_desc, products_type, products_category) VALUES (?, ?, ?, ?, ?, ?);");

        // Checks is there any statement or sql error
        if(!$stmt->execute(array($this->imagePth, $this->productName, $this->price, $this->productDesc, $this->productType, $this->category))){
            $stmt = null;
            header("location: ../addproduct.php?error=stmtfaild");
            exit();
        }
        $stmt = null;
    }

    public static function searchProduct($searchKey){
        // Checks if the input empty or not
        if(empty($searchKey)){
            $stmt = null;
            header("location: ../editproduct.php?error=emptyinput");
            exit();
        }
        
        $db = new Db();
        $stmt = $db->connect()->prepare("SELECT * FROM product WHERE products_name = ?;");
        
        // Checks is there any statement or sql error
        if(!$stmt->execute(array($searchKey))){
            $stmt = null;
            header("location: ../editproduct.php?error=stmtfaild");
            exit();
        }
        
        // Checking that if we have serial users if we have more than one or 0 throw an error
        if($stmt->rowCount() <= 0){
            $stmt = null;
            header("location: ../editproduct.php?error=stmtfaild");
            exit();
        }

        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $products=$products[0];
        session_start();
        $_SESSION["p_productsId"] = $products["products_id"];
        $_SESSION["p_imagePth"] = $products["products_image_pth"];
        $_SESSION["p_productName"] = $products["products_name"];
        $_SESSION["p_price"] = $products["products_price"];
        $_SESSION["p_productDesc"] = $products["products_desc"];
        $_SESSION["p_productType"] = $products["products_type"];
        $_SESSION["p_category"] = $products["products_category"];
        $stmt = null;
    }

    public static function updateProduct($productsId, $imagePth, $productName, $price, $productDesc, $productType, $category){
        // Checks if the inputs empty or not
        if(empty($imagePth) || empty($productName) || empty($price) || empty($productDesc) || empty($productType) || empty($category)){
            $stmt = null;
            header("location: ../editproduct.php?error=emptyinput");
            exit();
        }

        $db = new Db();
        $stmt = $db->connect()->prepare("UPDATE product SET products_image_pth = ?, products_name = ?, products_price = ?, products_desc = ?, products_type = ?, products_category = ? WHERE products_id = $productsId;");
        
        // Checks is there any statement or sql error
        if(!$stmt->execute(array($imagePth, $productName, $price, $productDesc, $productType, $category))){
            $stmt = null;
            header("location: ../editproduct.php?error=stmtfaild");
            exit();
        }
        
        // Checking that if we have serial users if we have more than one or 0 throw an error
        if($stmt->rowCount() <= 0){
            $stmt = null;
            header("location: ../editproduct.php?error=stmtfaild");
            exit();
        }
        $stmt = null;
    }

    public static function deleteProduct($productsId){
        // Checks if the inputs empty or not
        if(empty($productsId)){
            $stmt = null;
            header("location: ../deleteproduct.php?error=emptyinput");
            exit();
        }

        $db = new Db();
        $stmt = $db->connect()->prepare("DELETE FROM product WHERE products_id = ?;");
        
        // Checks is there any statement or sql error
        if(!$stmt->execute(array($productsId))){
            $stmt = null;
            header("location: ../deleteproduct.php?error=stmtfaild");
            exit();
        }
        
        // Checking that if we have serial users if we have more than one or 0 throw an error
        if($stmt->rowCount() <= 0){
            $stmt = null;
            header("location: ../deleteproduct.php?error=stmtfaild");
            exit();
        }
        $stmt = null;
    }
}