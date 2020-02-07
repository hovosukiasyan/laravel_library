@extends('../layouts.librarian')

@section('content')
<div class="wrapper">
    <div class="product">
        <h1 class="title">All Books</h1>
        <a href='/books/create' class="btn btn-success create-button">Create Book</a>
            <?php
                $count = count($books);
            ?>
            @if ($count != 0)
            <table>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Year</th>
                    <th>Edit</th>
                    <th>Show</th>
                    <th>Delete</th>
                </tr>
                @foreach ($books as $book)
                        <tr>
                            <td><?= $book->title ?></td>
                            <td><?= $book->author ?></td>
                            <td><?= $book->year ?></td>
                            <td class="edit-product-td"><a href="/books/{{ $book->id }}/edit" class="edit-product link-push-left">Edit Book</a></td>
                            <td class="show-product-td"><a href="/books/{{ $book->id }}/show" class="show-product link-push-left">Show Book</a></td>
                            <td class="delete-product">
                                <form method="POST" action="/books/{{ $book->id }}">

                                    @method('DELETE')
                                    @csrf
                                    
                                    <div class="field">
                            
                                        <div class="control">
                                            <button type="submit" class="btn btn-danger">Delete Book</button>
                                        </div>
                                    
                                    
                                    </div>
                                </form>
                            </td>
                        </tr>
                @endforeach
            </table>
            @else
                <h2>Books will be added sooner</h2>
            @endif
            
    </div>
</div>
@endsection
