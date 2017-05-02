<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\NewsTable;
use Application\Form\NewsForm;
use Application\Model\News;

class NewsController extends AbstractActionController
{

    protected $newsTalbe;

    public function __construct()
    {}

    public function indexAction()
    {
        $view = new ViewModel();
        
        return $view;
    }

    public function listAction()
    {
        $paginator = $this->getNewsTalbe()->fetchAll();
        
        $view = new ViewModel();
        $view->setTemplate('application/news/list.phtml');
        
        $view->setVariable('paginator', $paginator);
        
        return $view;
    }

    public function addAction()
    {
        $form = new NewsForm();
        
        $form->get('submit')->setValue('Add');
        
        $request = $this->getRequest();
        
        if ($request->isPost()) {
            
            $news = new News();
            
            $form->setInputFilter($news->getInputFilter());
            
            $form->setData($request->getPost());
            
            if ($form->isValid()) {
                
                $news->exchangeArray($form->getData());
                
                $this->getNewsTalbe()->saveNews($news);
                
                return $this->redirect()->toRoute('news'); // 或者使用URL$this->redirect()->toUrl('/news/list');
            }
        }
        
        return array(
            'form' => $form
        );
    }

    public function editAction()
    {
        echo 'NewsController editAction';
        
        exit();
    }

    public function deleteAction()
    {
        echo 'NewsController deleteAction';
        
        exit();
    }

    public function getNewsTalbe()
    {
        if (! $this->newsTalbe) {
            
            $sm = $this->getServiceLocator();
            
            $this->newsTalbe = $sm->get('Application\Model\NewsTable');
        }
        
        return $this->newsTalbe;
    }
}