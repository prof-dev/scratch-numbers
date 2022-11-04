@extends('layouts.app')

@section('content')

<div class="bg-gray-50 dark:bg-gray-900">
    <div class="w-auto px-6 py-8 mx-auto md:h-screen lg:py-0">

        <div class="w-full px-6 py-8 mx-auto">
            <div class="px-10 py-6 bg-white rounded-lg shadow-xl">
                <div class="flex justify-center py-4 px-52">
                    <div class="text-xl bold">
                        Reset Code
                    </div>
                </div>
                <form action="{{ route('reset_code') }}" method="POST">
                    @csrf

                    <div class="row-auto mb-3">
                        <label for="rcode" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Scratch Code') }}</label>

                        <div class="col-start-1 col-end-7">
                            <input id="code" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('code') is-invalid @enderror" name="code" value="{{ old('code') }}" required autocomplete="code" autofocus>

                            @error('code')
                            <span class="text-red-600" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row-auto mb-3">
                        <label for="re_code" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Retype Code') }}</label>

                        <div class="col-start-1 col-end-7">
                            <input id="re_code" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('re_code') is-invalid @enderror" name="re_code" value="{{ old('re_code') }}" required autocomplete="re_code" autofocus>

                            @error('re_code')
                            <span class="text-red-600" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="flex pt-8 flex-end sm:justify-end sm:pt-0">
                        <button type="submit" class="text-white bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800  rounded-lg text-sm px-4 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 ">
                            Reset Code
                        </button>
                    </div>
                    @if($message!=="")
                    <div class="flex pt-8 flex-end sm:justify-end sm:pt-0">
                        <span class="text-green-600" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    </div>
                    @endif
                </form>

                @if(sizeOf($history)>0)
                <h1>Reset History </h1>
                @endif
            <div class="relative overflow-x-auto overflow-y-auto">
                @if(sizeOf($history)>0)
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                     <thead class="text-xs text-center text-white uppercase bg-gray-900 dark:bg-gray-700 dark:text-gray-400">
                        <td>Code</td>
                        <td>TimeStamp</td>
                        <td>User</td>
                        <td>Mint Account Id</td>
                    </thead>
                @endif
                @foreach ($history as $item)
                    <tr class="text-center bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td>{{$item->code}}</td>
                        <td>{{$item->created_at}}</td>
                        <td>{{$item->user_name}}</td>
                        <td>{{$item->consumed_by}}</td>
                     
                    </tr>
                @endforeach

                @if(sizeOf($history)>0)
                    </table>
                @endif
            </div>
        </div>
        </div>

    </div>
</div>

@endsection