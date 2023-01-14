<?php

namespace Project\Presentation\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Routing\Redirector;
use Illuminate\Http\RedirectResponse;
use Project\Application\UseCases\ProjectCreateUseCase;
use Project\Application\UseCases\ProjectStoreUseCase;
use Project\Presentation\Requests\ProjectStoreRequest;
use Project\Presentation\Responses\ProjectCreateResponse;

/**
 * Project Create Controller
 */
class ProjectCreateController extends Controller
{
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
}
