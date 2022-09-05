@extends('layouts.app')

@section('content')

<div class="bg-gray-50 dark:bg-gray-900">
    <div class="w-auto px-6 py-8 mx-auto md:h-screen lg:py-0">

        <div class="w-full px-6 py-8 mx-auto">
            <div class="px-10 py-6 bg-white rounded-lg shadow-xl">
                <form action="{{ route('create_company') }}" method="POST">
                    @csrf
                    <div class="row-auto mb-3">
                        <label for="number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Number of Codes') }}</label>

                        <div class="col-start-1 col-end-7">
                            <input id="number" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('number') is-invalid @enderror" name="number" value="{{ old('number') }}" required autocomplete="name" autofocus>

                            @error('number')
                                <span class="text-red-600" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row-auto mb-3">
                        <label for="company" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">{{ __('Company') }}</label>
                        <select id="company" name="company" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected>Choose a company</option>
                            @foreach($companies as $company)
                                @if (old('company') == $company->id)
                                    <option value="{{ $company->id }}" selected>{{ $company->name }}</option>
                                @else
                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('company')
                            <span class="text-red-600" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>


                    <div class="row-auto mb-3">
                        <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Code Type') }}</label>

                        <div class="col-start-1 col-end-7">
                            <input id="type" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('type') is-invalid @enderror" name="type" value="{{ old('type') }}" required autofocus>

                            @error('type')
                                <span class="text-red-600" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="flex pt-8 flex-end sm:justify-end sm:pt-0">
                        <button type="submit" class="text-white bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800  rounded-lg text-sm px-4 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 ">
                            Create Batch
                        </button>
                    </div>
                </form>
            </div>
        </div>
            <div class="relative overflow-x-auto overflow-y-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-center text-white uppercase bg-gray-900 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Batches
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Compnay
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                # of Codes
                            </th>
                            <th scope="col" class="px-6 py-3 text-center border-l-2">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($batches as $batch)
                            <tr class="text-center bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td  class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $batch->id }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $batch->company->name }}
                                    code
                                </td>

                                <td class="px-6 py-4">
                                    {{ $batch->numberOfScratchCodes() }}
                                </td>

                                <td class="px-6 py-4 border-l-2">
                                    {{-- {{ $company->code }} --}}
                                    <div class="flex">
                                        <div class="flex items-center justify-between w-full">
                                            <a class="inline-flex items-center text-indigo-600 hover:underline hover:text-blue-800">
                                                Details
                                            </a>
                                            <a class="inline-flex items-center text-indigo-600 hover:underline hover:text-blue-800">
                                                Export
                                            </a>
                                            <a class="inline-flex items-center text-indigo-600 hover:underline hover:text-blue-800">
                                                Delete
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
    </div>
</div>

@endsection
