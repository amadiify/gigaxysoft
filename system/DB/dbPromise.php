<?php 

namespace Moorexa;

use PDO;
use utility\Classes\BootMgr\Manager as BootMgr;

/**
 * @package Moorexa DB Promise
 * @author  Ifeanyi Amadi
 * @version 0.0.1
 */

// promise class
class DBPromise
{
    public  $getPacked = [];
    public  $errors    = [];
    public  $hasError  = false;
    public  static $pdo       = null;
    public  static $loopid = null;
    private $_loopid = 0;
    private $pdoInstance = null;
    public  $usePDO = true;
    private $fetch_records = null;
    public  $error = null;
    public  $ok = true;
    private $_rows = 0;
    public  $table = null;
    private $bindData;
    private $identity;
    private $fetchClass = null;
    public  $allowSlashes = false;

    // fetch methods..
    private static $fetchMethods = [
        'named'     => FETCH_NAMED,
        'assoc'     => FETCH_ASSOC,
        'array'     => FETCH_ASSOC,
        'lazy'      => FETCH_LAZY,
        'num'       => FETCH_NUM,
        'both'      => FETCH_BOTH,
        'obj'       => FETCH_OBJ,
        'bound'     => FETCH_BOUND,
        'column'    => FETCH_COLUMN,
        'class'     => FETCH_CLASS,
        'into'      => FETCH_INTO,
        'group'     => FETCH_GROUP,
        'unique'    => FETCH_UNIQUE,
        'func'      => FETCH_FUNC,
        'keypair'   => FETCH_KEY_PAIR,
        'classtype' => FETCH_CLASSTYPE,
        'serialize' => FETCH_SERIALIZE,
        'propslate' => FETCH_PROPS_LATE 
    ];

    // set fetch mode
    public function setFetchMode()
    {
        if ($this->usePDO)
        {
            self::$fetchMethods = [
                'named'     => PDO::FETCH_NAMED,
                'assoc'     => PDO::FETCH_ASSOC,
                'array'     => PDO::FETCH_ASSOC,
                'lazy'      => PDO::FETCH_LAZY,
                'num'       => PDO::FETCH_NUM,
                'both'      => PDO::FETCH_BOTH,
                'obj'       => PDO::FETCH_OBJ,
                'bound'     => PDO::FETCH_BOUND,
                'column'    => PDO::FETCH_COLUMN,
                'class'     => PDO::FETCH_CLASS,
                'into'      => PDO::FETCH_INTO,
                'group'     => PDO::FETCH_GROUP,
                'unique'    => PDO::FETCH_UNIQUE,
                'func'      => PDO::FETCH_FUNC,
                'keypair'   => PDO::FETCH_KEY_PAIR,
                'classtype' => PDO::FETCH_CLASSTYPE,
                'serialize' => PDO::FETCH_SERIALIZE,
                'propslate' => PDO::FETCH_PROPS_LATE 
            ];
        }
    }

    public static function hasFetchMethod($method)
    {
        if (isset(self::$fetchMethods[$method]))
        {
            return true;
        }

        return false;
    }

    // static set function
    public function set($name, $data)
    {
        if ($name == 'getPacked')
        {
            $this->getPacked = $data;
        }
        else
        {
            $this->{$name} = $data;
        }
    }

    // Clean up after use.
    public static function cleanUp($promise)
    {
        $promise->errors = [];
        $promise->hasError = false;
    }

    // set pdo
    public function setpdoInstance($instance)
    {
        $this->pdoInstance = $instance;
    }

    // keys
    public function keys()
    {
        if ( count($this->getPacked) > 0)
        {
            return array_keys($this->getPacked);
        }
    }

    // send
    public function send()
    {
        return $this;
    }

    // values
    public function values()
    {
        if ( count($this->getPacked) > 0)
        {
            return array_values($this->getPacked);
        }
    }

    // row
    public function row()
    {
        if (count($this->getPacked) > 0)
        {
            return toObject($this->getPacked);
        }

        return null;
    }

    public function __call($name, $args)
    {
        if (isset(self::$fetchMethods[$name]))
        {
            $config = isset($args[0]) ? $args[0] : [];

            if (is_callable($config))
            {
                $this->reset();

                $data = [];

                while($fetch = $this->___fetch(self::$fetchMethods[$name], $name))
                {
                   call_user_func($config, $fetch);
                   $data[] = $fetch;
                }

                $fetch = null;
                return $data;
            }

            return $this->___fetch(self::$fetchMethods[$name], $name, $config);
            
        }
        else
        {
            return false;
        }
    }

    private function ___fetch($fetchMode, $name, $config = [])
    {
        if (self::$loopid !== null)
        {
            $this->_loopid = 0;
            self::$loopid = null;
        }

        if ($this->pdoInstance != null)
        {
            $exec = $this->_loopid;
            static $all = [];

            if ($exec == 0)
            {
                if ($this->usePDO)
                {
                    $this->pdoInstance->execute();
                    $this->_rows = $this->pdoInstance->rowCount();
                }
                else
                {
                    $this->_rows = $this->pdoInstance->num_rows;
                }

                if ($name == 'class')
                {
                    $config = is_string($config) ? $config : 'Moorexa\dbPromise';

                    while($class = $this->pdoInstance->fetchAll($fetchMode, $config))
                    {
                        $all = $class;
                    }
                }
                elseif ($name == 'func')
                {
                    if (is_array($config) && count($config) == 0)
                    {
                        $config = [$this, '__fetchFunc'];
                    }

                    while($func = $this->pdoInstance->fetchAll($fetchMode, $config))
                    {
                        $all = $func;
                    }
                }
                elseif ($name == 'into')
                {
                    $config =  is_string($config) ? $config : 'Moorexa\dbPromise';
                    $config = new $config;
                    $this->pdoInstance->setFetchMode($fetchMode, $config);

                    foreach ($this->pdoInstance as $into)
                    {
                        $all[] = $into;
                    }
                }
                elseif ($name == 'bound' || $name == 'keypair')
                {
                    $bound = [];

                    $this->pdoInstance->setFetchMode($fetchMode, $bound);

                    foreach (self::$pdo as $b)
                    {
                        $all[] = $b;
                    }
                }
            }

            if ($this->usePDO == false)
            {
                if ($this->_rows == 1)
                {
                    $records = $this->getPacked;
                    $this->fetch_records = $fetchMode == 1 ? toObject($records) : $records;
                }
            }


            if (count($all) > 0)
            {
                $fetch = $all[$exec];
            }

            
            if ($name != 'class' && 
                $name != 'func'  && 
                $name != 'into'  && 
                $name != 'bound' &&
                $name != 'keypair')
            {
                if ($this->usePDO)
                {
                    $this->fetch_records = $this->pdoInstance->fetch($fetchMode);
                }
                else
                {
                    if ($this->_rows > 1)
                    {
                        $this->bind_array($this->pdoInstance, $records);
                        $this->pdoInstance->fetch();

                        $this->fetch_records = $fetchMode == 1 ? toObject($records) : $records;
                    }
                
                }

                $fetch = $this->fetch_records;
            }

            if ($this->usePDO)
            {
                // replace encoded entities
                if (is_array($fetch))
                {
                    array_walk($fetch, function($e, $i) use (&$fetch){
                        if (!$this->allowSlashes)
                        {
                            $e = stripslashes($e);
                        }
                        $fetch[$i] = html_entity_decode($e, ENT_QUOTES, 'UTF-8');
                    });
                }
                elseif (is_object($fetch))
                {
                    $toarr = toArray($fetch);
                    array_walk($toarr, function($e, $i) use (&$toarr){
                        if (!$this->allowSlashes)
                        {
                            $e = stripslashes($e);
                        }
                        $toarr[$i] = html_entity_decode($e, ENT_QUOTES, 'UTF-8');
                    });
                    $fetch = toObject($toarr);
                    $toarr = null;
                }
            }
            else
            {
                if (is_array($fetch))
                {
                    $toarr = $fetch;
                    array_walk($toarr, function($e, $i) use (&$toarr){
                        if (!$this->allowSlashes)
                        {
                            $e = stripslashes($e);
                        }
                        $toarr[$i] = html_entity_decode($e, ENT_QUOTES, 'UTF-8');
                    });
                    $fetch = $toarr;
                }
                elseif (is_object($fetch))
                {
                    $toarr = toArray($fetch);
                    array_walk($toarr, function($e, $i) use (&$toarr){
                        if (!$this->allowSlashes)
                        {
                            $e = stripslashes($e);
                        }
                        $toarr[$i] = html_entity_decode($e, ENT_QUOTES, 'UTF-8');
                    });
                    $fetch = toObject($toarr);
                }
            }
            

            if ($exec == $this->_rows)
            {
                $exec = 0;
                $this->_loopid = 0;
                $this->fetch_records = null;
                return false;
            }

            $this->_loopid++;

            return new DB\FetchRow($this, $fetch);
        }
            
        return false;
    }

    public function reset()
    {
        self::$loopid = 0;
        $this->_loopid = 0;
    }

    public function __fetchFunc()
    {
        
    }

    // bind query for mysqli
    public function bind_array($stmt, &$row)
    {
        $md = $stmt->result_metadata();
        $params = array();
        while($field = $md->fetch_field()) {
            $params[] = &$row[$field->name];
        }

        call_user_func_array(array($stmt, 'bind_result'), $params);
    }

	// get magic method
	public function __get($name)
	{
        $packed = $this->getPacked;
        
        if (isset($packed[$name]))
        {   
            return stripslashes($packed[$name]);
        }
        elseif (method_exists($this, $name))
        {
            return $this->{$name}();
        }
        else
        {
            $this->errors[] = $name.' doesn\'t exists.';
            $this->hasError = true;
        }

        return false;
    }

    // get table info
    public function getTableInfo(&$primary)
    {
        $table = DB::sql('DESCRIBE '.$this->table);

        if ($table->rows > 0)
        {
            $table->obj(function($row) use (&$primary){
                if ($row->Key == 'PRI')
                {
                    $primary = $row->Field;
                }
            });
        }
    }

    // from option 
    public function from($tableName, $identity=null)
    {
        // create a new db instance
        $promise = new DBPromise;

        $promise->table = $tableName;
        $promise->getPacked = $this->getPacked;
        $promise->bindData = $this->bindData;

        if ($identity !== null)
        {
            $promise->identity = $identity;
        }

        return $promise;
    }

    // set identity
    public function identity($key)
    {   
        $this->identity = $key;
        return $this;
    }
    
    // run update
    public function update($data=[], $where=null, $other=null)
    {
        if (is_null($where))
        {
            // get row
            $row = $this->row();

            if (!is_null($row))
            {   
                if ($this->identity == null)
                {
                    // get table info
                    $this->getTableInfo($pri);
                }
                else
                {
                    $pri = $this->identity;
                }

                $id = $row->{$pri};

                return DB::table($this->table)->update($data, $pri . ' = ?', $id);
            }

            return false;
        }
        else
        {
            if (is_null($other))
            {
                return DB::table($this->table)->update($data, $where);
            }
            else
            {
                $args = func_get_args();
                $table = DB::table($this->table);

                $db = call_user_func_array([$table, 'update'], $args);
                
                return $db->go();
            }
        }
    }

    // run insert
    public function insert($data=[])
    {
        $args = func_get_args();

        $table = DB::table($this->table);

        // insert
        return call_user_func_array([$table, 'insert'], $args)->go();
    }

    // run get
    public function get($gid=null, $where=null)
    {
        // get row
        $row = $this->row();

        if ($this->identity == null)
        {
            // get table info
            $this->getTableInfo($pri);
        }
        else
        {
            $pri = $this->identity;
        }

        if (is_null($row) && is_null($gid))
        {
            if (isset($this->bindData[$pri]))
            {
                $gid = intval($this->bindData[$pri]);
            }
        }
        elseif (!is_null($row))
        {
            if (isset($row->{$pri}))
            {
                $gid = is_null($gid) ? intval($row->{$pri}) : $gid;
            }
        }

        if (is_int($gid))
        {
            return DB::table($this->table)->get($pri . ' = ?', $gid);
        }
        elseif (is_string($gid) || is_array($gid))
        {
            $args = func_get_args();

            return call_user_func_array([DB::table($this->table), 'get'], $args)->go();
        }

        return $this;
    }

    // run delete
    public function pop($gid=null)
    {
        // get row
        $row = $this->row();

        if ($this->identity == null)
        {
            // get table info
            $this->getTableInfo($pri);
        }
        else
        {
            $pri = $this->identity;
        }

        $id = $row->{$pri};

        if (is_null($gid))
        {
            return DB::table($this->table)->delete($pri . ' = ?', $id);
        }
        elseif (!is_null($gid) && is_int($gid))
        {
            return DB::table($this->table)->delete($pri . ' = ?', $gid);
        }
        else
        {
            $args = func_get_args();
            return call_user_func_array([DB::table($this->table), 'delete'], $args)->go();
        }
    }

    // set bind data
    public function setBindData($bind)
    {
        $this->bindData = $bind;
    }

    // go
    public function go()
    {
        return $this;
    }

    public function has($column)
    {
        if (isset($this->getPacked[$column]))
        {
            return true;
        }
        
        return false;
    }

    // reduce function
    public function reduce($data)
    {
        if (is_callable($data))
        {
            $reduce = 0;

            $this->obj(function($row) use ($data, &$reduce){
                $reduce += call_user_func($data, $row);
            });

            return $reduce;
        }
        elseif (is_string($data))
        {
            $reduce = 0;

            $this->obj(function($row) use (&$reduce, $data){
                if ($row->has($data))
                {
                    $reduce += $row->{$data};
                }
            });

            return $reduce;
        }
    }

    // query method
    /**
     * @param $method could either be a string or array
     */
    public function query($loadFrom)
    {
        $classCaller = null;

        switch (gettype($loadFrom))
        {
            case 'string':
                // build method name 
                $method = 'query'.ucwords($loadFrom);
            break;

            case 'array':
                // get class name and method.
                list($className, $method) = $loadFrom;
                $method = 'query'.ucwords($method);

                // check class name
                $classCaller = $className; // here we assume $className is an object

                // but let's check if it's a string
                if (is_string($classCaller))
                {
                    // build singleton
                    $classCaller = BootMgr::singleton($classCaller);
                }
            break;
        }

        // get arguments
        $args = func_get_args();
        $args = array_splice($args, 1);
        array_unshift($args, $this);

        if (is_null($classCaller) || $classCaller === false)
        {
            $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 10);

            foreach ($trace as $traceArray)
            {
                // check if traceArray has a class
                if (isset($traceArray['class']))
                {
                    // check for class
                    $className = $traceArray['class'];

                    if ($className != 'Moorexa\DBPromise')
                    {
                        $classCaller = BootMgr::singleton($className);
                        break;
                    }
                }
            }

            $trace = null;
            $traceArray = null;
        }

        // check if method exists
        if (method_exists($classCaller, $method))
        {
            return call_user_func_array([$classCaller, $method], $args);
        }

        return $this;
    }

    // get values
    public function val($index)
    {
        $row = $this->row();

        // convert $row to array
        $row = toArray($row);

        // get values
        $values = array_values($row);

        if (is_int($index))
        {
            // return index 
            if ($index >= 0)
            {
                return $values[$index];
            }
        }

        if (isset($row[$index]))
        {
            return $row[$index];
        }

        return $values;
    }

    // get keys
    public function key($index)
    {
        $row = $this->row();

        // convert $row to array
        $row = toArray($row);

        // get keys
        $keys = array_keys($row);
        
        if (is_int($index))
        {
            // return index 
            if ($index >= 0)
            {
                return $keys[$index];
            }
        }

        if (isset($row[$index]))
        {
            return $row[$index];
        }

        return $keys;
    }

    // get primary id
    public function primary()
    {
        static $tableInfo;
        
        if (!isset($tableInfo[$this->table]))
        {
            $tableInfo = [];

            // get primary key
            $this->getTableInfo($primary);

            // set primary key
            $tableInfo[$this->table] = $primary;
        }

        // return primary key
        if (isset($tableInfo[$this->table]))
        {
            $primary = $tableInfo[$this->table];
            
            // return primary key
            return $this->{$primary};
        }

        return null;
    }
}
