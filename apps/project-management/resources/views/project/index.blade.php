<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('プロジェクト一覧') }}
        </h2>
    </x-slot>

    <!-- component -->
    <div class="py-12">
        <table class="min-w-max w-full table-auto">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">プロジェクトID</th>
                    <th class="py-3 px-6 text-left">プロジェクト</th>
                    <th class="py-3 px-6 text-center">状態</th>
                    <th class="py-3 px-6 text-center">担当者</th>
                    <th class="py-3 px-6 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @foreach ($page->list as $item)
                <tr class="border-b hover:bg-sky-200">
                    <td class="py-3 px-6 text-left">{{ $item->id }}</td>
                    <td class="py-3 px-6 text-left">{{ $item->title }}</td>
                    <td class="py-3 px-6 text-center">
                        <span class="py-1 px-3 rounded-full {{ App\Types\ProjectStatus::iconStyle($item->status) }}">{{
                            App\Types\ProjectStatus::create($item->status)->label() }}
                        </span>
                    </td>
                    <td class="py-3 px-6 text-center">{{ $item->user_name }}</td>
                    <td class="py-3 px-6 text-center">
                        <button
                            class="btn-to-detail bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded hover:cursor-pointer"
                            data-url="{{ route('project.show', $item->id) }}">
                            詳細
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $page->paginator->links() }}

    <script>
        const btns = document.getElementsByClassName('btn-to-detail');
        Array.from(btns).forEach(function(element) {
            element.addEventListener('click',function() {
                window.location.href = this.dataset.url;
            });
        });
    </script>
</x-app-layout>
