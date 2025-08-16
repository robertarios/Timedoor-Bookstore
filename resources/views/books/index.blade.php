@extends('layouts.app')

@section('content')
    <h1>Book List</h1>

    <form method="GET" class="mb-4">
        <div class="row g-3">
            <div class="col-md-6">
                <input type="text" name="search" class="form-control"
                       placeholder="Search by book or author" value="{{ request('search') }}">
            </div>
            <div class="col-md-4">
                <select name="per_page" class="form-select">
                    @foreach([10,20,30,40,50,60,70,80,90,100] as $value)
                        <option value="{{ $value }}" {{ request('per_page') == $value ? 'selected' : '' }}>
                            Show {{ $value }} items
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Filter</button>
            </div>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Book Name</th>
                    <th>Category Name</th>
                    <th>Author Name</th>
                    <th>Average Rating</th>
                    <th>Voter</th>
                </tr>
            </thead>
            <tbody>
                @foreach($books as $index => $book)
                    <tr>
                        <td>{{ $books->firstItem() + $index }}</td>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->category->name }}</td>
                        <td>{{ $book->author->name }}</td>
                        <td>{{ number_format($book->ratings_avg_rating) }}</td>
                        <td>{{ fake()->numberBetween(1, 1000) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center">
        {{ $books->links('pagination::bootstrap-5') }}
    </div>
@endsection
