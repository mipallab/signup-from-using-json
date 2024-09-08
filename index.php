<?php

if (file_exists(__DIR__ . "/autoload.php")) {
    require_once(__DIR__ . "/autoload.php");
} else {
    echo "autoload.php not found";
}
$msg = "";

// if user click sumbit button
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $username = $_POST['username'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $location = $_POST['location'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $photo = $_POST['photo'] ?? '';

    if (empty($name) || empty($email) || empty($username) || empty($phone) || empty($location) || empty($gender) || empty($photo)) {
        $msg = msg("All field are required!");
    } else if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
        $emErr = "border-warning offset-warning";
        $msg = msg("Not a Valid Email", "warning");
    } else {
        $msg = msg("Data Stable", "success");
        $_POST = [];


        // store data to JSON DB
        $data = json_decode(file_get_contents(__DIR__ . '/db/data.json'), true);
        $user_data = [
            "name"      => $name,
            'email'     => $email,
            "username"  => $username,
            'phone'     => $phone,
            'location'  => $location,
            'gender'    => $gender,
            'photo'     => $photo
        ];

        array_push($data, $user_data);

        file_put_contents(__DIR__ . '/db/data.json', json_encode($data));
    }
}





?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Form</title>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assects/css/style.css">
</head>

<body>


    <div class="container">
        <div class="row mt-5">

            <!-- form section -->
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-header">
                        <h1>Add Team Member</h1>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

                            <?php echo $msg; ?>

                            <div class="field mb-3">
                                <label for="">Name</label>
                                <input type="text" class="form-control <?php echo fieldErr($name); ?>" name="name"
                                    value="<?php echo old('name'); ?>">
                            </div>
                            <div class="field mb-3">
                                <label for="">Email</label>
                                <input type="text" class="form-control <?php echo fieldErr($email);
                                                                        echo $emErr ?? ''; ?>" name="email"
                                    value="<?php echo old('email'); ?>">
                            </div>
                            <div class="field mb-3">
                                <label for="">Username</label>
                                <input type="text" class="form-control <?php echo fieldErr($username); ?>"
                                    name="username" value="<?php echo old('username'); ?>">
                            </div>
                            <div class="field mb-3">
                                <label for="">Phone</label>
                                <input type="tel" class="form-control <?php echo fieldErr($phone); ?>" name="phone"
                                    value="<?php echo old('phone'); ?>">
                            </div>
                            <div class="field mb-3">
                                <label for="">Location</label>
                                <select name="location" id="" class="form-select <?php echo fieldErr($location); ?>">
                                    <option value="">--select--</option>
                                    <option <?php echo (old('location') == 'narshingdi') ? 'selected' : ''; ?>
                                        value="narshingdi">
                                        Narshingdi</option>
                                    <option <?php echo (old('location') == 'dhaka') ? 'selected' : ''; ?> value="dhaka">
                                        Dhaka</option>
                                    <option <?php echo (old('location') == 'gazipur') ? 'selected' : ''; ?>
                                        value="gazipur">Gazipur</option>
                                    <option <?php echo (old('location') == 'narayanjong') ? 'selected' : ''; ?>
                                        value="narayanjong">Narayanjong</option>
                                    <option <?php echo (old('location') == 'brammanbaria') ? 'selected' : ''; ?>
                                        value="brammanbaria">Brammanbaria</option>
                                </select>
                            </div>
                            <div class="field mb-3 mt-2">
                                <label class="form-check-lebel ">Gender </label><br>
                                <label>
                                    <input type="radio" <?php echo (old('gender') == 'male') ? 'checked' : ''; ?>
                                        class="form-check-input me-1" name="gender" value="male">Male
                                </label>
                                <label>
                                    <input type="radio" <?php echo (old('gender') == 'female') ? 'checked' : ''; ?>
                                        class="form-check-input me-1" name="gender" value="female">Female
                                </label>
                            </div>
                            <div class="field mb-3">
                                <label for="">Photo</label>
                                <input type="text" class="form-control <?php echo fieldErr($photo); ?>" name="photo"
                                    value="<?php echo old('photo'); ?>">
                            </div>

                            <div class="mt-3">
                                <input type="submit" class="btn btn-primary" value="Send">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- member section -->
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header">
                        <h2>Team List</h2>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="col">id</th>
                                    <th class="col">Name</th>
                                    <th class="col">Email</th>
                                    <th class="col">User</th>
                                    <th class="col">Photo</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $sl = 0;
                                $get_data = json_decode(file_get_contents(__DIR__ . '/db/data.json'));
                                foreach ($get_data as $user):
                                    $sl++;
                                ?>
                                <tr class="align-middle">
                                    <th><?php echo $sl;?></th>
                                    <td><?php echo $user->name; ?></td>
                                    <td><?php echo $user->email; ?></td>
                                    <td><?php echo $user->username; ?></td>
                                    <td><img class="" width="100" src="<?php echo $user->photo; ?>" alt=""></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script scr="//cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js">
    </script>
</body>

</html>