<!DOCTYPE html>
<html>
<head>
    <title>Equipment Management</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #e6ffe6; }
        .container { width: 80%; margin: 30px auto; background: #f9fff9;
            padding: 25px; border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        h2 { color: #333; }
        form { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 30px; }
        label { font-weight: bold; margin-bottom: 6px; display: block; }
        input, textarea, select { width: 100%; padding: 10px; border: 1px solid #ccc;
            border-radius: 6px; font-size: 14px; }
        textarea { resize: none; min-height: 80px; }
        .full-width { grid-column: 1 / 3; }
        .submit-btn { grid-column: 1 / 3; text-align: center; }
        button { background: #28a745; color: white; font-size: 16px;
            padding: 10px 25px; border: none; border-radius: 8px; cursor: pointer; }
        button:hover { background: #218838; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid #ccc; }
        th, td { padding: 10px; text-align: left; }
        th { background-color: #28a745; color: white; }
        .search-box { margin-bottom: 20px; }
        .search-box input { width: 200px; padding: 8px; border-radius: 5px; border: 1px solid #ccc; }
        .actions a, .actions form { display: inline-block; margin-right: 5px; }
        .btn-edit { background: #007bff; padding: 6px 12px; color: white; text-decoration: none; border-radius: 6px; }
        .btn-edit:hover { background: #0056b3; }
        .btn-delete { background: #dc3545; padding: 6px 12px; color: white; border: none; border-radius: 6px; cursor: pointer; }
        .btn-delete:hover { background: #b52a37; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Add Equipment</h2>
        <form method="post" action="<?= site_url('equipment/store') ?>">
            <div>
                <label for="facility">Facility:</label>
                <select id="facility" name="facility">
                    <option value="xxx">xxx</option>
                    <option value="yyy">yyy</option>
                </select>
            </div>

            <div>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div>
                <label for="capabilities">Capabilities:</label>
                <input type="text" id="capabilities" name="capabilities">
            </div>

            <div>
                <label for="usage_domain">Usage domain:</label>
                <input type="text" id="usage_domain" name="usage_domain">
            </div>

            <div class="full-width">
                <label for="description">Description:</label>
                <textarea id="description" name="description"></textarea>
            </div>

            <div>
                <label for="inventory_code">Inventory code:</label>
                <input type="text" id="inventory_code" name="inventory_code">
            </div>

            <div>
                <label for="support_phase">Support phase:</label>
                <input type="text" id="support_phase" name="support_phase">
            </div>

            <div class="submit-btn">
                <button type="submit">Save</button>
            </div>
        </form>

        <!-- Search Box -->
        <div class="search-box">
            <form method="get" action="<?= site_url('equipment') ?>">
                <input type="text" name="q" value="<?= esc($q ?? '') ?>" placeholder="Search equipment...">
                <button type="submit">Search</button>
            </form>
        </div>

        <!-- Equipment List -->
        <h2>Existing Equipment</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Facility</th>
                    <th>Name</th>
                    <th>Capabilities</th>
                    <th>Usage Domain</th>
                    <th>Description</th>
                    <th>Inventory Code</th>
                    <th>Support Phase</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($equipment) && is_array($equipment)): ?>
                    <?php foreach($equipment as $item): ?>
                        <tr>
                            <td><?= esc($item['id']) ?></td>
                            <td><?= esc($item['facility']) ?></td>
                            <td><?= esc($item['name']) ?></td>
                            <td><?= esc($item['capabilities']) ?></td>
                            <td><?= esc($item['usage_domain']) ?></td>
                            <td><?= esc($item['description']) ?></td>
                            <td><?= esc($item['inventory_code']) ?></td>
                            <td><?= esc($item['support_phase']) ?></td>
                            <td class="actions">
                                <a href="<?= site_url('equipment/edit/'.$item['id']) ?>" class="btn-edit">Edit</a>
                                <form method="post" action="<?= site_url('equipment/delete/'.$item['id']) ?>" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                    <button type="submit" class="btn-delete">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="9" style="text-align:center;">No equipment found</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
