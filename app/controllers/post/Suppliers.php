<?php

class Suppliers extends PostController
{
   
    public function addSuppliers() {
        $listCategories = Product::listCategories();
        $this->view("suppliers/addSuppliers", ['listCategories' => $listCategories]); 
    }

    public function editSuppliers() {
        $catid = $_POST['catid'];
        $categoryDetails = Product::categoryDetails($catid);
        $this->view("suppliers/editSuppliers", 
            ['categoryDetails' => $categoryDetails]
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


}
 