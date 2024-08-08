<!-- resources/views/clients/create.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Create Client</title>
</head>
<body>
    <h1>Create Client</h1>
    <form action="{{ route('clients.store') }}" method="POST">
        @csrf
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone">
        </div>
        <button type="submit">Create Client</button>
    </form>
</body>
</html>
