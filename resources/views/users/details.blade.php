@extends('../layouts.user')

@section('content')
<div class="wrapper">
    <h1 class="title">Borrowing Details</h1>   
    <h2><b>Title</b> - {{ $book->title }}</h2>
    
    <h2><b>Author</b> - {{ $book->author }}</h2>
    
    <h2><b>Year</b> - {{ $book->year }}</h2>
    
    <h2><b>Borrowed Date</b> - {{ $reservation[0]->borrow_date }}</h2>

    <h2><b>Return Date</b> - {{ $reservation[0]->return_date }}</h2>    

    <td class="delete-product">
        <form method="POST" action="/books/details/{{ $reservation[0]->id }}">

            @method('DELETE')
            @csrf
            
            <div class="field">
    
                <div class="control">
                    <button type="submit" class="btn btn-danger">Delete Borrowing</button>
                </div>
            
            
            </div>
        </form>
    </td>
        
</div>

@endsection



