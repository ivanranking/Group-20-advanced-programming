<!DOCTYPE html>
<html>
<head>
    <title>View Equipment</title>
</head>
<body>
    <h1>Equipment Details</h1>
    <p><strong>ID:</strong> <?= esc($item['id']) ?></p>
    <p><strong>Name:</strong> <?= esc($item['name']) ?></p>
    <p><strong>Description:</strong> <?= esc($item['description']) ?></p>
    <p><strong>Quantity:</strong> <?= esc($item['quantity']) ?></p>

    <a href="/equipment/edit/<?= $item['id'] ?>">Edit</a> |
    <a href="/equipment">Back to List</a>
</body>
</html>
