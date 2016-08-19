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
    public function __construct($_host, $db_name = null, $_user = null, $_password = null, $table_prefix = '')
    {
        if ((string)$_host === 'unit_test') {
            require_once dirname(dirname(__DIR__)) . '/tests/database/database.config';
        } else {
            $host = $_host;
            $user = $_user;
            $pass = $_password;
            $tablePrefix = $tablePrefix;
            $dbname = $db_name;
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
