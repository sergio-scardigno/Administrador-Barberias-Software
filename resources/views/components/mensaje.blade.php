@if (count($errors) > 0)
    <div class="block rounded-md bg-red-300 box-border p-1 shadow-2xl border-black mb-8">
        <p>Los campos no fueron completados correctamente:</p>
        <ul>
            @foreach ($errors->all() as $message)
                <li>{{ $message }}</li>
            @endforeach
        </ul>
    </div>
@endif
