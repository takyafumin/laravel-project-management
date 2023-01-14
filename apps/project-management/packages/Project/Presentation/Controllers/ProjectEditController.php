<?php

namespace Project\Presentation\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Routing\Redirector;
use Illuminate\Http\RedirectResponse;
use Project\Application\UseCases\ProjectEditUseCase;
use Project\Application\UseCases\ProjectUpdateUseCase;
use Project\Presentation\Requests\ProjectUpdateRequest;
use Project\Presentation\Responses\ProjectEditResponse;

/**
 * Project Edit Controller
 */
class ProjectEditController extends Controller
{
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
