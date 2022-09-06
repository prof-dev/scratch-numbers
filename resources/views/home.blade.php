@extends('layouts.app')

@section('content')

<div class="bg-gray-50 dark:bg-gray-900">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <div class="w-full bg-white rounded-lg shadow lg:w-1/2 lg:h-1/3 dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="justify-between p-6 space-y-4 md:space-y-6 sm:p-8 lg:w-full lg:h-full flex-horizontal">
                <div class="flex items-center justify-between w-full">
                    <a href="{{ route('company') }}" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-base px-6 py-3.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 ">
                        Companies
                    </a>
                    <a href="{{ route('scratch_codes_batches') }}" class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-base px-6 py-3.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 ">
                        Scratch Codes
                    </a>
                </div>
                <div class="flex items-center justify-center w-full">
                    <a href="{{ route('users') }}" class="lg:w-36 text-white bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 font-medium rounded-lg text-base px-6 py-3.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 ">
                        Users
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
