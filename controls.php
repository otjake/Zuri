<?php
ob_start();
session_start();

###### REGISTER USER ##############################################

    if (isset($_POST["register"])) {

        $error = [];

        //check if any input field is empty
        if (empty($_POST['name'])) {
            array_push($error, "Name can't be empty");
        }
        $name = $_POST['name'];

        if (empty($_POST['email'])) {
            array_push($error, "Email can't be empty");
        }
        $email = $_POST['email'];
        if (empty($_POST['password'])) {
            array_push($error, "How do you login without a password for Christ sake");
        }
        $password = $_POST['password'];


        //check if errors exist
        if (count($error) === 0) {

            //check if file exist if it doesnt create

            if(!file_exists("database.json")) {
            fopen("database.json", "w");
                }



            //open the file
            $file = file_get_contents('database.json');
            $data = json_decode($file, true);


            //allocating unique ids
            if (is_array($data) && count($data) === 0) {
                $id = 1;
            } else if (!is_array($data)) {
                $id = 1;
                $data = [];
            } else {

                $TempIdArray=[];
                //collect each id
                foreach ($data as $item){
                    //put into out temporary array and force to be integer
                    array_push($TempIdArray,(int)($item['id']));
                }
                //add one and make unique id for new user
                $id =  max($TempIdArray) + 1;
            }

            $detailsArray = [
                'id' => $id,
                'name' => $name,
                'email' => $email,
                'password' => $password,
            ];


            array_push($data, $detailsArray);
            file_put_contents("database.json", json_encode($data));

            echo "Registration successfull <a href='login.php'>Login</a>";

//    header("Location:register.php?marker=2");
        } else {

            foreach ($error as $err) {
                echo "<p> $err </p>";
            }
            echo
            "Go back and try again  <br>
           <a href='register.php'>Register</a>";
        }


    }


###### LOGIN USER ##############################################


    if (isset($_POST["login"])) {

        $error = [];
        if (empty($_POST['email'])) {
            array_push($error, "Email can't be empty");
        }
        $email = $_POST['email'];
        if (empty($_POST['password'])) {
            array_push($error, "How do you login without a password for Christ sake");
        }
        $password = $_POST['password'];

        if (count($error) === 0) {

            //if file dosent exist create and check
            if(!file_exists("database.json")) {
                fopen("database.json", "w");
            }

            $file = file_get_contents('database.json');
            $data = json_decode($file, true);

            //check if details are correct
if(is_array($data)) {
    $result = array_filter($data, function ($array) {
        return $array['email'] === $_POST['email'] && $array['password'] === $_POST['password'];
    });
    if (count($result) > 0) {
//        if details are correct save to session
        foreach ($result as $item)
            $_SESSION['id'] = $item['id'];
        $_SESSION['name'] = $item['name'];
        $_SESSION['email'] = $item['email'];
        header("Location:index.php");
    } else {

        echo
        "Try check your details  <br>
           <a href='login.php'>Login again</a>";
    }


}else{
    echo "data does not exist <a href='register.php'>Register</a>";
}

        } else {
            foreach ($error as $err) {
                echo "<p> $err </p>";
            }
            echo
            "Correct errors above  <br>
           <a href='login.php'>Login again</a>";
        }

    }


###### UPDATE PASSWORD ##############################################

    if (isset($_POST['update'])) {
        $error = [];

        if (empty($_POST['password'])) {
            array_push($error, "How do you login without a password for Christ sake");
        }

        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

//check if errors exist
        if (count($error) === 0) {
            $file = file_get_contents('database.json');
            $data = json_decode($file, true);


            $detailsArray = [
                'id' => $id,
                'name' => $name,
                'email' => $email,
                'password' => $password,
            ];

            //Make sure data exist in our data base
            $check = array_filter($data, function ($array) {
                return $array['id'] == $_POST['id'];
            });

                //getting all other data asides data to be updated
            $NewArray = array_filter($data, function ($array) {
                return $array['id'] != $_POST['id'];
            });

//            if it exists?
            if (count($check) > 0) {
                array_push($NewArray, $detailsArray);

                //empty database file
                file_put_contents("database.json", "");

                //re-populate file with updated details
                file_put_contents("database.json", json_encode($NewArray));

                header("Location:index.php?status=1");

            } else {
                echo "This data dose not exist in the database";
            }
        }else{
            echo "Why do you want to use empty for password,Explain?
            <a href='index.php'>Go back joor</a>";
        }

    }

?>
