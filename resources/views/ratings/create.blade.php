@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Rate a Book</h1>

    <form method="POST" action="{{ route('ratings.store') }}" id="ratingForm">
        @csrf

        <div class="mb-3">
            <label for="author_id" class="form-label">Book Author:</label>
            <select name="author_id" id="author_id" class="form-select" required>
                <option value="">-- Select Author --</option>
                @foreach($authors as $author)
                    <option value="{{ $author->id }}">{{ $author->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="book_id" class="form-label">Book Name:</label>
            <select name="book_id" id="book_id" class="form-select" required>
                <option value="">-- Select Book --</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="rating" class="form-label">Rating (1-10):</label>
            <select name="rating" id="rating" class="form-select" required>
                <option value="">-- Select Rating --</option>
                @for($i = 1; $i <= 10; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>

        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('books.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Back
            </a>
            <button type="submit" class="btn btn-primary">Submit Rating</button>
        </div>
    </form>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const authorSelect = document.getElementById('author_id');
    const bookSelect = document.getElementById('book_id');

    authorSelect.addEventListener('change', async function() {
        const authorId = this.value;

        bookSelect.innerHTML = '<option value="">-- Select Book --</option>';
        bookSelect.disabled = true;

        if (!authorId) return;

        try {
            const response = await fetch(`/get-books-by-author/${authorId}`);
            const books = await response.json();

            if (Array.isArray(books)) {
                books.forEach(book => {
                    let option = document.createElement('option');
                    option.value = book.id;
                    option.textContent = book.text;
                    bookSelect.appendChild(option);
                });
                bookSelect.disabled = false;
            }
        } catch (err) {
            console.error("Gagal ambil data buku:", err);
            bookSelect.innerHTML = '<option value="">Gagal memuat buku</option>';
        }
    });
});
</script>
@endpush
@endsection
