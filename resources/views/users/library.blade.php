@extends('../layouts.user')

@section('content')
<div class="wrapper">
    <div class="product">
        <h1 class="title">All Books</h1>
            <?php
                $count = count($books);
            ?>
            @if ($count != 0)
            <table>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Year</th>
                    <th>Details & Borrow</th>
                </tr>
                @foreach ($not_borrowed_books as $n_book)
                        <tr>
                            <td><?= $n_book->title ?></td>
                            <td><?= $n_book->author ?></td>
                            <td><?= $n_book->year ?></td>
                            <td class="show-product-td"><a href="/books/borrow/{{ $n_book->id }}/" class="borrow-product link-push-left">Details and Borrow</a></td>
                        </tr>
                @endforeach
                @foreach ($books as $book)
                        <tr>
                            <td><?= $book->title ?></td>
                            <td><?= $book->author ?></td>
                            <td><?= $book->year ?></td>
                            <td class="show-product-td"><a class="borrow-product link-push-left"  id="isDisabled">You already borrowed this book</a></td>
                        </tr>
                @endforeach
                
            </table>
            @else
                <h2>Books will be added sooner</h2>
            @endif
            
    </div>
</div>
@endsection
