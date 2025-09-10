<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Equipment</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen p-8">
    <div class="w-full max-w-2xl">
        <div class="bg-white rounded-3xl shadow-lg p-8">
            <h4 class="text-2xl font-bold text-gray-800 mb-6">Add New Equipment</h4>
            <form action="<?= site_url('equipment') ?>" method="post" class="space-y-6">
                <?= csrf_field() ?>

                <div class="space-y-2">
                    <label for="name" class="block text-gray-700 font-medium">Name <span class="text-red-500">*</span></label>
                    <input type="text" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200" id="name" name="name" value="<?= old('name') ?>" required>
                    <?php if (isset($errors['name'])): ?>
                        <div class="text-red-500 text-sm mt-1"><?= $errors['name'] ?></div>
                    <?php endif; ?>
                </div>

                <div class="space-y-2">
                    <label for="capability" class="block text-gray-700 font-medium">Capability</label>
                    <input type="text" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200" id="capability" name="capability" value="<?= old('capability') ?>" placeholder="e.g., High magnification imaging">
                </div>

                <div class="space-y-2">
                    <label for="domain" class="block text-gray-700 font-medium">Domain</label>
                    <input type="text" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200" id="domain" name="domain" value="<?= old('domain') ?>" placeholder="e.g., Biology, Chemistry">
                </div>

                <div class="space-y-2">
                    <label for="description" class="block text-gray-700 font-medium">Description</label>
                    <textarea class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200" id="description" name="description" rows="3" placeholder="Detailed description of the equipment"><?= old('description') ?></textarea>
                </div>

                <div class="space-y-2">
                    <label for="facility_id" class="block text-gray-700 font-medium">Facility</label>
                    <div class="relative">
                        <select class="w-full px-4 py-3 rounded-xl border border-gray-300 appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200" id="facility_id" name="facility_id">
                            <option value="">Select Facility</option>
                            <?php foreach ($facilities as $facility): ?>
                                <option value="<?= $facility['id'] ?>" <?= old('facility_id') == $facility['id'] ? 'selected' : '' ?>>
                                    <?= esc($facility['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <!-- Custom arrow for select -->
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                        </div>
                    </div>
                </div>

                <div class="flex justify-between items-center pt-4">
                    <a href="<?= site_url('equipment') ?>" class="bg-gray-200 text-gray-700 px-6 py-3 rounded-xl font-medium hover:bg-gray-300 transition duration-300">Cancel</a>
                    <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-xl font-medium flex items-center justify-center shadow-lg hover:bg-blue-700 transition duration-300">
                        Add Equipment
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>