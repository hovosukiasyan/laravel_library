@extends('../layouts.librarian')

@section('content')
<div class="wrapper">
    <h1 class="title">Book Details</h1>   

    <h2 class="title"><b>Title</b> - {{ $book->title }}</h2>
    
    <h2 class="title"><b>Author</b> - {{ $book->author }}</h2>
    
    <h2 class="title"><b>Year</b> - {{ $book->year }}</h2>

    <div class="edit-in-show-page">
        <a href="/books/{{ $book->id }}/edit" class="edit-product link_push_left">
            Edit Book
        </a>
    </div>
        
</div>

@endsection



