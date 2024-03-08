<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Website'). ' '.$website->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="p-6 text-gray-900">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-md">
                    <div class="px-6 py-4 bg-white border-b border-gray-200 font-bold uppercase relative">
                        {{__('Info')}}
                    </div>

                    <div class="p-6 bg-white border-b border-gray-200">

                        <div class="md:flex md:items-center mb-6">
                            <div class="md:w-1/3">
                                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
                                    {{__('Name')}}
                                </label>
                            </div>
                            <div class="md:w-2/3">
                                <div class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none
                                    focus:bg-white focus:border-purple-500">
                                    {{$website->name}}
                                </div>
                            </div>
                        </div>

                        <div class="md:flex md:items-center mb-6">
                            <div class="md:w-1/3">
                                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
                                    {{__('Domain')}}
                                </label>
                            </div>
                            <div class="md:w-2/3">
                                <div class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none
                                    focus:bg-white focus:border-purple-500">
                                    {{$website->domain}}
                                </div>
                            </div>
                        </div>


                        <div class="md:flex md:items-center mb-6">
                            <div class="md:w-1/3">
                                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
                                    {{__('Tracking')}}
                                </label>
                            </div>
                            <div class="md:w-2/3">
                                <textarea class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none
                                    focus:bg-white focus:border-purple-500"><script aync src="{{url('analytics.js')}}" data-web-track-id="{{$website->external_id}}"></script>
                                </textarea>
                            </div>
                        </div>


                    </div>
                    <div class="p-6 bg-white border-gray-200 text-right">
                        <a href="{{ route('website.index') }}"
                           class="bg-blue-500 shadow-md text-sm text-white font-bold py-3 md:px-8 px-4 hover:bg-blue-400 rounded uppercase">
                            &larr; {{__('Back')}}</a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
