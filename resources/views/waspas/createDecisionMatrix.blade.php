@extends('master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form method="post" action="{{ route('decision-matrix.store') }}" id="myForm" enctype="multipart/form-data">
                    @csrf
                    @foreach ($alternatif as $item)
                        @if (!$item->isUsed())
                            <!-- Gunakan metode isUsed() untuk mengecek apakah id_alternatif telah digunakan -->
                            <div class="flex items-center justify-center">
                                <a href="#"
                                    class="block max-w-sm p-6 bg-[#726274] border border-gray-200 rounded-lg shadow dark:bg-[#726274] dark:border-gray-700">
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Input
                                        Nilai Decision Matrix untuk Alternatif {{ $item->nama_alternatif }}</h5>

                                    <div class="card-body">
                                        @if (session('success'))
                                            <div class="alert alert-success">{{ session('success') }}</div>
                                        @endif

                                        <form class="max-w-sm mx-auto">
                                            <div>
                                                <label for="alternatif"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alternatif</label>
                                                <input type="text" id="alternatif" value="{{ $item->nama_alternatif }}"
                                                    class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-white sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-white dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-900 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            </div>
                                            @foreach ($kriteria as $kriteriaItem)
                                                <div>
                                                    <label for="value_{{ $kriteriaItem->id }}"
                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ $kriteriaItem->nama_kriteria }}</label>
                                                    <input type="text" id="value_{{ $kriteriaItem->id }}"
                                                        name="value_{{ $item->id }}_{{ $kriteriaItem->id }}"
                                                        class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-white sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-white dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-900 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                </div>
                                            @endforeach
                                            <br>
                                                <button type="submit"
                                                    class="text-[#41403D] bg-[#E9E2D0] hover:bg-[#BEBAAE] focus:ring-2 focus:ring-gray-700 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 ">Submit</button>
                                        </form>
                                    </div>
                                </a>
                            </div>
                            <br>
                        @endif
                    @endforeach


                </form>
            </div>
        </div>
    </div>
@endsection
