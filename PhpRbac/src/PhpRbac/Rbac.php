<?php
namespace PhpRbac;

use \Jf;
use PhpRbac\Exceptions\ConfigurationException;

/**
 * @file
 * Provides NIST Level 2 Standard Role Based Access Control functionality
 *
 * @defgroup phprbac Rbac Functionality
 * @{
 * Documentation for all PhpRbac related functionality.
 */
class Rbac
{
    public function __construct($config = '')
    {
        if ((string)$config === 'unit_test') {
            require_once dirname(dirname(__DIR__)) . '/tests/database/database.config';
        } else {
            $adapter = isset($config['adapter']) ? $config['adapter'] : "pdo_sqlite";
            $host = isset($config['host']) ? $config['host'] : "localhost";
            $user = isset($config['user']) ? $config['user'] : "root";
            $pass = isset($config['pass']) ? $config['pass'] : "";
            $tablePrefix = isset($config['prefix']) ? $config['prefix'] : "phprbac_";
            $dbname =  isset($config['db_name']) ? $config['db_name'] : false;

            if(!$dbname){
                throw new ConfigurationException("db_name",$config['db_name']);
            }
        }

        require_once 'core/lib/Jf.php';

        $this->Permissions = Jf::$Rbac->Permissions;
        $this->Roles = Jf::$Rbac->Roles;
        $this->Users = Jf::$Rbac->Users;
    }

    public function assign($role, $permission)
    {
        return Jf::$Rbac->assign($role, $permission);
    }

    public function check($permission, $user_id)
    {
        return Jf::$Rbac->check($permission, $user_id);
    }

    public function enforce($permission, $user_id)
    {
        return Jf::$Rbac->enforce($permission, $user_id);
    }

    public function reset($ensure = false)
    {
        return Jf::$Rbac->reset($ensure);
    }

    public function tablePrefix()
    {
        return Jf::$Rbac->tablePrefix();
    }
}

/** @} */ // End group phprbac */
