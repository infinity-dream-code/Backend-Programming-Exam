<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Buku</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    animation: {
                        'fade-in': 'fadeIn 0.6s ease-out',
                        'slide-up': 'slideUp 0.3s ease-out',
                        'bounce-in': 'bounceIn 0.5s ease-out',
                        'pulse-glow': 'pulseGlow 2s infinite'
                    }
                }
            }
        }
    </script>
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes slideUp {
            from { transform: translateY(10px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        @keyframes bounceIn {
            0% { transform: scale(0.3) translateY(20px); opacity: 0; }
            50% { transform: scale(1.1) translateY(-5px); }
            100% { transform: scale(1) translateY(0); opacity: 1; }
        }
        @keyframes pulseGlow {
            0%, 100% { box-shadow: 0 0 20px rgba(99, 102, 241, 0.3); }
            50% { box-shadow: 0 0 30px rgba(99, 102, 241, 0.6); }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-purple-600 via-blue-600 to-indigo-700 min-h-screen p-4 md:p-6">
    <div class="max-w-7xl mx-auto animate-fade-in">
        <!-- Header -->
        <div class="bg-white rounded-t-2xl shadow-xl">
            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white p-8 rounded-t-2xl">
                <h1 class="text-4xl md:text-5xl font-bold text-center mb-2">
                    📚 Daftar Buku Terbaik
                </h1>
                <p class="text-center text-indigo-100 text-lg">
                    Temukan koleksi buku terbaik dengan rating tertinggi
                </p>
            </div>
        </div>

        <!-- Navigation Buttons -->
        <div class="bg-white px-8 py-6 border-b border-gray-200">
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-6">
                <a href="{{ url('authors-top') }}" class="group relative bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white px-8 py-4 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 hover:shadow-2xl animate-bounce-in flex items-center gap-3 min-w-[280px] justify-center">
                    <span class="text-2xl group-hover:animate-bounce">🏆</span>
                    <div class="text-center">
                        <div class="font-bold">Top 10 Penulis Terbaik</div>
                        <div class="text-sm text-emerald-100">Berdasarkan jumlah vote</div>
                    </div>
                    <div class="absolute -top-2 -right-2 bg-yellow-400 text-yellow-900 text-xs font-bold px-2 py-1 rounded-full animate-pulse">
                        HOT
                    </div>
                </a>

                <a href="{{ url('rating/create') }}" class="group relative bg-gradient-to-r from-rose-500 to-pink-600 hover:from-rose-600 hover:to-pink-700 text-white px-8 py-4 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 hover:shadow-2xl animate-bounce-in flex items-center gap-3 min-w-[280px] justify-center animation-delay-200">
                    <span class="text-2xl group-hover:animate-pulse">⭐</span>
                    <div class="text-center">
                        <div class="font-bold">Beri Rating Buku</div>
                        <div class="text-sm text-rose-100">Nilai buku favorit Anda</div>
                    </div>
                    <div class="absolute -top-2 -right-2 bg-orange-400 text-orange-900 text-xs font-bold px-2 py-1 rounded-full animate-pulse">
                        NEW
                    </div>
                </a>
            </div>
        </div>

        <!-- Search Section -->
        <div class="bg-white px-8 py-6 border-b border-gray-200">
            <form method="GET" action="{{ route('books.index') }}" class="flex flex-col md:flex-row gap-4 items-center justify-center">
                <div class="relative flex-1 max-w-md">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <span class="text-gray-400 text-xl">🔍</span>
                    </div>
                    <input 
                        type="text" 
                        name="search" 
                        placeholder="Cari judul atau penulis..." 
                        value="{{ $search }}"
                        class="w-full pl-12 pr-4 py-3 border-2 border-gray-300 rounded-xl focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500 transition-all duration-200 text-gray-700"
                    >
                </div>
                
                <select 
                    name="per_page" 
                    onchange="this.form.submit()" 
                    class="px-4 py-3 border-2 border-gray-300 rounded-xl focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500 bg-white text-gray-700 cursor-pointer transition-all duration-200"
                >
                    @foreach([10, 20, 30, 40, 50, 60, 70, 80, 90, 100] as $size)
                        <option value="{{ $size }}" {{ $perPage == $size ? 'selected' : '' }}>
                            {{ $size }} per halaman
                        </option>
                    @endforeach
                </select>

                <button 
                    type="submit" 
                    class="bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white px-8 py-3 rounded-xl font-semibold transition-all duration-200 transform hover:scale-105 hover:shadow-lg focus:ring-4 focus:ring-indigo-100"
                >
                    CARI
                </button>
            </form>
        </div>

        <!-- Table Section -->
        <div class="bg-white rounded-b-2xl shadow-xl overflow-hidden">
            <div class="overflow-x-auto">
              <table class="w-full">
    <thead>
        <tr class="bg-gradient-to-r from-gray-800 to-gray-900 text-white">
            <th class="px-6 py-5 text-left">📖 Title</th>
            <th class="px-6 py-5 text-left">📂 Category</th>
            <th class="px-6 py-5 text-left">✍️ Author Name</th>
            <th class="px-6 py-5 text-left">⭐ Avarage Rating</th>
            <th class="px-6 py-5 text-left">👥 Voter</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-200">
        @forelse($books as $book)
            <tr class="hover:bg-indigo-50 transition-colors duration-200 group">
                <td class="px-6 py-5 font-semibold text-gray-900 group-hover:text-indigo-700">
                    {{ $book->title }}
                </td>
                <td class="px-6 py-5 text-gray-600">
                    {{ $book->category->name ?? '-' }}
                </td>
                <td class="px-6 py-5 text-gray-600">
                    {{ $book->author->name ?? '-' }}
                </td>
                <td class="px-6 py-5">
                    <span class="inline-block px-3 py-1 rounded-full bg-yellow-400 text-white font-semibold shadow-md">
                        ⭐ {{ number_format($book->avg_rating ?? 0, 2) }}
                    </span>
                </td>
                <td class="px-6 py-5 text-gray-700">
                    {{ $book->ratings->count() }} vote
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="px-8 py-16 text-center">
                    <div class="text-6xl mb-4">📚</div>
                    <div class="text-xl text-gray-500 font-medium mb-2">Tidak ada buku ditemukan</div>
                    <div class="text-gray-400">Coba ubah kata kunci pencarian Anda</div>
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

            </div>

            <!-- Pagination -->
            <div class="bg-gray-50 px-8 py-6 border-t border-gray-200">
                <div class="flex justify-center">
                    {{ $books->links() }}
                </div>
            </div>
        </div>
    </div>

    <script>
    
        document.addEventListener('DOMContentLoaded', function() {
            const rows = document.querySelectorAll('tbody tr');
            rows.forEach((row, index) => {
                setTimeout(() => {
                    row.classList.add('animate-slide-up');
                }, index * 50);
            });

         
            const buttons = document.querySelectorAll('.animate-bounce-in');
            buttons.forEach((button, index) => {
                setTimeout(() => {
                    button.style.animationDelay = `${index * 200}ms`;
                }, 100);
            });
        });

     
        const tableRows = document.querySelectorAll('tbody tr');
        tableRows.forEach(row => {
            row.addEventListener('mouseenter', function() {
                this.style.transform = 'translateX(5px)';
            });
            
            row.addEventListener('mouseleave', function() {
                this.style.transform = 'translateX(0)';
            });
        });
    </script>
</body>
</html>