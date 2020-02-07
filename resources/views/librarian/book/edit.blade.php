@extends('../layouts.librarian')

@section('content')
<div class="wrapper">
    <h1 class="title">Edit Book</h1>
    <form method="POST" action="/books/{{ $book->id }}">

        @csrf
        @method('PATCH')
        <input id="type" name="type" type="hidden" value="book">
        


        <div class="form-group row">
            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

            <div class="col-md-6">
                <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                    name="title" value="{{ $book->title }}" autofocus>

                @if ($errors->has('title'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('title') }}</strong>
                </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="author" class="col-md-4 col-form-label text-md-right">{{ __('Author') }}</label>

            <div class="col-md-6">
                <input id="author" type="text" class="form-control{{ $errors->has('author') ? ' is-invalid' : '' }}"
                    name="author" value="{{ $book->author }}" autofocus>

                @if ($errors->has('author'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('author') }}</strong>
                </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="year" class="col-md-4 col-form-label text-md-right">{{ __('Publishing Year') }}</label>

            <div class="col-md-6">
                <input id="year" type="text" class="form-control{{ $errors->has('year') ? ' is-invalid' : '' }}"
                    name="year" value="{{ $book->year }}" autofocus>

                @if ($errors->has('year'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('year') }}</strong>
                </span>
                @endif
            </div>
        </div>

        
        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Update') }}
                </button>
            </div>
        </div>

    </form>

</div>
@endsection
