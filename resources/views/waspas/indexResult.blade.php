@extends('master')

@section('content')
    <div class="container">
        <div class="pull-left px-6 py-2 text-center">
            <p class="text-2xl font-bold">Score dan Ranking</p>
        </div>
        <br>
        @if(!empty($waspasScores))
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mx-3">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-white uppercase bg-[#726274] dark:text-white">
                    <tr>
                        <th>Ranking</th>
                        <th>Alternatif</th>
                        <th>Score</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ranking as $rank => $idAlternatif)
                        <tr class="bg-white border-b dark:bg-white dark:border-gray-700">
                            <th class="px-6 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-gray-900">{{$rank + 1}}</th>
                            <th class="px-6 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-gray-900">{{$alternatifNames[$idAlternatif]}}</th>
                            <th class="py-2 font-medium text-gray-900 whitespace-nowrap dark:text-gray-900">{{$waspasScores[$idAlternatif]}}</th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
            <p>Tidak ada data Decision Matrix yang tersimpan.</p>
        @endif
    </div>
@endsection
