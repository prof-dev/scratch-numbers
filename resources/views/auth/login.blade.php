@extends('layouts.app')

@section('content')
<div class="bg-gray-50 dark:bg-gray-900"">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0"">
        <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                {{-- <div class="p-6 space-y-4 md:space-y-6 sm:p-8"> --}}
                    <h1 class="flex items-center justify-center text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        {{ __('Login') }}
                    </h1>
                {{-- </div> --}}

                <div class="space-y-4 md:space-y-6">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row-auto mb-3">
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Email Address') }}</label>

                            <div class="col-start-1 col-end-7">
                                <input id="email" type="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row-auto mb-3">
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500  @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="flex items-center justify-between">
                            <div class="row-auto mb-3">
                                <div class="flex items-start">
                                    <div class="flex items-center h-5">
                                        <input class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    </div>
                                    <div class="ml-3 text-sm">
                                        <label class="text-gray-500 dark:text-gray-300" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row-auto mb-0">
                                <div class="flex items-end">

                                    @if (Route::has('password.request'))
                                        <a class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-500" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <button
                        type="submit"
                        class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            {{ __('Login') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
