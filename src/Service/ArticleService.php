<?php
/**
 * Article service.
 */

namespace App\Service;

use App\Entity\Article;
use App\Entity\User;
use App\Repository\ArticleRepository;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

/**
 * Class ArticleService.
 */
class ArticleService implements ArticleServiceInterface
{
    /**
     * Items per page.
     *
     * @constant int
     */
    private const PAGINATOR_ITEMS_PER_PAGE = 10;

    /**
     * Constructor.
     *
     * @param ArticleRepository  $articleRepository Article repository
     * @param PaginatorInterface $paginator         Paginator
     */
    public function __construct(private readonly ArticleRepository $articleRepository, private readonly PaginatorInterface $paginator)
    {
    }

    /**
     * Get paginated list.
     *
     * @param int             $page   Page number
     * @param User|null       $author Author
     *
     * @return PaginationInterface<string, mixed> Paginated list
     */
    public function getPaginatedList(int $page, ?User $author = null): PaginationInterface
    {
        $queryBuilder = $author ? $this->articleRepository->queryByAuthor($author) : $this->articleRepository->queryAll();

        return $this->paginator->paginate(
            $queryBuilder,
            $page,
            self::PAGINATOR_ITEMS_PER_PAGE
        );
    }

    /**
     * Save entity.
     *
     * @param Article $article Article entity
     */
    public function save(Article $article): void
    {
        $this->articleRepository->save($article);
    }

    /**
     * Delete entity.
     *
     * @param Article $article Article entity
     */
    public function delete(Article $article): void
    {
        $this->articleRepository->delete($article);
    }
}
