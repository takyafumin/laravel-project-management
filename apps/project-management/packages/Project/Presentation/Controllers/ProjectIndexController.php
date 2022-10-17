<?php

namespace Project\Presentation\Controllers;

use App\Http\Controllers\Controller;
use Project\Application\UseCases\ProjectSearchUseCase;
use Project\Presentation\Requests\ProjectSearchRequest;
use Project\Presentation\Responses\ProjectSearchResponse;

/**
 * Project Index Controller
 */
class ProjectIndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return string
     */
    public function index(
        ProjectSearchRequest $request,
        ProjectSearchUseCase $use_case
    ) {
        // 検索条件
        // ページ番号
        $condition   = $request->toCondition();
        $page_number = $request->getPageNumber();

        // 検索
        list($list, $total_count) = $use_case->invoke(
            $condition,
            $page_number,
            ProjectSearchResponse::PER_PAGE
        );

        // 画面表示
        return view('project.index', [
            'page' => new ProjectSearchResponse(
                $condition,
                $page_number,
                $list,
                $total_count,
                $request->path()
            ),
        ]);
    }
}
