<?php
    
    
    namespace App;
    
    
    use PDO;

    class Db
    {
        
        use Singleton;
        
        private $dbh;
        
        public function __construct()
        {
            $config = Config::instance()->data;
            try {
                $this->dbh = new PDO(
                    'mysql:host=' . $config['host'] .
                    ';dbname=' . $config['dbname'],
                    $config['user'],
                    $config['password']
                );
            } catch (\PDOException $e){
                throw $e;
            }
        }
    
        public function execute($sql, $param = [])
        {
            $sth = $this->dbh->prepare($sql);
            $res = $sth->execute($param);
            return $res;
        }
    
        public function query($sql, $class, $param = [])
        {
            $sth = $this->dbh->prepare($sql);
            $res = $sth->execute($param);
            if (false !== $res){
                return $sth->fetchAll(PDO::FETCH_CLASS, $class);
            }
            return [];
        }
    
        public function lastInsertedId()
        {
            return $this->dbh->lastInsertId();
        }
    
    }