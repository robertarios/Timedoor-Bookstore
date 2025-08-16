@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4">Top 10 Famous Authors</h1>

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Author Name</th>
                        <th>Voter</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($authors as $index => $author)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $author->name }}</td>
                            <td>{{ number_format($author->voter) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            <a href="{{ route('books.index') }}" class="btn btn-primary">
                <i class="bi bi-arrow-left"></i> Back to Book List
            </a>
        </div>
    </div>
@endsection
