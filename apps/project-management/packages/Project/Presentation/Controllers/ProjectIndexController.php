<?php

namespace Project\Presentation\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Routing\Redirector;
use Illuminate\Http\RedirectResponse;
use Project\Application\UseCases\ProjectCreateUseCase;
use Project\Application\UseCases\ProjectEditUseCase;
use Project\Application\UseCases\ProjectSearchUseCase;
use Project\Application\UseCases\ProjectShowUseCase;
use Project\Application\UseCases\ProjectStoreUseCase;
use Project\Application\UseCases\ProjectUpdateUseCase;
use Project\Presentation\Requests\ProjectSearchRequest;
use Project\Presentation\Requests\ProjectStoreRequest;
use Project\Presentation\Requests\ProjectUpdateRequest;
use Project\Presentation\Responses\ProjectCreateResponse;
use Project\Presentation\Responses\ProjectEditResponse;
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

    /**
     * 新規登録画面表示
     *
     * @param  ProjectCreateUseCase $use_case 新規登録画面表示UseCase
     * @return View|Factory 画面
     */
    public function create(
        ProjectCreateUseCase $use_case
    ) {
        // 担当者一覧取得
        $user_list = $use_case->invoke();

        // 画面表示
        return view(
            'project.create',
            [
                'page' => new ProjectCreateResponse($user_list)
            ]
        );
    }

    /**
     * 登録処理
     *
     * @param  ProjectStoreRequest $request  request
     * @param  ProjectStoreUseCase $use_case usecase
     * @return Redirector|RedirectResponse
     */
    public function store(
        ProjectStoreRequest $request,
        ProjectStoreUseCase $use_case
    ) {
        // 画面入力値取得
        $form = $request->toForm();

        // 登録処理
        $use_case->invoke($form);

        // 画面遷移
        return redirect(route('project.index'))
            ->with('message.success', '登録しました！');
    }

    /**
     * 編集画面表示
     *
     * @param  int $id ID
     * @param  ProjectEditUseCase $use_case 編集画面表示UseCase
     * @return View|Factory 画面
     */
    public function edit(
        int $id,
        ProjectEditUseCase $use_case
    ) {
        // 担当者一覧取得
        list($user_list, $project) = $use_case->invoke($id);

        // 画面表示
        return view(
            'project.edit',
            [
                'page' => new ProjectEditResponse($user_list, $project)
            ]
        );
    }

    /**
     * 更新処理
     *
     * @param  integer            $id       プロジェクトID
     * @param  ProjectUpdateUseCase $use_case 更新UseCase
     * @return Redirector|RedirectResponse
     */
    public function update(
        int $id,
        ProjectUpdateRequest $request,
        ProjectUpdateUseCase $use_case
    ) {
        // 画面入力値取得
        $form = $request->toForm();

        // 更新処理
        $use_case->invoke($id, $form);

        // 画面遷移
        return redirect(route('project.index'))
            ->with('message.success', '更新しました！');
    }
}
