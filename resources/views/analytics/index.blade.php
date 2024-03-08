<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Analytics') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="p-6 text-gray-900">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-md">
                    <div class="px-5 py-2 bg-white border-b border-gray-200   ">
                        <form action="{{ route('analytics.index') }}" method="get" class="flex place-content-center">
                            <div><select name="website" id="website">
                                    @foreach ($websites as $row)
                                        <option value="{{$row->id}}"
                                                @if(request()->website==$row->id)
                                                    selected="selected"
                                            @endif
                                        >{{$row->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="p-2"></div>
                            <div>
                                <div date-rangepicker id="dateRangePickerId" class="flex items-center">
                                    <div class="relative">
                                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                 viewBox="0 0 20 20">
                                                <path
                                                    d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                            </svg>
                                        </div>
                                        <input name="start" type="text" value="{{$start}}" datepicker-format="dd/mm/yyyy"
                                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        >
                                    </div>
                                    <span class="mx-4 text-gray-500">to</span>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                 viewBox="0 0 20 20">
                                                <path
                                                    d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                            </svg>
                                        </div>
                                        <input name="end" type="text" value="{{$end}}" datepicker-format="dd/mm/yyyy"
                                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        >
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button type="submit"
                                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"> {{__('Show')}}</button>
                            </div>
                        </form>
                    </div>

                    <div class="p-6 bg-white border-b border-gray-200">
                        @if($stats)
                            <div class="grid grid-cols-4 gap-4">
                                <div class="col-span-4"> <canvas id="Visits_per_day"></canvas></div>
                                <div class="col-span-2"> <canvas id="os_distribution"></canvas></div>
                                <div class="col-span-2">   <canvas id="browser_distribution"></canvas></div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        @if($stats)
        var Vdays = [
            @foreach($period as $dt)
                '{{$dt->format("Y-m-d")}}',
            @endforeach
        ]

        var visitsPerDay = {!! json_encode($stats['per_day']) !!};

        OSNames = {!! json_encode(array_keys($stats['os'])) !!}
            OSValues = {!! json_encode(array_values($stats['os'])) !!}

        browsers = {!! json_encode(array_keys($stats['browser'])) !!}
            browsersValues = {!! json_encode(array_values($stats['browser'])) !!}
        @endif
    </script>
</x-app-layout>

