<?php
/**
 * User: remi_k
 * Date: 20/02/2017
 * Time: 15:01
 */
declare(strict_types = 1);

namespace Director\Controller;

use Director\Entity\Director;
use Director\Form\AddDirectorForm;
use Director\Form\EditDirectorForm;
use Director\Service\DirectorService;
use Zend\Http\Request;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class DirectorController extends AbstractActionController
{
    /** @var  DirectorService */
    private $directorService;

    /** @var AddDirectorForm */
    private $addDirectorForm;

    /** @var EditDirectorForm  */
    private $editDirectorForm;

    public function __construct(
        DirectorService $directorService,
        AddDirectorForm $addDirectorForm,
        EditDirectorForm $editDirectorForm
    ) {
        $this->directorService  = $directorService;
        $this->addDirectorForm  = $addDirectorForm;
        $this->editDirectorForm = $editDirectorForm;
    }

    public function indexAction()
    {
        return new ViewModel(
            [
                'directors' => $this->directorService->getAllDirectors()
            ]
        );
    }

    public function addAction()
    {
        /** @var Request $request */
        $request = $this->getRequest();

        if ($request->isPost()) {
            $this->addDirectorForm->setData($request->getPost());

            if ($this->addDirectorForm->isValid()) {
                /** @var Director $director */
                $director = $this->addDirectorForm->getData();
                $this->directorService->create($director);
                return $this->redirect()->toRoute('director');
            }
        }

        return new ViewModel(
            [
                'form' => $this->addDirectorForm
            ]
        );
    }

    public function editAction()
    {
        $directorId = (int) $this->params()->fromRoute('id');
        $director   = $this->directorService->getDirectorById($directorId);

        if (null === $director) {
            return $this->redirect()->toRoute('director');
        }

        /** @var Request $request */
        $request = $this->getRequest();
        $this->editDirectorForm->bind($director);

        if ($request->isPost()) {
            $this->editDirectorForm->setData($request->getPost());

            if ($this->editDirectorForm->isValid()) {
                /** @var Director $director */
                $director = $this->editDirectorForm->getData();
                $this->directorService->edit($director);
                return $this->redirect()->toRoute('director');
            }
        }

        return new ViewModel(
            [
                'form' => $this->editDirectorForm,
                'id'   => $director->getId()
            ]
        );
    }

    public function deleteAction()
    {
        $directorId = (int) $this->params()->fromRoute('id');
        $director   = $this->directorService->getDirectorById($directorId);

        /** @var Request $request */
        $request = $this->getRequest();

        if ($request->isPost()) {
            $delete = $request->getPost('del', 'Non');

            if ($delete == 'Oui') {
                $this->directorService->delete($director);
                return $this->redirect()->toRoute('director');
            }
        }

        return new ViewModel(
            [
                'id'       => $directorId,
                'director' => $director
            ]
        );
    }
}
