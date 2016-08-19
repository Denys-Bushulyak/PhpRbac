<?php
/**
 * User: denys
 * Date: 19.08.16
 * Time: 11:40
 */

namespace PhpRbac\Exceptions;


use Exception;

class ConfigurationException extends Exception
{
    private $message_template = 'Configuration not correct. Expected %s to be filled';

    /**
     * ConfigurationException constructor.
     * @param string $fieldName
     */
    public function __construct($fieldName)
    {
        $this->message = sprintf($this->message_template, $fieldName);
    }
}