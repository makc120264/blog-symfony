<?php


namespace App\Controller;

use App\Entity\Post;
use App\Forms\PostForm;
use App\Repository\PostRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class PostController extends AbstractController
{

    private $postRepository;

    /**
     * PostController constructor.
     * @param PostRepository $postRepository
     */
    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * @Route("post/add")
     * @param Request $request
     * @param PostRepository $repository
     * @return Response
     * @throws Exception
     */
    public function addPost(Request $request, PostRepository $repository)
    {
        $post = new Post();
        $form = $this->createForm(PostForm::class, $post);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $lastPostId = $repository->getLastId();
            $post->setSlug($lastPostId);
            $post->setAuthorEmail('test@test.tst');

            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();
        }

        return $this->render('default/post/add-post.html.twig', ['form' => $form->createView()]);
    }

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
        $result['published'] = $postData->getPublishedAt();
        $result['comments'] = $postData->getComments();

        return $this->render('default/post/post.html.twig', $result);
    }

    /**
     * @Route("/", name="homepage")
     * @return Response
     */
    public function index()
    {
        $posts = $this->getDoctrine()
            ->getRepository(Post::class)
            ->findAll();

        return $this->render('default/index.html.twig', ['articles' => $posts, 'addPostSlug' => 'post/add']);
    }
}