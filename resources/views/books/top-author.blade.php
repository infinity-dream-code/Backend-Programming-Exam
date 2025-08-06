<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top 10 Penulis Terbaik</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-4">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-md mb-6 p-6">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-2">
                🏆 Top 10 Most Famous Author
            </h2>
            <p class="text-center text-gray-600">Berdasarkan jumlah vote tertinggi</p>
        </div>

        <!-- Back Button -->
        <div class="mb-6">
            <a href="/" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors">
                ← Kembali ke Daftar Buku
            </a>
        </div>

        <!-- Authors Table -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50 border-b">
                        <th class="px-6 py-4 text-left font-semibold text-gray-700">No</th>
                        <th class="px-6 py-4 text-left font-semibold text-gray-700">Author Name</th>
                        <th class="px-6 py-4 text-left font-semibold text-gray-700">Voter</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($topAuthors as $index => $author)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            @if($index === 0)
                                <span class="bg-yellow-400 text-white px-2 py-1 rounded font-bold">1</span>
                            @elseif($index === 1)
                                <span class="bg-gray-400 text-white px-2 py-1 rounded font-bold">2</span>
                            @elseif($index === 2)
                                <span class="bg-orange-400 text-white px-2 py-1 rounded font-bold">3</span>
                            @else
                                <span class="bg-blue-500 text-white px-2 py-1 rounded">{{ $index + 1 }}</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900">
                            {{ $author->name }}
                        </td>
                        <td class="px-6 py-4 text-gray-700">
                            {{ number_format($author->total_votes) }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>