<?php

namespace Project\Presentation\Controllers;

use App\Http\Controllers\Controller;
use Project\Application\UseCases\ProjectSearchUseCase;
use Project\Application\UseCases\ProjectShowUseCase;
use Project\Presentation\Requests\ProjectSearchRequest;
use Project\Presentation\Responses\ProjectSearchResponse;
use Project\Presentation\Responses\ProjectShowResponse;

/**
 * Project Index Controller
 */
class ProjectIndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  ProjectSearchRequest $request  リクエスト
     * @param  ProjectSearchUseCase $use_case 検索ユースケース
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index(
        ProjectSearchRequest $request,
        ProjectSearchUseCase $use_case
    ): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory {

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
        return view(
            'project.index',
            [
                'page' => new ProjectSearchResponse(
                    $condition,
                    $page_number,
                    $list,
                    $total_count,
                    $request->path()
                ),
            ]
        );
    }

    /**
     * 詳細表示
     *
     * @param  integer            $id       プロジェクトID
     * @param  ProjectShowUseCase $use_case 詳細表示ユースケース
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function show(
        int $id,
        ProjectShowUseCase $use_case
    ): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory {

        // 詳細データ取得
        $project = $use_case->invoke($id);

        // 画面表示
        return view(
            'project.show',
            [
                'page' => new ProjectShowResponse($project),
            ]
        );
    }
}
