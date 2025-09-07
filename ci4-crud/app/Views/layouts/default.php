<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->renderSection('title') ?> | Capstone Dashboard</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: 'Roboto', Arial, sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            background: url('https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1500&q=80') no-repeat center center fixed;
            background-size: cover;
        }
        .header {
            background: rgba(0,0,0,0.7);
            color: #fff;
            padding: 1rem 2rem;
            display: flex;
            align-items: center;
        }
        .header img {
            height: 48px;
            margin-right: 1rem;
        }
        .header h1 {
            font-size: 2rem;
            font-weight: 700;
            letter-spacing: 2px;
        }
        .main-content {
            background: rgba(255,255,255,0.95);
            margin: 2rem auto;
            border-radius: 12px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.1);
            max-width: 900px;
            padding: 2rem;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/3f/Logo_Capstone_Project.png/320px-Logo_Capstone_Project.png" alt="Capstone Logo">
        <h1>Capstone Dashboard</h1>
    </div>
    <div class="main-content">
        <?= $this->renderSection('content') ?>
    </div>
</body>
</html>
