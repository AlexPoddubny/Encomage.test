<?php
    
    
    namespace App;
    
    
    abstract class Model
    {
        const TABLE = '';
        const COLUMNS = '';
        
        public $id;
    
        public static function checkTable()
        {
            if (static::TABLE != '' && static::COLUMNS != '') {
                $db = Db::instance();
                $query = 'CREATE TABLE IF NOT EXISTS ' . static::TABLE . static::COLUMNS;
                return $db->query($query, static::class);
            }
            return null;
        }
        
        public static function findAll($param = [])
        {
            $db = Db::instance();
            $query = 'SELECT * FROM ' . static::TABLE;
            if ($param) {
                if (isset($param['column'])){
                    $query .= ' ORDER BY ' . $param['column'];
                    unset($param['column']);
                }
                if (isset($param['sort'])){
                    $query .= ' ' . $param['sort'];
                    unset($param['sort']);
                }
            }
            return $db->query(
                $query,
                static::class,
                $param
            );
        }
    
        public static function search($params)
        {
            $columns = [];
            $values = [];
            $dataSet = false;
            $query = 'SELECT * FROM ' . static::TABLE . ' WHERE ';
            foreach ($params as $title => $data){
                if ('where' == $title){
                    foreach ($data as $k => $v) {
                        if ($v != '') {
                            $dataSet = true; //первый набор данных в where
                            $columns[] = $k . ' LIKE :' . $k;
                            $values[':' . $k] = '%' . $v . '%';
                        }
                    }
                    $query .= implode(' AND ', $columns);
                }
                //теперь работаем с датами
                if ('date' == $title){
                    foreach ($data as $type => $dates){
                        //если одна из дат фильтра не пустая
                        if ('' != $dates['from'] || '' != $dates['to']){
                            //если набор данных уже есть - добавляем AND и сбрасываем признак
                            if ($dataSet) {
                                $query .= ' AND ';
                                $dataSet = false;
                            }
                            $dataSet = true; //очередной набор данных
                            if ('' == $dates['to']){
                                $query .= $type . ' > \'' . $dates['from'] . '\'';
                            } elseif ('' == $dates['from']){
                                $query .= $type . ' < \'' . $dates['to'] . '\'';
                            } else {
                                $query .= '(' . $type . ' BETWEEN \'' . $dates['from'] . '\' AND \'' . $dates['to'] . '\')';
                            }
                        }
                    }
                }
            }
            if ($dataSet) {
                //если хотя бы один набор данных для запроса есть - ищем.
                $db = Db::instance();
                return $res = $db->query(
                    $query,
                    static::class,
                    $values
                );
            }
            // иначе возвращаем false
            return $dataSet;
        }
        
        public function isNew($data)
        {
            return empty($data['id']);
        }
        
        public function insert($data)
        {
            $columns = [];
            $values = [];
            foreach ($data as $k => $v) {
                if ('id' == $k) {
                    continue;
                }
                $columns[] = $k;
                $values[':' . $k] = $v;
            }
            $sql = 'INSERT INTO ' . static::TABLE . ' (' .
                implode(',', $columns) . ') VALUE (' . implode(',', array_keys($values)) . ')';
            $db = Db::instance();
            if ($db->execute($sql, $values)) {
                return $db->lastInsertedId();
            };
        }
        
        public function update($data)
        {
            $columns = [];
            $values = [];
            $sql = 'UPDATE ' . static::TABLE . ' SET ';
            foreach ($data as $k => $v) {
                $columns[] = $k;
                $values[':' . $k] = $v;
                if ('id' == $k) {
                    continue;
                }
                $sql .= $k . '=:' . $k . ',';
            }
            $sql = substr($sql, 0, -1) . ' WHERE id=:id';
            $db = Db::instance();
            return $db->execute($sql, $values);
        }
        
        public function save($data)
        {
            if ($this->isNew($data)) {
                return $this->insert($data);
            } else {
                return $this->update($data);
            }
        }
        
        public static function findById($id)
        {
            $query = 'SELECT * FROM ' . static::TABLE . ' WHERE id = ' . $id;
            $db = Db::instance();
            $res = $db->query(
                $query,
                static::class
            );
            if ($res) {
                return $res[0];
            }
            return null;
        }
    }