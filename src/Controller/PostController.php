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
                $result['id'] = $post->getId();
                $result['title'] = $post->getTitle();
                $result['slug'] = $post->getSlug();
                $result['content'] = $post->getContent();
                $result['author_email'] = $post->getAuthorEmail();
                $result['published'] = $post->getPublished();
                $result['comments'] = $post->getComments();
            }
        }

        return $this->render('default/index.html.twig', $result);
    }
}