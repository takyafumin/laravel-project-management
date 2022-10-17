<?php

namespace Project\Infra\Queries;

use App\Supports\Paginator;
use Illuminate\Support\Collection;
use Project\Application\Queries\ProjectSearchQueryInterface;
use Project\Infra\Models\Project;

/**
 * Project Search Query
 */
class ProjectSearchQuery implements ProjectSearchQueryInterface
{
    use Paginator;

    /**
     * @param Project $projectModel プロジェクト Eloquent Model
     */
    public function __construct(
        private Project $projectModel
    ) {
    }

    /**
     * 検索
     *
     * @param array $condition 検索条件
     * @param integer $page_number ページ番号
     * @param integer $per_page ページあたりの表示件数
     * @return Collection
     */
    public function search(array $condition, int $page_number, int $per_page): Collection
    {
        $limit  = $per_page;
        $offset = $this->getOffset($page_number, $per_page);

        // Query
        $query = $this->projectModel->query();

        // join
        $query->leftJoin('users', 'projects.assign_to', '=', 'users.id');

        // Select
        $query->select([
            'projects.id',
            'projects.title',
            'projects.status',
            'projects.assign_to',
            'users.name as user_name'
        ]);

        // Order by
        $query->orderBy('id', 'asc');

        // Limit / Offset
        $query->limit($limit);
        $query->offset($offset);

        return $query->get();
    }

    /**
     * 件数取得
     *
     * @param array $condition 検索条件
     * @return integer
     */
    public function count(array $condition): int
    {
        // Query
        $query = $this->projectModel->query();

        // join
        $query->leftJoin('users', 'projects.assign_to', '=', 'users.id');

        // Select
        $query->select(['projects.id']);

        return $query->count();
    }
}
