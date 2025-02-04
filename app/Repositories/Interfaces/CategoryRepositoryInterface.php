<?php

namespace App\Repositories\Interfaces;


interface CategoryRepositoryInterface
{
    public function create(array $data,$userId);
    public function getAllCategories();
}
// can you help me to get migration command and  migration containing fields like

// Category 
// id,
// name

// Molecule 
// id,
// name, 
// SoftDelete of Eloquent
// created_by id , created_at date, 
// deleted_by id, deleted_at date, 
// updated_by id, updated_at date

// ProductMolecule
// Product_id, (foreign key)
// Molecule_id (foreign key)

// Publish Product
// WS_code int,
// ProductName string,
// sales_price float, 
// mrp float, 
// manufacturer_name string, 
// is_banned boolean, 
// SoftDelete of Eloquent
// is_discontinued boolean, 
// is_assured boolean, 
// is_refridged boolean, 
// created_by id, updated_by id, deleted_by id, 
// deleted_at date, created_at date, updated_at date
// category_id int
