@extends('../layouts.user')

@section('content')
<div class="wrapper">
    <form method="POST" action="/books/borrow/{{ $book->id }}">
        @csrf
    
        <h1 class="title">Book Details</h1>   

        <h2 name="title"><b>Title</b> - {{ $book->title }}</h2>
        
        <h2 name="author"><b>Author</b> - {{ $book->author }}</h2>
        
        <h2 name="year"><b>Year</b> - {{ $book->year }}</h2>

        <input type="hidden" name="title" value="{{ $book->title }}" />
        <input type="hidden" name="author" value="{{ $book->author }}" />
        <input type="hidden" name="year" value="{{ $book->year }}" />


        
    
        <input type="text" name="datetimes" style="width: 236px;" />  

    

        <div class="form-group row mt-4 ">
            <div class="offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('BORROW') }}
                </button>
            </div>
        </div>
        
</form>
</div>

@endsection



