<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <form action="http://127.0.0.1:8000/sendMessage" method="post">
                        <input type="hidden" name="user_id" class="form-control form-inline" id="user_id" value="{{ Auth::user()->id}}" />
                        <input type="text" name="content" class="form-control form-inline" id="content" />
                        <button type="submit">送出</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>