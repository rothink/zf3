<?php
/**
 * Created by PhpStorm.
 * User: rothink
 * Date: 20/05/18
 * Time: 21:27
 */

namespace Blog\Controller;


use Blog\Model\PostTable;
use Zend\Debug\Debug;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class BlogController extends AbstractActionController
{

    /**
     * @var PostTable
     */
    private $table;

    public function __construct(PostTable $table)
    {
        $this->table = $table;
    }

    public function indexAction()
    {
        $postTable = $this->table;

        return new ViewModel(
            [
                'posts' => $postTable->fetchAll()
            ]
        );
    }
}