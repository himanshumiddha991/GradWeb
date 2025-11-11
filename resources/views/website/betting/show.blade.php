{{$game->id}}

<style>
    .form-row {
        display: flex;
        flex-wrap: wrap;
        margin: -5px; /* Adjust this value as needed for spacing */
    }

    .form-group {
        flex: 0 0 10%; /* Adjust this value to control the width of each input container */
        margin: 5px; /* Adjust this value as needed for spacing */
    }
</style>
<form  method="post">
    @csrf

    @for ($i = 1; $i <= 99; $i++)
        <div class="form-group">
            <label for="input{{ $i }}">Input {{ $i }}</label>
            <input type="text" name="input{{ $i }}" id="input{{ $i }}" class="form-control" placeholder="Placeholder {{ $i }}">
        </div>
    @endfor

    <button type="submit" class="btn btn-primary">Submit</button>
</form>