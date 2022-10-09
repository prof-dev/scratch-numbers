@extends('layouts.app')

@section('content')

<div class="bg-gray-50 dark:bg-gray-900">
    <div class="w-auto px-6 py-8 mx-auto md:h-screen lg:py-0">

        <div class="w-full px-6 py-8 mx-auto">
            <div class="px-10 py-6 bg-white rounded-lg shadow-xl">
                <div class="flex justify-center py-4 px-52">
                    <div class="text-xl bold">
                        Bathches Management
                    </div>
                </div>
                <form action="{{ route('create_batch') }}" method="POST">
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
                        <select id="company" name="company" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
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
            <div class="relative overflow-x-auto overflow-y-auto mt-5">
                <div class="container bg-slate-900 p-10">
                    <div class="inline-flex w-3/4 col-span-2 pl-10">
                        <!-- search form -->
                        <form action="" class="flex flex-row w-full h-full">
                            <input class="w-full h-10 pl-8 text-xs text-gray-800 placeholder-gray-800 bg-white active:ring-gray-500 focus:ring-gray-500 rounded-l-xl" placeholder="Search here" type="text">
                            <span class="w-16 h-10 flex justify-center items-center bg-white rounded-r-xl">
                                <button class="h-full w-full flex justify-center items-center">
                                    {{-- <img class="w-10 h-8" src="MaxPay/icons/Artboard – 24.svg" alt="Search"> --}}
                                    <i class="fa-solid fa-magnifying-glass text-black"></i>
                                </button>
                            </span>
                        </form>
                        <!-- /search form  -->
                    </div>
                </div>
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
                        @if ($batches->count() > 0)
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
                                                <a href="{{ url('batch_details/'.$batch->id) }}" class="inline-flex items-center text-indigo-600 cursor-pointer hover:underline hover:text-blue-800">
                                                    Details
                                                </a>
                                                <button id="delete" onclick="downloadExcel({{$batch->id}})" class="inline-flex items-center text-green-600 cursor-pointer hover:underline hover:text-blue-800">
                                                    Export
                                                </button>
                                                <form action="{{ route('delete_batch',$batch->id) }}" method="POST">
                                                    @csrf
                                                    @method("DELETE")
                                                    <button type="submit" class="inline-flex items-center text-red-600 cursor-pointer hover:underline hover:text-blue-800">
                                                        Delete
                                                    </button>
                                                    @error('batch_has_codes_'.$batch->id)
                                                        <span class="text-red-600" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                            @else

                                {{-- @foreach($batches as $batch) --}}
                                <tr class="text-center bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td  class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{-- {{ $batch->id }} --}}
                                        {{ __('No Codes Available') }}
                                    </td>

                                    <td class="px-6 py-4">
                                        {{-- {{ $batch->company->name }} --}}
                                        {{ __('No Codes Available') }}
                                        code
                                    </td>

                                    <td class="px-6 py-4">
                                        {{-- {{ $batch->numberOfScratchCodes() }} --}}
                                        {{ __('No Codes Available') }}
                                    </td>

                                    <td class="px-6 py-4 border-l-2">
                                        {{-- {{ $company->code }} --}}
                                        <div class="flex">
                                            <div class="flex items-center justify-between w-full">
                                                <a href="#" class="inline-flex items-center text-gray-600 underline cursor-not-allowed disabled">
                                                    {{ __('No Details') }}
                                                </a>
                                                <a href="#" class="inline-flex items-center text-gray-600 underline cursor-not-allowed disabled">
                                                    {{ __('Cant Export') }}
                                                </a>
                                                <a href="#" class="inline-flex items-center text-gray-600 underline cursor-not-allowed disabled">
                                                    {{ __('Cant Delete Delete') }}
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            {{-- @endforeach --}}
                        @endif
                    </tbody>
                </table>
            </div>
    </div>
</div>

<script>

    function downloadExcel(url,code){
url="127.0.0.1:8000/batch_details/"+url+"/export"
fetch(url)
  .then(resp => resp.blob())
  .then(blob => {
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.style.display = 'none';
    a.href = url;
    // the filename you want
    a.download ="batch_download.xlsx";
    document.body.appendChild(a);
    a.click();
    window.URL.revokeObjectURL(url);
    alert('your file has downloaded!'); // or you know, something with better UX...
  })
  .catch(() => alert('oh no!'));
    }
</script>
@endsection

@push('head')

@endpush
