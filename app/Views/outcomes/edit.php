<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title) ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100 flex h-screen overflow-hidden">
    <!-- Sidebar -->
    <div class="bg-white text-gray-800 w-64 p-6 flex flex-col shadow-lg rounded-r-3xl">
        <div class="flex items-center space-x-2 mb-10 text-gray-800 font-bold text-xl">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M4 17V7a4 4 0 0 1 4-4h8a4 4 0 0 1 4 4v10a4 4 0 0 1-4 4H8a4 4 0 0 1-4-4z"></path>
                <circle cx="12" cy="12" r="2"></circle>
            </svg>
            <span>Admin Dashboard</span>
        </div>
        <nav class="w-full">
            <ul class="space-y-2">
                <li><a href="#" class="flex items-center space-x-3 p-3 rounded-xl hover:bg-gray-200 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 2l-2.4 7.2h-7.6l6 4.8l-2.4 7.2l6-4.8l6 4.8l-2.4-7.2l6-4.8h-7.6z"></path>
                    </svg>
                    <span>Meteons</span>
                </a></li>
                <li><a href="#" class="flex items-center space-x-3 p-3 rounded-xl hover:bg-gray-200 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                    <span>Solithans</span>
                </a></li>
                <li><a href="#" class="flex items-center space-x-3 p-3 rounded-xl hover:bg-gray-200 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12.22 2h-.44a2 2 0 0 0-2 2v.19a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.08a2 2 0 0 1 1 1.73v.5a2 2 0 0 1-1 1.73l-.15.08a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2-2l.43-.25a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73v.5a2 2 0 0 0 1 1.73l.43.25a2 2 0 0 0 2-2l.15-.08a2 2 0 0 1 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.73v-.49a2 2 0 0 1 1-1.73l.15-.08a2 2 0 0 0 .73-2.73l-.22-.39a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 2l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"></path>
                        <circle cx="12" cy="12" r="3"></circle>
                    </svg>
                    <span>Sonsonang</span>
                </a></li>
                <li><a href="#" class="flex items-center space-x-3 p-3 rounded-xl hover:bg-gray-200 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="11" width="18" height="10" rx="2" ry="2"></rect>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    <span>Margin</span>
                </a></li>
                <li><a href="#" class="flex items-center space-x-3 p-3 rounded-xl hover:bg-gray-200 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                        <path d="M13 2v7h7"></path>
                    </svg>
                    <span>Unisurats</span>
                </a></li>
                <li><a href="#" class="flex items-center space-x-3 p-3 rounded-xl hover:bg-gray-200 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                        <polyline points="7 10 12 15 17 10"></polyline>
                        <line x1="12" y1="15" x2="12" y2="3"></line>
                    </svg>
                    <span>Footthlocms</span>
                </a></li>
                <li><a href="#" class="flex items-center space-x-3 p-3 rounded-xl hover:bg-gray-200 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5C2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3C19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"></path>
                    </svg>
                    <span>Toittpson</span>
                </a></li>
            </ul>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="flex-1 p-8 overflow-y-auto">
        <div class="flex flex-col items-start space-y-4 mb-8">
            <div class="flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-800" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                </svg>
                <h1 class="text-3xl font-bold text-gray-800">Edit Outcome</h1>
            </div>
        </div>
        
        <div class="flex justify-center items-start">
            <div class="w-full lg:w-2/3 bg-white rounded-3xl shadow-xl p-8">
                <form action="<?= site_url('outcomes/' . $outcome['id']) ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="PUT">
                    
                    <!-- Project -->
                    <div class="mb-5">
                        <label for="project_id" class="block text-gray-700 font-semibold mb-2">Project <span class="text-red-500">*</span></label>
                        <select class="block w-full px-4 py-2 rounded-xl border border-gray-300 focus:outline-none focus:ring focus:ring-blue-200" id="project_id" name="project_id" required>
                            <option value="">Select Project</option>
                            <?php foreach ($projects as $project): ?>
                                <option value="<?= $project['id'] ?>" <?= old('project_id', $outcome['project_id']) == $project['id'] ? 'selected' : '' ?>>
                                    <?= esc($project['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                         <?php if (isset($errors['project_id'])): ?>
                            <div class="text-red-500 text-sm mt-1"><?= $errors['project_id'] ?></div>
                        <?php endif; ?>
                    </div>

                    <!-- Title -->
                    <div class="mb-5">
                        <label for="title" class="block text-gray-700 font-semibold mb-2">Title <span class="text-red-500">*</span></label>
                        <input type="text" class="block w-full px-4 py-2 rounded-xl border border-gray-300 focus:outline-none focus:ring focus:ring-blue-200" id="title" name="title" value="<?= old('title', $outcome['title']) ?>" required>
                        <?php if (isset($errors['title'])): ?>
                            <div class="text-red-500 text-sm mt-1"><?= $errors['title'] ?></div>
                        <?php endif; ?>
                    </div>

                    <!-- Description -->
                    <div class="mb-5">
                        <label for="description" class="block text-gray-700 font-semibold mb-2">Description</label>
                        <textarea class="block w-full px-4 py-2 rounded-xl border border-gray-300 focus:outline-none focus:ring focus:ring-blue-200" id="description" name="description" rows="3"><?= old('description', $outcome['description']) ?></textarea>
                    </div>

                    <!-- Link -->
                    <div class="mb-5">
                        <label for="link" class="block text-gray-700 font-semibold mb-2">Link (URL)</label>
                        <input type="url" class="block w-full px-4 py-2 rounded-xl border border-gray-300 focus:outline-none focus:ring focus:ring-blue-200" id="link" name="link" value="<?= old('link', $outcome['link']) ?>" placeholder="https://example.com">
                    </div>

                    <!-- File Upload -->
                    <div class="mb-5">
                        <label for="file_path" class="block text-gray-700 font-semibold mb-2">Upload New File (optional)</label>
                        <input type="file" class="block w-full px-4 py-2 rounded-xl border border-gray-300 focus:outline-none focus:ring focus:ring-blue-200" id="file_.path" name="file_path" accept=".pdf,.doc,.docx,.txt,.jpg,.png">
                        <div class="text-sm text-gray-500 mt-2">Supported formats: PDF, DOC, DOCX, TXT, JPG, PNG. Leave empty to keep the current file.</div>
                        <div class="mt-2">
                            <?php if ($outcome['file_path']): ?>
                                <small class="text-gray-500">Current file: `<?= esc($outcome['file_path']) ?>`</small>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex justify-between items-center mt-8">
                        <a href="<?= site_url('outcomes/' . $outcome['id']) ?>" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-3 px-6 rounded-xl shadow-md transition-colors">Cancel</a>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-xl shadow-md transition-colors">Update Outcome</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>