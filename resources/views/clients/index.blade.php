<!-- resources/views/clients/index.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Clients</title>
</head>
<body>
    <h1>Clients</h1>
    <a href="{{ route('clients.create') }}">Create New Client</a>
    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif
    <ul>
        @foreach ($clients as $client)
            <li>
                {{ $client->name }} - {{ $client->email }}
                <a href="{{ route('clients.show', $client->id) }}">View</a>
                <a href="{{ route('clients.edit', $client->id) }}">Edit</a>
                <form action="{{ route('clients.destroy', $client->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
</body>
</html>
