@extends('../layouts.user')

@section('content')
<div class="wrapper">
    <div class="product">
        <h1 class="title">My Books</h1>
            <?php
                $count = count($books);
            ?>
            @if ($count != 0)
            <table>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Year</th>
                    <th>Details</th>
                </tr>
                @foreach ($books as $book)
                        <tr>
                            <td><?= $book->title ?></td>
                            <td><?= $book->author ?></td>
                            <td><?= $book->year ?></td>
                            <td class="show-product-td"><a href="/books/details/{{ $book->id }}/" class="borrow-product link-push-left">Details</a></td>
                        </tr>
                @endforeach
                
            </table>
            @else
                <h2>You don't have borrowed books!</h2>
            @endif
            
    </div>
</div>
@endsection
