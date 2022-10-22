@extends('admin.layouts.dashboard')

@section('content')

<main class="max-h-screen pt-16 overflow-auto ml-60">
    <div class="px-6 py-8">
        <div class="max-w-4xl mx-auto">
            <div class="p-8 mb-5 bg-white rounded-3xl">
                <h1 class="mb-10 text-xl font-bold">Select Company to find a report on</h1>
                <div class="flex items-center justify-between w-full">
                    <form action="{{ route('dashboardCompany') }}" method="POST">
                        @csrf
                        @method("POST")
                        <div class="flex items-center justify-around w-full">
                            <div class="relative px-3 mb-3 datepicker form-floating xl:w-1/2"
                                data-mdb-toggle-button="false">
                                <input type="date"
                                    class="form-control rounded-lg block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                    placeholder="Select a date" data-mdb-toggle="datepicker" name="start_date"
                                    required />
                                <label for="floatingInput" class="text-gray-700">Select start date</label>
                            </div>
                            <div class="relative px-2 mb-3 datepicker form-floating xl:w-1/2"
                                data-mdb-toggle-button="false">
                                <input type="date"
                                    class="form-control rounded-lg block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                    placeholder="Select a date" data-mdb-toggle="datepicker" name="end_date" required />
                                <label for="floatingInput" class="text-gray-700">Select end date</label>
                            </div>
                        </div>
                        {{-- <div class="flex items-center justify-center">

                        </div> --}}
                        <div class="flex items-center justify-center">
                            <div class="relative mb-3 datepicker form-floating xl:w-96" data-mdb-toggle-button="false">
                                <select
                                    class="form-control rounded-lg block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                    placeholder="Select a date" name="company" required>
                                    <option value="">select a company</option>
                                    @foreach ( $companies as $company )
                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                    @endforeach
                                </select>
                                <label for="floatingInput" class="text-gray-700">Select a company</label>
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
                    <table class="min-w-full text-center">
                        <thead class="border-b">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-sm font-medium text-gray-900">
                                    Company Name
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
                                    {{ $group->company_name }}
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
                    <table class="min-w-full text-center">
                        <thead class="border-b">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-sm font-medium text-gray-900">
                                    Company Name
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
                                    {{ $group->company_name }}
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

{{-- <tr class="border-b">
    <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">
        Default
    </td>
    <td class="px-6 py-4 text-sm font-light text-gray-900 whitespace-nowrap">
        Cell
    </td>
    <td class="px-6 py-4 text-sm font-light text-gray-900 whitespace-nowrap">
        Cell
    </td>
</tr>
<tr class="bg-blue-100 border-b border-blue-200">
    <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">
        Primary
    </td>
    <td class="px-6 py-4 text-sm font-light text-gray-900 whitespace-nowrap">
        Cell
    </td>
    <td class="px-6 py-4 text-sm font-light text-gray-900 whitespace-nowrap">
        Cell
    </td>
</tr>
<tr class="bg-purple-100 border-b border-purple-200">
    <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">
        Secondary
    </td>
    <td class="px-6 py-4 text-sm font-light text-gray-900 whitespace-nowrap">
        Cell
    </td>
    <td class="px-6 py-4 text-sm font-light text-gray-900 whitespace-nowrap">
        Cell
    </td>
</tr>
<tr class="bg-green-100 border-b border-green-200">
    <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">
        Success
    </td>
    <td class="px-6 py-4 text-sm font-light text-gray-900 whitespace-nowrap">
        Cell
    </td>
    <td class="px-6 py-4 text-sm font-light text-gray-900 whitespace-nowrap">
        Cell
    </td>
</tr>
<tr class="bg-red-100 border-b border-red-200">
    <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">
        Danger
    </td>
    <td class="px-6 py-4 text-sm font-light text-gray-900 whitespace-nowrap">
        Cell
    </td>
    <td class="px-6 py-4 text-sm font-light text-gray-900 whitespace-nowrap">
        Cell
    </td>
</tr>
<tr class="bg-yellow-100 border-b border-yellow-200">
    <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">
        Warning
    </td>
    <td class="px-6 py-4 text-sm font-light text-gray-900 whitespace-nowrap">
        Cell
    </td>
    <td class="px-6 py-4 text-sm font-light text-gray-900 whitespace-nowrap">
        Cell
    </td>
</tr>
<tr class="bg-indigo-100 border-b border-indigo-200">
    <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">
        Info
    </td>
    <td class="px-6 py-4 text-sm font-light text-gray-900 whitespace-nowrap">
        Cell
    </td>
    <td class="px-6 py-4 text-sm font-light text-gray-900 whitespace-nowrap">
        Cell
    </td>
</tr>
<tr class="border-b border-gray-200 bg-gray-50">
    <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">
        Light
    </td>
    <td class="px-6 py-4 text-sm font-light text-gray-900 whitespace-nowrap">
        Cell
    </td>
    <td class="px-6 py-4 text-sm font-light text-gray-900 whitespace-nowrap">
        Cell
    </td>
</tr> --}}
