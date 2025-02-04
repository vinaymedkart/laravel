<?php

namespace App\Repositories\Interfaces;

use App\Models\User;

interface UserRepositoryInterface
{
    public function create(array $data): ?User;
    public function findByEmail(string $email): ?User;
}

// can you help me to get migration command and  migration containing fields like

// Category 
// id,
// name

// Molecule 
// id,
// name, 
// is_active boolean,
// SoftDelete of Eloquent
// created_by id , created_at date, 
// deleted_by id, deleted_at date, 
// updated_by id, updated_at date

// ProductMolecule
// Product_id, (foreign key)
// Molecule_id (foreign key)

// DraftProduct
// id int,
// name string,
// sales_price float, 
// mrp float, 
// manufacturer_name string, 
// is_banned boolean, 
// SoftDelete of Eloquent,
// is_discontinued boolean, 
// is_assured boolean, 
// is_refridged boolean, 
// created_by id, updated_by id, deleted_by id, 
// deleted_at date, created_at date, updated_at date
// category_id int
// product_status ENUM['Draft','Published', 'Unpublished']
// ws_code int nullable,
// combination [array of molecule names]
// published_by, published_at,
// unpublished_by, unpublished_at

// PublishProduct
// Ws_code int,
// name string,
// sales_price float, 
// mrp float, 
// manufacturer_name string, 
// is_banned boolean, 
// SoftDelete of Eloquent,
// is_discontinued boolean, 
// is_assured boolean, 
// is_refridged boolean, 
// created_by id, updated_by id, deleted_by id, 
// deleted_at date, created_at date, updated_at date
// category_id int,
// combination [array of molecule names]
