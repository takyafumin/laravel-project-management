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
     * @param integer $per_page 1ページあたりの表示件数
     * @return Collection
     */
    public function search(array $condition, $page_number = 1, $per_page = self::PER_PAGE): Collection
    {
        $limit  = $per_page;
        $offset = $this->getOffset($page_number, $per_page);

        // Query
        $query = $this->projectModel->query();

        // Select
        $query->select(['id', 'title', 'status', 'assign_to']);

        // Order by
        $query->orderBy('id', 'asc');

        // Limit / Offset
        $query->limit($limit);
        $query->offset($offset);

        return $query->get();
    }
}
