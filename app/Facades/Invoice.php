<?php
namespace App\Facades;

class Invoice{
    public function companyName(){
        return 'ABC Pvt Ltd' ;
    }
    public function currentDate(){
        return \Carbon\Carbon:: now( )->format( 'Y-m-d' ) ;   
    }
}