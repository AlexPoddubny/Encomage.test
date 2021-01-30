<?php
    
    
    namespace App\Models;
    
    
    use App\Model;

    class User extends Model
    {
        const TABLE = 'users';
        
        const COLUMNS = ' (
            id INT UNSIGNED NOT NULL AUTO_INCREMENT,
            first_name VARCHAR(100) NOT NULL,
            last_name VARCHAR(100) NOT NULL,
            email VARCHAR(100) NOT NULL,
            create_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            update_date TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY (id)
        )';
        
    }