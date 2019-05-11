<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <!-- Compiled and minified CSS -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Compiled and minified JavaScript -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <title>Internet Application Programming</title>
</head>
<body>
    <div class="container">
        <h3>Registration Form</h3>
        <div class="row">
            <div class="col s12">
                <div class="row">
                    <div class="input-field col s12">
                        <input placeholder="First Name" id="first_name" type="text" class="validate" name = 'first_name'>
                        <label for="first_name">First Name</label>
                    </div>
                    <div class="input-field col s12">
                        <input placeholder="Last Name" id="last_name" type="text" class="validate" name = 'last_name'>
                        <label for="last_name">Last Name</label>
                    </div>
                    <div class="input-field col s12">
                        <input placeholder="City" id="city_name" type="text" class="validate" name = 'city_name'>
                        <label for="city_name">City</label>
                    </div>
                    <div class="center input-field col s12">
                        <button class="btn waves-effect waves-light" type="submit" name="submit-btn">Submit
                            <i class="material-icons right">send</i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>