@extends('layouts.app')

@section('content')

<div class="bg-gray-50 dark:bg-gray-900">
    <div class="w-auto px-6 py-8 mx-auto md:h-screen lg:py-0">

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
