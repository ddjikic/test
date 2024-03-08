<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Websites') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="p-6 text-gray-900">


            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-md">
                    <div class="px-6 py-4 bg-white border-b border-gray-200 font-bold uppercase relative">
                        {{__('Website list')}}
                        <a href="{{ route('website.create') }}"
                           class="bg-blue-500 shadow-md text-sm text-white font-bold py-3 md:px-8 px-4 hover:bg-blue-400 rounded uppercase absolute right-1 top-1">
                            {{__('Add New website')}}</a></div>
                    <div class="p-6 bg-white border-b border-gray-200">
                        @if ($message = Session::get('success'))
                            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
                                <p class="font-bold"> {{ $message }}</p>
                            </div>
                        @endif
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">{{__('External id')}}</th>
                                <th scope="col" class="px-6 py-3">{{__('Name')}}</th>
                                <th scope="col" class="px-6 py-3">{{__('Domain')}}</th>
                                <th scope="col" class="px-6 py-3">{{__('Action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($websites as $row)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td  class="px-6 py-4">{{ $row->external_id }}</td>
                                    <td  class="px-6 py-4">{{ $row->name }}</td>
                                    <td  class="px-6 py-4">{{ $row->domain }}</td>

                                    <td  class="px-6 py-4">
                                        <form action="{{ route('website.destroy', $row->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')

                                            <a href="{{ route('website.show', $row->id) }}" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded"><i class="bi bi-eye"></i> {{__('Show')}}</a>

                                            <a href="{{ route('website.edit', $row->id) }}" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded"><i class="bi bi-pencil-square"></i> {{__('Edit')}}</a>

                                            <button type="submit" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded" onclick="return confirm(' {{__('Do you want to delete this?')}}');"><i class="bi
                                            bi-trash"></i> {{__('Delete')}}</button>
                                        </form>
                                    </td>

                                </tr>
                            @empty
                                <td colspan="4">
                                <span class="text-red-500">
                                    <strong>{{__('Oh no you do not have a website setup ?')}}</strong>
                                </span>
                                </td>
                            @endforelse
                            </tbody>
                        </table>

                    </div>
                    <div class="p-6 bg-white border-gray-200 text-right">
                        {{ $websites->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
