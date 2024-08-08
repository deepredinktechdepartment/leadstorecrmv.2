<!-- resources/views/clients/edit.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Edit Client</title>
</head>
<body>
    <h1>Edit Client</h1>
    <form action="{{ route('clients.update', $client->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="{{ $client->name }}" required>
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ $client->email }}" required>
        </div>
        <div>
            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" value="{{ $client->phone }}">
        </div>
        <button type="submit">Update Client</button>
    </form>
</body>
</html>
