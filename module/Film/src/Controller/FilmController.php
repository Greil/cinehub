<?php
/**
 * User: remi_k
 * Date: 21/02/2017
 * Time: 17:44
 */
declare(strict_types = 1);


namespace Film\Controller;


use Film\Entity\Film;
use Film\Form\AddFilmForm;
use Film\Form\EditFilmForm;
use Film\Service\FilmService;
use Zend\Http\Request;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class FilmController extends AbstractActionController
{
    /** @var FilmService */
    private $filmService;
    /** @var AddFilmForm */
    private $addFilmForm;
    /** @var EditFilmForm */
    private $editFilmForm;

    public function __construct(
        FilmService $filmService,
        AddFilmForm $addFilmForm,
        EditFilmForm $editFilmForm
    ) {
        $this->filmService  = $filmService;
        $this->addFilmForm  = $addFilmForm;
        $this->editFilmForm = $editFilmForm;
    }

    public function indexAction()
    {
        return new ViewModel(
            [
                'films' => $this->filmService->getAllFilms()
            ]
        );
    }

    public function addAction()
    {
        /** @var Request $request */
        $request = $this->getRequest();

        if ($request->isPost()) {
            $this->addFilmForm->setData($request->getPost());

            if ($this->addFilmForm->isValid()) {
                /** @var Film $film */
                $film = $this->addFilmForm->getData();
                $this->filmService->create($film);
                return $this->redirect()->toRoute('film');
            }
        }

        return new ViewModel(
            [
                'form' => $this->addFilmForm
            ]
        );
    }

    public function editAction()
    {
        $filmId = (int) $this->params()->fromRoute('id');
        $film   = $this->filmService->getFilmById($filmId);

        if (null === $film) {
            return $this->redirect()->toRoute('film');
        }

        /** @var Request $request */
        $request = $this->getRequest();
        $this->editFilmForm->bind($film);

        if ($request->isPost()) {
            $this->editFilmForm->setData($request->getPost());

            if ($this->editFilmForm->isValid()) {
                /** @var Film $film */
                $film = $this->editFilmForm->getData();
                $this->filmService->edit($film);
                return $this->redirect()->toRoute('film');
            }
        }

        return new ViewModel(
            [
                'form' => $this->editFilmForm,
                'id'   => $film->getId()
            ]
        );
    }

    public function deleteAction()
    {
        $filmId = (int) $this->params()->fromRoute('id');
        $film   = $this->filmService->getFilmById($filmId);

        /** @var Request $request */
        $request = $this->getRequest();

        if ($request->isPost()) {
            $delete = $request->getPost('del', 'Non');

            if ($delete == 'Oui') {
                $this->filmService->delete($film);
                return $this->redirect()->toRoute('film');
            }
        }

        return new ViewModel(
            [
                'id'   => $filmId,
                'film' => $film
            ]
        );
    }
}
