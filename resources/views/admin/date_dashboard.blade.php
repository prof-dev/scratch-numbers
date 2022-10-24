@extends('admin.layouts.dashboard')

@section('content')

<main class="max-h-screen pt-16 overflow-auto ml-60">
    <div class="px-6 py-8">
        <div class="max-w-4xl mx-auto">
            <div class="p-8 mb-5 bg-white rounded-3xl">
                <h1 class="mb-10 text-xl font-bold">Select Company to find a report by date</h1>
                <div class="flex items-center justify-between w-full">
                    <form action="{{ route('dashboardDate') }}" method="POST">
                        @csrf
                        @method("POST")
                        {{-- <div class="flex items-center justify-center">

                        </div> --}}
                        <div class="flex items-center justify-center">
                            <div class="relative mb-3 datepicker form-floating xl:w-96" data-mdb-toggle-button="false">
                                <select
                                    class="form-control rounded-lg block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                    placeholder="Select a date" name="company">
                                    <option value="">select a company</option>
                                    @foreach ( $companies as $company )
                                    @if (old('company') == $company->id)
                                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                                    @endif
                                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                                    @endforeach
                                </select>
                                <label for="floatingInput" class="text-gray-700">Select a company</label>
                                @error('company')
                                    <span class="text-red-600" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="flex items-center gap-x-2">
                            <button type="submit" name="submit"
                                class="inline-flex items-center justify-center px-5 text-sm font-semibold text-gray-300 transition bg-gray-900 h-9 rounded-xl hover:text-white">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>

                <hr class="my-10">

                <div class="w-1/3">
                    <table class="min-w-full text-center mb-10">
                        <h1 class="text-xl text-gray-900 underline uppercase">{{ __('Local Codes') }}</h1>
                        <thead class="border-b">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-sm font-medium text-gray-900">
                                    Date
                                </th>
                                <th scope="col" class="px-6 py-4 text-sm font-medium text-gray-900">
                                    # Local Codes
                                </th>
                                <th scope="col" class="px-6 py-4 text-sm font-medium text-gray-900">
                                    # Local Used
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @dd($groups) --}}
                            @foreach($groups['local'] as $group)
                            <tr class="bg-gray-700 border-b boder-gray-900">
                                <td class="px-6 py-4 text-sm font-medium text-white whitespace-nowrap">
                                    {{ $group->date }}
                                </td>
                                <td class="px-6 py-4 text-sm font-light text-white whitespace-nowrap">
                                    {{ $group->total }}
                                </td>
                                <td class="px-6 py-4 text-sm font-light text-white whitespace-nowrap">
                                    {{ $group->used_count }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="w-1/3">
                    <h1 class="text-xl text-gray-900 underline uppercase">{{ __('International Codes') }}</h1>
                    <table class="min-w-full text-center mb-10">
                        <thead class="border-b">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-sm font-medium text-gray-900">
                                    Date
                                </th>
                                <th scope="col" class="px-6 py-4 text-sm font-medium text-gray-900">
                                    # International Codes
                                </th>
                                <th scope="col" class="px-6 py-4 text-sm font-medium text-gray-900">
                                    # International Used
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @dd($groups) --}}
                            @foreach($groups['global'] as $group)
                            <tr class="bg-gray-700 border-b boder-gray-900">
                                <td class="px-6 py-4 text-sm font-medium text-white whitespace-nowrap">
                                    {{ $group->date }}
                                </td>
                                <td class="px-6 py-4 text-sm font-light text-white whitespace-nowrap">
                                    {{ $group->total }}
                                </td>
                                <td class="px-6 py-4 text-sm font-light text-white whitespace-nowrap">
                                    {{ $group->used_count }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>



@endsection
