@extends('layouts.app')

@section('content')

<div class="bg-gray-50 dark:bg-gray-900">
    <div class="w-auto px-6 py-8 mx-auto md:h-screen lg:py-0">

            <div class="w-full px-6 py-8 mx-auto">
                <div class="px-10 py-6 bg-white rounded-lg shadow-xl">
                    <div class="flex justify-center py-4 px-52">
                        <div class="text-xl bold">
                             {{ __(' Batch #'). $exportPatch->batch_number. __(' Form '). $company->name  }}
                        </div>
                    </div>
                    {{-- <form action="{{ route('create_batch') }}" method="POST">
                        @csrf --}}
                        <div class="row-auto mb-3">
                            <label for="number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                {{ __('Batch Number') }}
                            </label>

                            <div class="col-start-1 col-end-7">
                                <input disabled id="number" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('number') is-invalid @enderror" name="number" value="{{ $exportPatch->batch_number }}" required autocomplete="name" autofocus>
                            </div>
                        </div>

                        <div class="row-auto mb-3">
                            <label for="company" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">{{ __('Company') }}</label>
                            <input disabled id="company" name="company" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $company->name }}">
                            </input>
                        </div>


                        <div class="flex pt-8 flex-end sm:justify-end sm:pt-0">
                            <a href="{{ url('/batch_details/'.$exportPatch->id.'/export') }}" class="text-white bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800  rounded-lg text-sm px-4 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 ">
                                Export This Batch
                            </a>
                        </div>
                    {{-- </form> --}}
                </div>
            </div>

            <div class="relative overflow-x-auto overflow-y-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-center text-white uppercase bg-gray-900 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Code
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Type
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Batch Number
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($codes->count() > 0)
                            @foreach($codes as $code)
                                <tr class="text-center bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td  class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $code->code }}
                                    </td>

                                    <td class="px-6 py-4">
                                        {{ $code->type }}
                                    </td>

                                    <td class="px-6 py-4">
                                        @if ($code->status === 0)
                                            {{ __('Not Used') }}
                                            @else
                                            {{ __('Used') }}
                                        @endif
                                    </td>

                                    <td class="px-6 py-4">
                                        {{ $exportPatch->batch_number }}
                                    </td>

                                </tr>
                            @endforeach

                            @else
                            <tr><tr class="text-center bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td  class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ __('No Codes Available') }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ __('No Codes Available') }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ __('No Codes Available') }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ __('No Codes Available') }}
                                </td>

                            </tr>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
    </div>
</div>

@endsection
