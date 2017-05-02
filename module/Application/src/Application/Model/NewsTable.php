<?php
namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Select;

class NewsTable
{

    protected $tableGateway;

    public function __construct(TableGateway $tg)
    
    {
        $this->tableGateway = $tg;
    }

    public function fetchAll()
    
    {
        $resultSet = $this->tableGateway->select();
        
        return $resultSet;
    }
}