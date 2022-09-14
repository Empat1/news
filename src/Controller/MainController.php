<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\News;
use App\Entity\User;
use App\Form\CommentFormType;
use App\Form\NewsFormType;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Session\Session;


class MainController extends AbstractController
{

    #[Route('/', name: 'app_main')]
    public function index(ManagerRegistry $doctrine, Request $request): Response
    {
        $session = $request->getSession();
        if (!$session->isStarted()) {
            $session->start();
        }

        $name = $session->get('name') ?? null;

        $news = $doctrine->getRepository(News::class)->getLastNews();

        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'news' => $news,
            'user_name' => $name
        ]);
    }


}
