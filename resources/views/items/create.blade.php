<!DOCTYPE html>
<html>
<head>
    <title>Create Item</title>

    <style>
        body {
            font-family: Arial;
            background: #f4f6f8;
            padding: 40px;
        }

        .card {
            background: white;
            padding: 20px;
            width: 400px;
            margin: auto;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        input {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
        }

        button {
            margin-top: 15px;
            padding: 10px;
            background: green;
            color: white;
            border: none;
            width: 100%;
        }
    </style>
</head>
<body>

<div class="card">

    <h2>Create Item</h2>

    <form action="{{ route('items.store') }}" method="POST">
        @csrf

        <input type="text" name="name" placeholder="Enter Item Name" required>

        <button type="submit">Save</button>
    </form>

</div>

</body>
</html>