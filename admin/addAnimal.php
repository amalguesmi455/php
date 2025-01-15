<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Add Animal</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-primary">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-8 col-md-10">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Add New Animal</h1>
                        </div>

                        <!-- PHP to handle form submission -->
                        <?php
                        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                            require '../classes/Animal.php'; // Include the Animal class

                            $uploadDir = '../uploads/';
                            $uploadFile = $uploadDir . basename($_FILES['animal_image']['name']);

                            if (move_uploaded_file($_FILES['animal_image']['tmp_name'], $uploadFile)) {
                                $animal = new Animal();
                                $data = [
                                    'nom' => $_POST['nom'],
                                    'categorie' => $_POST['categorie'],
                                    'age' => $_POST['age'],
                                    'description' => $_POST['description'],
                                    'prix' => $_POST['prix']
                                ];
                                $animal->addAnimal($data, $uploadFile);

                                header("Location: animals.php");
                            } else {
                                echo "Failed to upload image.";
                            }
                        }
                        ?>

                        <form class="user" action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <input type="text" name="nom" class="form-control form-control-user" placeholder="Animal Name" required>
                            </div>
                            <div class="form-group">
                                <input type="text" name="categorie" class="form-control form-control-user" placeholder="Category" required>
                            </div>
                            <div class="form-group">
                                <input type="number" name="age" class="form-control form-control-user" placeholder="Age" required>
                            </div>
                            <div class="form-group">
                                <textarea name="description" class="form-control form-control-user" placeholder="Description" required></textarea>
                            </div>
                            <div class="form-group">
                                <input type="number" step="0.01" name="prix" class="form-control form-control-user" placeholder="Price" required>
                            </div>
                            <div class="form-group">
                                <input type="file" name="animal_image" class="form-control form-control-user" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">Add Animal</button>
                        </form>

                         <!-- Return button -->
                         <div class="text-center mt-3">
                            <a href="animals.php" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
