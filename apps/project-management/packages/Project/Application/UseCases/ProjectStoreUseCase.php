<?php

namespace Project\Application\UseCases;

use Illuminate\Support\Facades\DB;
use Project\Domain\Entities\ProjectFactory;
use Project\Domain\Repositories\ProjectRepositoryInterface;
use Support\Domain\Rules\UserExistsRule;

/**
 * 登録 UseCase
 */
class ProjectStoreUseCase
{
    /**
     * @param ProjectRepositoryInterface $repository       repository
     * @param ProjectFactory             $factory          factory
     * @param UserExistsRule             $user_exists_rule user exists rule
     */
    public function __construct(
        private ProjectRepositoryInterface $repository,
        private ProjectFactory $factory,
        private UserExistsRule $user_exists_rule,
    ) {
    }

    /**
     * 登録処理
     *
     * @param  array $form 画面入力値
     * @return void
     */
    public function invoke(array $form)
    {
        DB::transaction(
            function () use ($form) {
                // Entity生成
                $entity = $this->factory->create($form);

                // ドメインチェック
                $this->user_exists_rule->validate($entity->assign_to->value());

                // 保存
                $this->repository->save($entity);
            }
        );
    }
}
