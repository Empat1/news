<?php

namespace App\Controller;

use App\Entity\News;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArchiveController extends AbstractController
{
    #[Route('/archive/{page}', name: 'archive_page')]
    public function archive(int $page, ManagerRegistry $doctrine, Request $request): Response
    {
        $session = $request->getSession();
        if (!$session->isStarted()) {
            $session->start();
        }

        $name = $session->get('name') ?? null;

        $news = $doctrine->getRepository(News::class)->getPageNews($page);

        $count = $doctrine->getRepository(News::class)->getCount();

        $k = $page;
        $j = $page;
        while (($j - $k) < 10) {
            $end_while = true;
            if ($k > 1) {
                $k --;
                $end_while = false;
            }
            if (($j * 10) <= $count) {
                $j++;
                $end_while = false;
            }
            if ($end_while) {
                break;
            }
        }

        $pages = array();
        for ($i = $k; $i <= $j; $i++) {
            $pages[] = $i;
        }

        return $this->render('main/archive.html.twig', [
            'controller_name' => 'MainController',
            'news' => $news,
            'user_name' => $name,
            'actual_page' => $page,
            'pages' => $pages
        ]);
    }
}
