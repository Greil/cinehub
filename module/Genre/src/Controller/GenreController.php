<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Genre\Controller;

use Genre\Entity\Genre;
use Genre\Form\AddGenreForm;
use Genre\Form\EditGenreForm;
use Genre\Service\GenreService;
use Zend\Http\Request;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class GenreController extends AbstractActionController
{

    /** @var GenreService */
    private $genreService;

    /** @var AddGenreForm */
    private $addGenreForm;

    /** @var EditGenreForm  */
    private $editGenreForm;

    public function __construct(
        GenreService $genreService,
        AddGenreForm $addGenreForm,
        EditGenreForm $editGenreForm
    ) {
        $this->genreService  = $genreService;
        $this->addGenreForm  = $addGenreForm;
        $this->editGenreForm = $editGenreForm;
    }


    public function indexAction()
    {
        return new ViewModel(
            [
                'genres' => $this->genreService->getAllGenres()
            ]
        );
    }

    public function addAction()
    {
        /** @var Request $request */
        $request = $this->getRequest();

        if ($request->isPost()) {
            $this->addGenreForm->setData($request->getPost());

            if ($this->addGenreForm->isValid()) {
                /** @var Genre $genre */
                $genre = $this->addGenreForm->getData();
                $this->genreService->create($genre);

                return $this->redirect()->toRoute('genre');
            }
        }

        return new ViewModel(
            [
                'form' => $this->addGenreForm
            ]
        );
    }

    public function editAction()
    {
        $genreId = (int) $this->params()->fromRoute('id');
        $genre   = $this->genreService->getGenreById($genreId);

        if (null === $genre) {
            return $this->redirect()->toRoute('genre');
        }

        /** @var Request $request */
        $request = $this->getRequest();
        $this->editGenreForm->bind($genre);

        if ($request->isPost()) {
            $this->editGenreForm->setData($request->getPost());

            if ($this->editGenreForm->isValid()) {
                /** @var Genre $genre */
                $genre = $this->editGenreForm->getData();
                $this->genreService->edit($genre);
                return $this->redirect()->toRoute('genre');
            }
        }

        return new ViewModel(
            [
                'form' => $this->editGenreForm,
                'id'   => $genre->getId()
            ]
        );
    }

    public function deleteAction()
    {
        $genreId = (int) $this->params()->fromRoute('id');
        $genre   = $this->genreService->getGenreById($genreId);

        /** @var Request $request */
        $request = $this->getRequest();

        if ($request->isPost()) {
            $delete = $request->getPost('del', 'Non');

            if ($delete == 'Oui') {
                $this->genreService->delete($genre);
                return $this->redirect()->toRoute('genre');
            }
        }

        return new ViewModel(
            [
                'id'    => $genreId,
                'genre' => $genre
            ]
        );
    }
}
