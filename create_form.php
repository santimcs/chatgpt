<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Portfolio</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="read.php">PHP CRUD OPERATION</a>
            <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="read.php">Home</a>
                </li>
            </ul>
            </div>
        </div>
    </nav>
    <div class="col-lg-6 m-auto">

        <form action="create.php" method="post">
            <br><br>

            <div class="card">
                <div class="card-header bg-primary">
                    <h1 class="text-white text-center">  Create New Portfolio </h1>
                </div><br>
                <!-- Display errors -->
                <?php if(isset($_GET['error'])): ?>
                    <div class="alert alert-danger" role="alert">
                        <ul>
                            <?php foreach(explode(',', $_GET['error']) as $error): ?>
                                <li><?php echo htmlspecialchars($error); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>                

                <label for="name">Name:</label>
                <input type="text" name="name" id="name" maxlength="10" required><br>
                <label for="date">Date:</label>
                <input type="date" name="date" id="date" required><br>
                <label for="qty">Quantity:</label>
                <input type="number" name="qty" id="qty" required><br>
                <label for="u_cost">Unit Cost:</label>
                <input type="number" step="0.01" name="u_cost" id="u_cost" required><br>
                <label for="active">Active:</label>
                <input type="checkbox" name="active" id="active" value="1"><br>
                <label for="period">Period:</label>
                <input type="text" name="period" id="period" maxlength="1" required><br>
                <label for="grade">Grade:</label>
                <input type="text" name="grade" id="grade" maxlength="2" required><br>
                <label for="dividend">Dividend:</label>
                <input type="number" step="0.0001" name="dividend" id="dividend" required><br>
                <input type="submit" value="Create">
            </div>
        </form>
    </div>
    <a href="read.php">Back to list</a>
</body>
</html>
