<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('プロジェクト新規登録') }}
        </h2>
    </x-slot>


    <div class="pt-4 pb-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-start">
                <button
                    class="btn-to-back bg-white hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded"
                    data-url="{{ route('project.index') }}">
                    戻る
                </button>
            </div>
        </div>
    </div>

    <!-- component -->
    <div class="pt-4 pb-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="max-w-2xl mx-auto py-4">
                    <form method="POST" action="{{ route('project.store') }}">
                        @csrf
                        <div>
                            <x-label for="title" value="プロジェクト名" />
                            <input type="text" id="title" name="title" value="{{ old('title') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="プロジェクト名を入力してください" required>
                        </div>

                        <div class="mt-4">
                            <x-label for="description" value="プロジェクト詳細" />
                            <textarea id="description" name="description" rows="4"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="プロジェクト内容を入力してください">{{ old('description') }}</textarea>
                        </div>

                        <div class="mt-4">
                            <x-label for="status" value="状態" />
                            <span
                                class="py-1 px-3 rounded-full {{ App\Types\ProjectStatus::iconStyle(App\Types\ProjectStatus::NEW->value) }}">
                                {{ App\Types\ProjectStatus::NEW->label() }}
                            </span>
                        </div>

                        <div class="mt-4">
                            <x-label for="assign_to" value="担当者" />
                            <select id="assign_to" name="assign_to"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @foreach ($page->user_list as $user)
                                    <option value="{{ $user->id }}"
                                        {{ old('assign_to') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex justify-end mt-7">
                            <button
                                class="btn-do-store bg-green-500 hover:bg-green-700 text-white font-semibold py-2 px-4 border border-green-500 rounded"
                                type="submit" data-url="{{ route('project.store') }}">
                                登録する
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // 戻るボタン
        const buttonBack = document.getElementsByClassName('btn-to-back');
        Array.from(buttonBack).forEach(function(element) {
            element.addEventListener('click', function() {
                window.location.href = this.dataset.url;
            });
        });
    </script>
</x-app-layout>
