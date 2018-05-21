<?php
/**
 * Created by PhpStorm.
 * User: rothink
 * Date: 20/05/18
 * Time: 22:12
 */

namespace Blog\Model;


use Zend\Db\Exception\RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;

class PostTable
{
    private $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway)
    {
       $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        return $this->tableGateway->select();
    }

    public function save(Post $post)
    {
        $data = [
            'title' => $post->title,
            'content' => $post->content
        ];

        $id = (int) $post->id;

        if($id === 0) {
            $this->tableGateway->insert($data);
            return;
        } else {
            $this->tableGateway->update($data, ['id' => $id]);
        }
    }

    public function find($id)
    {
        $id = (int) $id;
        $rowSet = $this->tableGateway->select(['id' => $id]);
        $row = $rowSet->current();

        if(!$row) {
            throw new RuntimeException(sprintf('Não foi possível achar o item'));
        }

        return $row;
    }

    public function delete($id)
    {
        $this->tableGateway->delete(['id' => $id]);
    }
}