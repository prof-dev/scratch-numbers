@extends('layouts.app')

@section('content')

<div class="bg-gray-50 dark:bg-gray-900">
    <div class="w-auto px-6 py-8 mx-auto md:h-screen lg:py-0">

        <div class="w-full px-6 py-8 mx-auto">
            <div class="px-10 py-6 bg-white rounded-lg shadow-xl">
                <form action="{{ route('create_company') }}" method="POST">
                    @csrf
                    <div class="row-auto mb-3">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Company Name') }}</label>

                        <div class="col-start-1 col-end-7">
                            <input id="name" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="text-red-600" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row-auto mb-3">
                        <label for="code" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Company Code') }}</label>

                        <div class="col-start-1 col-end-7">
                            <input id="code" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('name') is-invalid @enderror" name="code" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('code')
                                <span class="text-red-600" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="flex pt-8 flex-end sm:justify-end sm:pt-0">
                        <button type="submit" class="text-white bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800  rounded-lg text-sm px-4 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 ">
                            Add Company
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
                        {{-- @foreach($companies as $company) --}}
                            <tr class="text-center bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td  class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{-- {{ $company->name }} --}}
                                    code 1
                                </td>

                                <td class="px-6 py-4">
                                    {{-- {{ $company->code }} --}}
                                    code
                                </td>

                                <td class="px-6 py-4">
                                    {{-- {{ $company->code }} --}}
                                    code
                                </td>

                                <td class="px-6 py-4 border-l-2">
                                    {{-- {{ $company->code }} --}}
                                    <div class="flex">
                                        <div class="flex items-center justify-between w-full">
                                            <div class="inline-flex items-center text-indigo-600 hover:underline hover:text-blue-800">
                                                Details
                                            </div>
                                            <div class="inline-flex items-center text-indigo-600 hover:underline hover:text-blue-800">
                                                Export
                                            </div>
                                            <div class="inline-flex items-center text-indigo-600 hover:underline hover:text-blue-800">
                                                Delete
                                            </div>
                                        </div>
                                    </div>
                                </td>



                            </tr>
                        {{-- @endforeach --}}
                    </tbody>
                </table>
            </div>
    </div>
</div>

@endsection
