<!DOCTYPE html>
<html>
<head>
    <title>Add Equipment</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #e6ffe6; }
        .container { width: 70%; margin: 30px auto; background: #f9fff9;
            padding: 25px; border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        h2 { color: #333; }
        form { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        label { font-weight: bold; margin-bottom: 6px; display: block; }
        input, textarea, select { width: 100%; padding: 10px; border: 1px solid #ccc;
            border-radius: 6px; font-size: 14px; }
        textarea { resize: none; min-height: 80px; }
        .full-width { grid-column: 1 / 3; }
        .submit-btn { grid-column: 1 / 3; text-align: center; }
        button { background: #28a745; color: white; font-size: 16px;
            padding: 10px 25px; border: none; border-radius: 8px; cursor: pointer; }
        button:hover { background: #218838; }
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
    </div>
</body>
</html>
