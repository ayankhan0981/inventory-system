@if(session('success'))
    <div class="mb-4 rounded bg-green-100 p-3 text-green-800">
        {{ session('success') }}
    </div>
@endif
@if($errors->any())
    <div class="mb-4 rounded bg-red-100 p-3 text-red-800">
        <ul class="list-disc ms-5">
            @foreach($errors->all() as $e)
                <li>{{ $e }}</li>
            @endforeach
        </ul>
    </div>
@endif
