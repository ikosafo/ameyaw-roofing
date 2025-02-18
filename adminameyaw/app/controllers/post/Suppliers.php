<?php

class Suppliers extends PostController
{
   

    public function addSuppliers() {
        $listCategories = Product::listCategories();
        $this->view("suppliers/addSuppliers", ['listCategories' => $listCategories]); 
    }


    public function editSuppliers() {
        $dbid = $_POST['dbid'];
        $listCategories = Product::listCategories();
        $supplierDetails = Supplier::supplierDetails($dbid);
        $this->view("suppliers/editSuppliers", 
            [
                'listCategories' => $listCategories,
                'supplierDetails' => $supplierDetails
            ]
        ); 
    }


    public function listSuppliers() {
        $listSuppliers = Supplier::listSuppliers();
        $this->view("suppliers/listSuppliers",[
            'listSuppliers' => $listSuppliers
        ]); 
    }


    public function saveSuppliers()
    {
        $supplierName = $_POST['supplierName'];
        $emailAddress = $_POST['emailAddress'];
        $phoneNumber = $_POST['phoneNumber'];
        $businessAddress = $_POST['businessAddress'];
        $productCategory = $_POST['productCategory'];
        $notes = $_POST['notes'];
        $uuid = $_POST['uuid'];
        Supplier::saveSupplier(
            $supplierName,$emailAddress,$phoneNumber,$businessAddress,$productCategory,$notes,$uuid
        );
    }


    public function deleteSupplier() {
        $dbid = $_POST['dbid'];
        Supplier::deleteSupplier($dbid);
    }


    public function viewSupplier() {
        $dbid = $_POST['dbid'];
        $supplierDetails = Supplier::supplierDetails($dbid);
        $this->view("suppliers/viewSupplier", 
            ['supplierDetails' => $supplierDetails]
        ); 
    }


    public function viewProducts() {
        $dbid = $_POST['dbid'];
        $listProducts = Supplier::listProducts($dbid);
        $this->view("suppliers/viewProducts", 
            [
                'listProducts' => $listProducts,
                'dbid' => $dbid
            ]
        ); 
    }



}
 