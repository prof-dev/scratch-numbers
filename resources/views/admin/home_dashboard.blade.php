@extends('admin.layouts.dashboard')

@section('content')

<main class="ml-60 pt-16 max-h-screen overflow-auto">
    <div class="px-6 py-8">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-3xl p-8 mb-5">
                <h1 class="text-xl font-bold mb-10">Select Company to find a report on</h1>
                <div class="flex items-center justify-between w-full">
                    <form action="">
                        <div class="flex items-center justify-around w-full">
                            <div class="datepicker relative form-floating mb-3 px-3 xl:w-1/2" data-mdb-toggle-button="false">
                              <input type="date"
                                class="form-control rounded-lg block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                placeholder="Select a date" data-mdb-toggle="datepicker" />
                              <label for="floatingInput" class="text-gray-700">Select start date</label>
                            </div>
                            <div class="datepicker relative form-floating mb-3 px-2 xl:w-1/2" data-mdb-toggle-button="false">
                                <input type="date"
                                  class="form-control rounded-lg block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                  placeholder="Select a date" data-mdb-toggle="datepicker" />
                                <label for="floatingInput" class="text-gray-700">Select end date</label>
                              </div>
                        </div>
                        {{-- <div class="flex items-center justify-center">

                        </div> --}}
                        <div class="flex items-center justify-center">
                            <div class="relative mb-3 datepicker form-floating xl:w-96" data-mdb-toggle-button="false">
                              <select
                                class="form-control rounded-lg block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                placeholder="Select a date"
                                name="company"
                                required>
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

                <div class="w-full">
                    <table class="min-w-full text-center">
                        <thead class="border-b">
                          <tr>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4">
                              Company Name
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4">
                              # Local Codes
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4">
                              # Local Used
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4">
                              # International Codes
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4">
                              # International Used
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr class="border-b bg-gray-700 boder-gray-900">
                            <td class="text-sm text-white font-medium px-6 py-4 whitespace-nowrap">
                              Dark
                            </td>
                            <td class="text-sm text-white font-light px-6 py-4 whitespace-nowrap">
                              Cell
                            </td>
                            <td class="text-sm text-white font-light px-6 py-4 whitespace-nowrap">
                              Cell
                            </td>
                            <td class="text-sm text-white font-light px-6 py-4 whitespace-nowrap">
                              Cell
                            </td>
                            <td class="text-sm text-white font-light px-6 py-4 whitespace-nowrap">
                              Cell
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    {{-- <div>
                        <h2 class="text-2xl font-bold mb-4">Stats</h2>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="col-span-2">
                                <div class="p-4 bg-green-100 rounded-xl">
                                    <div class="font-bold text-xl text-gray-800 leading-none">Good day, <br>Kristin
                                    </div>
                                    <div class="mt-5">
                                        <button type="button"
                                            class="inline-flex items-center justify-center py-2 px-3 rounded-xl bg-white text-gray-800 hover:text-green-500 text-sm font-semibold transition">
                                            Start tracking
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="p-4 bg-yellow-100 rounded-xl text-gray-800">
                                <div class="font-bold text-2xl leading-none">20</div>
                                <div class="mt-2">Tasks finished</div>
                            </div>
                            <div class="p-4 bg-yellow-100 rounded-xl text-gray-800">
                                <div class="font-bold text-2xl leading-none">5,5</div>
                                <div class="mt-2">Tracked hours</div>
                            </div>
                            <div class="col-span-2">
                                <div class="p-4 bg-purple-100 rounded-xl text-gray-800">
                                    <div class="font-bold text-xl leading-none">Your daily plan</div>
                                    <div class="mt-2">5 of 8 completed</div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</main>



@endsection

{{-- <tr class="border-b">
                            <td class="text-sm text-gray-900 font-medium px-6 py-4 whitespace-nowrap">
                              Default
                            </td>
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                              Cell
                            </td>
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                              Cell
                            </td>
                          </tr>
                          <tr class="border-b bg-blue-100 border-blue-200">
                            <td class="text-sm text-gray-900 font-medium px-6 py-4 whitespace-nowrap">
                              Primary
                            </td>
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                              Cell
                            </td>
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                              Cell
                            </td>
                          </tr>
                          <tr class="border-b bg-purple-100 border-purple-200">
                            <td class="text-sm text-gray-900 font-medium px-6 py-4 whitespace-nowrap">
                              Secondary
                            </td>
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                              Cell
                            </td>
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                              Cell
                            </td>
                          </tr>
                          <tr class="border-b bg-green-100 border-green-200">
                            <td class="text-sm text-gray-900 font-medium px-6 py-4 whitespace-nowrap">
                              Success
                            </td>
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                              Cell
                            </td>
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                              Cell
                            </td>
                          </tr>
                          <tr class="border-b bg-red-100 border-red-200">
                            <td class="text-sm text-gray-900 font-medium px-6 py-4 whitespace-nowrap">
                              Danger
                            </td>
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                              Cell
                            </td>
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                              Cell
                            </td>
                          </tr>
                          <tr class="border-b bg-yellow-100 border-yellow-200">
                            <td class="text-sm text-gray-900 font-medium px-6 py-4 whitespace-nowrap">
                              Warning
                            </td>
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                              Cell
                            </td>
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                              Cell
                            </td>
                          </tr>
                          <tr class="border-b bg-indigo-100 border-indigo-200">
                            <td class="text-sm text-gray-900 font-medium px-6 py-4 whitespace-nowrap">
                              Info
                            </td>
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                              Cell
                            </td>
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                              Cell
                            </td>
                          </tr>
                          <tr class="border-b bg-gray-50 border-gray-200">
                            <td class="text-sm text-gray-900 font-medium px-6 py-4 whitespace-nowrap">
                              Light
                            </td>
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                              Cell
                            </td>
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                              Cell
                            </td>
                          </tr> --}}
