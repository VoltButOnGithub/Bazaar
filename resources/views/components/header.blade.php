<nav class="bg-gray-700 p-4">
    <div class="container mx-auto flex justify-between items-center">
        <div class="text-white text-lg font-bold">
            <a href="{{ url('/') }}">{{__('global.bazaar')}}</a>
        </div>

        <div class="flex space-x-4">
            <a href="{{ route('login') }}" class="text-gray-300 hover:text-white flex items-center px-4 py-3 rounded-md text-sm font-medium">
                <x-heroicon-s-user class="w-5 h-5 mr-2"/>
                {{__('global.login')}}
            </a>
            <a href="{{ route('advertisement.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white flex items-center px-4 py-3 rounded-md text-sm font-medium">
                <x-heroicon-s-pencil-square class="w-5 h-5 mr-2"/>
                {{__('global.create_ad')}}
            </a>
        </div>
    </div>
</nav>