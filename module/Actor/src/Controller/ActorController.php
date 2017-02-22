<?php
/**
 * User: remi_k
 * Date: 20/02/2017
 * Time: 15:01
 */
declare(strict_types = 1);

namespace Actor\Controller;

use Actor\Entity\Actor;
use Actor\Form\AddActorForm;
use Actor\Form\EditActorForm;
use Actor\Service\ActorService;
use Zend\Http\Request;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ActorController extends AbstractActionController
{
    /** @var ActorService */
    private $actorService;

    /** @var AddActorForm */
    private $addActorForm;

    /** @var EditActorForm  */
    private $editActorForm;

    public function __construct(
        ActorService $actorService,
        AddActorForm $addActorForm,
        EditActorForm $editActorForm
    ) {
        $this->actorService  = $actorService;
        $this->addActorForm  = $addActorForm;
        $this->editActorForm = $editActorForm;
    }

    public function indexAction()
    {
        return new ViewModel(
            [
                'actors' => $this->actorService->getAllActors()
            ]
        );
    }

    public function addAction()
    {
        /** @var Request $request */
        $request = $this->getRequest();

        if ($request->isPost()) {
            $this->addActorForm->setData($request->getPost());

            if ($this->addActorForm->isValid()) {
                /** @var Actor $actor */
                $actor = $this->addActorForm->getData();
                $this->actorService->create($actor);
                return $this->redirect()->toRoute('actor');
            }
        }

        return new ViewModel(
            [
                'form' => $this->addActorForm
            ]
        );
    }

    public function editAction()
    {
        $actorId = (int) $this->params()->fromRoute('id');
        $actor   = $this->actorService->getActorById($actorId);

        if (null === $actor) {
            return $this->redirect()->toRoute('actor');
        }

        /** @var Request $request */
        $request = $this->getRequest();
        $this->editActorForm->bind($actor);

        if ($request->isPost()) {
            $this->editActorForm->setData($request->getPost());

            if ($this->editActorForm->isValid()) {
                /** @var Actor $actor */
                $actor = $this->editActorForm->getData();
                $this->actorService->edit($actor);
                return $this->redirect()->toRoute('actor');
            }
        }

        return new ViewModel(
            [
                'form' => $this->editActorForm,
                'id'   => $actor->getId()
            ]
        );
    }

    public function deleteAction()
    {
        $actorId = (int) $this->params()->fromRoute('id');
        $actor   = $this->actorService->getActorById($actorId);

        /** @var Request $request */
        $request = $this->getRequest();

        if ($request->isPost()) {
            $delete = $request->getPost('del', 'Non');

            if ($delete == 'Oui') {
                $this->actorService->delete($actor);
                return $this->redirect()->toRoute('actor');
            }
        }

        return new ViewModel(
            [
                'id'       => $actorId,
                'director' => $actor
            ]
        );
    }
}
