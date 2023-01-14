<?php

namespace Project\Application\UseCases;

use Illuminate\Support\Facades\DB;
use Project\Domain\Entities\ProjectFactory;
use Project\Domain\Repositories\ProjectRepositoryInterface;
use Project\Domain\ValueObjects\AssignTo;
use Project\Domain\ValueObjects\Description;
use Project\Domain\ValueObjects\ProjectId;
use Project\Domain\ValueObjects\Title;
use Support\Domain\Rules\UserExistsRule;

/**
 * 更新 UseCase
 */
class ProjectUpdateUseCase
{
    /**
     * @param ProjectRepositoryInterface $repository       repository
     * @param UserExistsRule             $user_exists_rule user exists rule
     */
    public function __construct(
        private ProjectRepositoryInterface $repository,
        private UserExistsRule $user_exists_rule,
    ) {
    }

    /**
     * 更新処理
     *
     * @param  int $id ID
     * @param  array $form 画面入力値
     * @return void
     */
    public function invoke(int $id, array $form)
    {
        DB::transaction(
            function () use ($id, $form) {

                // リポジトリからEntity取得
                $project_id = new ProjectId($id);
                $entity = $this->repository->findById($project_id, true);

                // Entityに変更を反映
                $entity->editAttributes(
                    new Title($form['title']),
                    isset($form['description']) ? new Description($form['description']) : null,
                );
                $entity->assignTo(new AssignTo($form['assign_to']));

                // ドメインチェック
                $this->user_exists_rule->validate($entity->assign_to->value());

                // 保存
                $this->repository->save($entity);
            }
        );
    }
}
