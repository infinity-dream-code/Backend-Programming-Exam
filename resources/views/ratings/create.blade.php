<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Insert Rating</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .rating-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .form-select {
            border-radius: 12px;
            border: 2px solid #e9ecef;
            padding: 12px 16px;
            transition: all 0.3s ease;
            background-color: #fff;
        }
        
        .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
            transform: translateY(-2px);
        }
        
        .form-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 8px;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 12px;
            padding: 12px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }
        
        .btn-outline-secondary {
            border-radius: 12px;
            border: 2px solid #6c757d;
            padding: 12px 25px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-outline-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(108, 117, 125, 0.3);
        }
        
        .alert {
            border-radius: 12px;
            border: none;
        }
        
        .alert-success {
            background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
            color: #155724;
        }
        
        .page-title {
            color: white;
            text-align: center;
            margin-bottom: 2rem;
            font-weight: 700;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }
        
        .rating-icon {
            font-size: 2.5rem;
            color: #ffc107;
            margin-bottom: 1rem;
            text-align: center;
            display: block;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
            animation: fadeInUp 0.6s ease-out;
        }
        
        .form-group:nth-child(1) { animation-delay: 0.1s; }
        .form-group:nth-child(2) { animation-delay: 0.2s; }
        .form-group:nth-child(3) { animation-delay: 0.3s; }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .loading-spinner {
            display: none;
            margin-left: 10px;
        }
        
        .select-disabled {
            background-color: #f8f9fa !important;
            cursor: not-allowed;
        }
        
        .button-group {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 2rem;
        }
        
        @media (max-width: 768px) {
            .button-group {
                flex-direction: column;
                align-items: center;
            }
            
            .btn {
                width: 100%;
                max-width: 200px;
            }
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <h1 class="page-title">
                <i class="fas fa-star rating-icon"></i>
                Beri Rating Buku
            </h1>

            <div class="rating-card p-4 p-md-5">
                @if(session('success'))
                    <div class="alert alert-success mt-3">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('rating.store') }}" method="POST" id="ratingForm">
                    @csrf

                    <div class="form-group">
                        <label for="author_id" class="form-label">
                            <i class="fas fa-user-edit me-2"></i>Pilih Penulis
                        </label>
                        <select name="author_id" id="author_id" class="form-select" required>
                            <option value="">-- Pilih Penulis --</option>
                            @foreach($authors as $author)
                                <option value="{{ $author->id }}">{{ $author->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="book_id" class="form-label">
                            <i class="fas fa-book me-2"></i>Pilih Buku
                            <span class="loading-spinner">
                                <i class="fas fa-spinner fa-spin"></i>
                            </span>
                        </label>
                        <select name="book_id" id="book_id" class="form-select select-disabled" required disabled>
                            <option value="">-- Pilih Buku --</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="rating" class="form-label">
                            <i class="fas fa-star me-2"></i>Rating (1-10)
                        </label>
                        <select name="rating" id="rating" class="form-select" required>
                            <option value="">-- Pilih Rating --</option>
                            @for($i = 1; $i <= 10; $i++)
                                <option value="{{ $i }}">{{ $i }} {{ $i == 10 ? '⭐ Luar Biasa!' : ($i >= 8 ? '⭐ Sangat Bagus' : ($i >= 6 ? '⭐ Bagus' : ($i >= 4 ? '⭐ Cukup' : '⭐ Kurang'))) }}</option>
                            @endfor
                        </select>
                    </div>

                    <div class="button-group">
                        <a href="/" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali ke Beranda
                        </a>
                        <button type="submit" class="btn btn-primary" id="submitBtn">
                            <i class="fas fa-paper-plane me-2"></i>Kirim Rating
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById('author_id').addEventListener('change', function () {
        const authorId = this.value;
        const bookSelect = document.getElementById('book_id');
        const loadingSpinner = document.querySelector('.loading-spinner');
        
       
        bookSelect.innerHTML = '<option value="">Loading...</option>';
        bookSelect.disabled = true;
        bookSelect.classList.add('select-disabled');
        loadingSpinner.style.display = 'inline-block';

        if (authorId) {
            fetch(`/books/by-author/${authorId}`)
                .then(res => {
                    if (!res.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return res.json();
                })
                .then(data => {
                    bookSelect.innerHTML = '<option value="">-- Pilih Buku --</option>';
                    
                    if (data.length === 0) {
                        bookSelect.innerHTML += '<option value="" disabled>Tidak ada buku dari penulis ini</option>';
                    } else {
                        data.forEach(book => {
                            bookSelect.innerHTML += `<option value="${book.id}">${book.title}</option>`;
                        });
                    }
                    
                    bookSelect.disabled = false;
                    bookSelect.classList.remove('select-disabled');
                })
                .catch(error => {
                    console.error('Error:', error);
                    bookSelect.innerHTML = '<option value="" disabled>Error loading books</option>';
                    bookSelect.disabled = true;
                    bookSelect.classList.add('select-disabled');
                })
                .finally(() => {
                    loadingSpinner.style.display = 'none';
                });
        } else {
            bookSelect.innerHTML = '<option value="">-- Pilih Buku --</option>';
            bookSelect.disabled = true;
            bookSelect.classList.add('select-disabled');
            loadingSpinner.style.display = 'none';
        }
    });

    document.getElementById('ratingForm').addEventListener('submit', function(e) {
        const submitBtn = document.getElementById('submitBtn');
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Mengirim...';
        submitBtn.disabled = true;
    });

    document.getElementById('rating').addEventListener('change', function() {
        const selectedRating = parseInt(this.value);
        if (selectedRating) {
            this.style.borderColor = selectedRating >= 8 ? '#28a745' : selectedRating >= 6 ? '#ffc107' : '#dc3545';
        }
    });
</script>
</body>
</html>