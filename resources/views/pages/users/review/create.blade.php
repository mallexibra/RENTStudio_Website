@extends('layout.user')

@section('title', 'Add Review')

@section('content')
    <h1 class="text-center text-purple fw-bold">Review Studio</h1>
    <p class="text-center">Silahkan beri review untuk <b>{{ $data['nama'] }}</b></p>

    <form style="max-width: 40%; margin: 36px auto" action="/review/add/{{ $data['id'] }}" method="POST">
        @method('POST')
        @csrf
        <label class="d-block" for="rating">
            <span class="fw-semibold">Rating</span>
            <div class="rating mx-auto max-content">
                <span class="star" data-value="1"><i class="fas fa-star"></i></span>
                <span class="star" data-value="2"><i class="fas fa-star"></i></span>
                <span class="star" data-value="3"><i class="fas fa-star"></i></span>
                <span class="star" data-value="4"><i class="fas fa-star"></i></span>
                <span class="star" data-value="5"><i class="fas fa-star"></i></span>
            </div>
            <input type="hidden" name="rating" class="rating-value" value="{{ old('rating', 0) }}">
        </label>
        <label class="d-block my-3" for="deskripsi">
            <span class="fw-semibold">Deskripsi</span>
            <textarea class="d-block form-control w-100" name="deskripsi" id="deskripsi" rows="3"></textarea>
        </label>
        <button class="btn btn-purple w-100" type="submit">Submit</button>
    </form>

    <script>
        // Initialize the star rating input
        $(document).ready(function() {
            $(".rating .star").click(function() {
                var value = $(this).data('value');
                $(".rating-value").val(value);

                // Add styles for selected stars
                $(".rating .star").removeClass("selected");
                $(this).prevAll().addBack().addClass("selected");
            });
        });
    </script>
@endsection
