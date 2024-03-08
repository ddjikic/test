<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit') }} {{$website->name}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="p-6 text-gray-900">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-md">
                    <div class="px-6 py-4 bg-white border-b border-gray-200 font-bold uppercase relative">
                        {{__('Website edit')}}
                        <a href="{{ route('website.index') }}"
                           class="bg-blue-500 shadow-md text-sm text-white font-bold py-3 md:px-8 px-4 hover:bg-blue-400 rounded uppercase absolute right-1 top-1">
                            &larr; {{__('Back')}}</a></div>
                    <form action="{{ route('website.update',$website) }}" method="post">
                        @csrf
                        @method("PUT")
                        <div class="p-6 bg-white border-b border-gray-200">
                            @if ($message = Session::get('success'))
                                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
                                    <p class="font-bold"> {{ $message }}</p>
                                </div>
                            @endif
                            <div class="mb-3 row">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                                    {{__('Name')}}
                                </label>
                                <input required
                                       class=" @error('name') border-red-500 text-gray-700 mb-3 @enderror shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                       id="name" name="name" value="{{ old('name' ,$website->name) }}">
                                @if ($errors->has('name'))
                                    <span class="text-red-500">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="mb-3 row">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="domain">
                                    {{__('Domain')}}
                                </label>
                                <input required minlength="8" maxlength="500" type="url"
                                       class=" @error('domain') border-red-500 text-gray-700 mb-3 @enderror shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                       id="domain" name="domain" value="{{ old('domain',$website->domain) }}">
                                @if ($errors->has('domain'))
                                    <span class="text-red-500">{{ $errors->first('domain') }}</span>
                                @endif
                            </div>

                        </div>
                        <div class="p-6 bg-white border-gray-200 text-right">
                            <input type="submit" class="bg-blue-500 shadow-md text-sm text-white font-bold py-3 md:px-8 px-4 hover:bg-blue-400 rounded uppercase"
                                   value="{{__('Update Website')}}">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
