<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('プロジェクト詳細') }}
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

                    <div>
                        <x-label for="title" value="プロジェクト名" />
                        {{ $page->project['title'] }}
                    </div>

                    <div class="mt-4">
                        <x-label for="description" value="プロジェクト詳細" />
                        {!! nl2br(e($page->project['description'])) !!}
                    </div>

                    <div class="mt-4">
                        <x-label for="status" value="状態" />
                        <span
                            class="py-1 px-3 rounded-full {{ App\Types\ProjectStatus::iconStyle($page->project['status']) }}">
                            {{ App\Types\ProjectStatus::create($page->project['status'])->label() }}
                        </span>
                    </div>

                    <div class="mt-4">
                        <x-label for="assign_to" value="担当者" />
                        {{ $page->project['user_name'] }}
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        const btns = document.getElementsByClassName('btn-to-back');
        Array.from(btns).forEach(function(element) {
            element.addEventListener('click',function() {
                window.location.href = this.dataset.url;
            });
        });
    </script>
</x-app-layout>
