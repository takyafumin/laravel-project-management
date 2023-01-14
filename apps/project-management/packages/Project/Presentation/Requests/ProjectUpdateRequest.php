<?php

namespace Project\Presentation\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Project Update Request
 */
class ProjectUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title'       => ['required', 'max:50'],
            'description' => ['max:255'],
            'assign_to'   => ['required'],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'title'       => 'プロジェクト名',
            'description' => 'プロジェクト詳細',
            'assign_to'   => '担当者',
        ];
    }

    /**
     * 画面入力値を返却する
     *
     * @return array
     */
    public function toForm(): array
    {
        return $this->all();
    }
}
