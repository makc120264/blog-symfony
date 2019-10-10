<?php


namespace App\Controller;

use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    /**
     * @Route("post/{id}")
     * @param $id
     * @return Response
     */
    public function getPost($id)
    {
        $postData = $this->getDoctrine()
            ->getRepository(Post::class)
            ->findOneById($id);

        $result['id'] = $postData->getId();
        $result['title'] = $postData->getTitle();
        $result['slug'] = $postData->getSlug();
        $result['content'] = $postData->getContent();
        $result['author_email'] = $postData->getAuthorEmail();
        $result['published'] = $postData->getPublished();
        $result['comments'] = $postData->getComments();

        return $this->render('default/post/post.html.twig', $result);
    }

    /**
     * @Route("/", name="homepage")
     * @return Response
     */
    public function index()
    {
        $result = [];
        $posts = $this->getDoctrine()
            ->getRepository(Post::class)
            ->findAll();

        if (empty($posts)) {
            $result['content'] = 'No posts';
        } else {
            /** @var int $key */
            /** @var array $post */
            foreach ($posts as $key => $post) {
                $result[$key]['id'] = $post->getId();
                $result[$key]['title'] = $post->getTitle();
                $result[$key]['slug'] = $post->getSlug();
                $result[$key]['content'] = $post->getContent();
                $result[$key]['author_email'] = $post->getAuthorEmail();
                $result[$key]['published'] = $post->getPublished();
                $result[$key]['comments'] = $post->getComments();
            }
        }

        return $this->render('default/index.html.twig', ['articles' => $result]);
    }
}