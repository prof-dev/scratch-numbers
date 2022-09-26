@extends('layouts.app')

@section('content')

<div class="bg-gray-50 dark:bg-gray-900">
    <div class="w-auto px-6 py-8 mx-auto md:h-screen lg:py-0">
        @can('create', App\Models\User::class)
            <div class="w-full px-6 py-8 mx-auto">
                <div class="px-10 py-6 bg-white rounded-lg shadow-xl">
                    <div class="flex justify-center py-4 px-52">
                        <div class="text-xl bold">
                            Users Management
                        </div>
                    </div>
                    <form action="{{ route('create_user') }}" method="POST">
                        @csrf
                        <div class="row-auto mb-3">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Name') }}</label>

                            <div class="col-start-1 col-end-7">
                                <input id="name" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('username') is-invalid @enderror"
                                name="name"
                                value="{{ old('name') }}" required autocomplete="name"
                                autofocus>

                                @error('name')
                                    <span class="text-red-600" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row-auto mb-3">
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Email') }}</label>

                            <div class="col-start-1 col-end-7">
                                <input id="email" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('username') is-invalid @enderror"
                                name="email"
                                value="{{ old('email') }}" required autocomplete="email"
                                autofocus>

                                @error('email')
                                    <span class="text-red-600" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row-auto mb-3">
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Password') }}</label>

                            <div class="col-start-1 col-end-7">
                                <input id="password" type="password" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('password') is-invalid @enderror"
                                name="password"
                                value="{{ old('password') }}"
                                required autocomplete="password" autofocus>

                                @error('password')
                                    <span class="text-red-600" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row-auto mb-3">
                            <label for="role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">{{ __('Role') }}</label>
                            <select id="role" name="role" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected>Choose a Role</option>
                                @foreach($roles as $role)
                                    @if (old('role') == $role->id)
                                        <option value="{{ $role->id }}" selected>{{ $role->name }}</option>
                                    @else
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('role')
                                <span class="text-red-600" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="row-auto mb-3">
                            <label for="company" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">{{ __('Company') }}</label>
                            <select @if (!current_user()->company_id == null) disabled @endif id="company" name="company" required class="@if (current_user()->company_id == null) bg-gray-300 @else bg-gray-50 @endif  border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @if (current_user()->company_id == null)
                                <option selected>Choose a company</option>
                                    @foreach($companies as $company)
                                        @if (old('company') == $company->id)
                                            <option value="{{ $company->id }}" selected>{{ $company->name }}</option>
                                        @else
                                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                                        @endif
                                    @endforeach
                                @else
                                    <option value="{{ current_user()->company->id }}" selected>{{ current_user()->company->name }}</option>
                                @endif
                            </select>
                            @error('company')
                                <span class="text-red-600" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="flex pt-8 flex-end sm:justify-end sm:pt-0">
                            <button type="submit" class="text-white bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800  rounded-lg text-sm px-4 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 ">
                                Add User
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @endcan

        @can('viewAny', App\Model\User::class)
            <div class="relative mb-10 overflow-x-auto overflow-y-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-white uppercase bg-gray-900 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Company Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                # Users In Company
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (current_user()->company_id == null)
                            @foreach($companies as $company)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $company->name }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $company->users->count() }}
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ current_user()->company->name }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ current_user()->company->users->count() }}
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        @endcan

    </div>
</div>

@endsection
