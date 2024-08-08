<!-- resources/views/clients/show.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Show Client</title>
</head>
<body>
    <h1>Client Details</h1>
    <p><strong>Name:</strong> {{ $client->name }}</p>
    <p><strong>Email:</strong> {{ $client->email }}</p>
    <p><strong>Phone:</strong> {{ $client->phone }}</p>
    <a href="{{ route('clients.index') }}">Back to List</a>
    <a href="{{ route('clients.edit', $client->id) }}">Edit</a>
    <form action="{{ route('clients.destroy', $client->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>
</body>
</html>
