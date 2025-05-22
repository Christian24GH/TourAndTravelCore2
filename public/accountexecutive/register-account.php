<?php
    require_once __DIR__ . '/database/connect.php';

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        require_once __DIR__ . '/database/connect.php';
        require_once __DIR__ . '/database/crud.php';
        
        $fields = [
            'username' => 'string',
            'firstname' => 'string',
            'lastname' => 'string',
            'gender' => 'string',
            'address' => 'string',
            'dateofbirth' => 'string',
            'role' => 'string',
            'email' => 'email',
            'contact_no' => 'int',
        ];
        $data = [];
        foreach ($fields as $field => $type) {
            $data[$field] = sanitizeInput($field, $type);
        }

        $password = $_POST['password'];
        $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        $data['notes'] = htmlspecialchars($_POST['notes']);

        $result = create('user_tbl', $data);
        
        if ($result['success']) {
            echo "<script>alert('" . "Account Successfully Created!" . "');</script>";
            echo "<script>" . "window.location.href = 'index.php';" . "</script>";
        } else {
            $regError = "Registration Error: " . $result['message'];
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Account</title>
    <link rel="stylesheet" href="vendor/bootstrap/bootstrap.min.css">
    <link href="home/css/global.css" rel="stylesheet">
    <link href="home/images/bpm_logo_hospital.jpg" type="image/png" rel="icon">
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
<script src="main.js"></script>

    <!-- <form class='mainform' action="" method='POST'>
        <sub>Username</sub>
        <input type='text' name='username' placeholder='Enter Username...' require autocomplete='off'></input>
        
        <sub>Password</sub>
        <span>
            <input style='width:85%;' type='password' name='password' id='password' placeholder='Enter Password...' require autocomplete='off'></input>
            <button style='font-size:2rem;' type="button" onclick="togglePassword()">👁</button>
        </span>

        <sub>Name</sub>
        <input type='text' name='firstname' placeholder='Enter Firstname...' require autocomplete='off'></input>
        <input type='text' name='lastname' placeholder='Enter Lastname...' require autocomplete='off'></input>

        <sub>Gender</sub>
        <section>
            <input type='radio' name='gender' value='m'>Male  
            <input type='radio' name='gender' value='f'>Female  
            <input type='radio' name='gender' value='o'>Other
        </section>

        <sub>Address</sub>
        <input type='text' name='address' placeholder='Enter Address...' require autocomplete='off'></input>
        
        <sub>Date of Birth</sub>
        <input type='date' name='dateofbirth' require autocomplete='off'></input>

        <div>
            <select name="role">
                <option value='patient'>patient</option>
            </select>
        </div>

        <sub>Email</sub>
        <input type='text' name='email' placeholder='Enter Email...' require autocomplete='off'></input>

        <sub>Contact no.</sub>
        <input type='number' name='contact_no' maxlength='10' placeholder='Enter Contact Number...' require autocomplete='off'></input>

        <sub>Notes</sub>
        <textarea name='notes' col='25' row='5' placeholder='Enter Notes..' require autocomplete='off'></textarea>
        
        <div class='sort-bar'>
            <a class='delete cancel' href='index.php'>Cancel</a>
            <button class='create' type='submit'>Create</button>
        </div>
    </form> -->

<section class="h-100 gradient-form">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-xl-10">
        <div class="card rounded-3 text-black">
          <div class="row g-0">
            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
              <div class="px-3 py-4 p-md-5 mx-md-4">
                <h4 class="mb-4">We'll take you anywhere.</h4>
                <p class="small mb-0">Travels and Tours.</p>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="card-body p-md-5 mx-md-4">

                <div class="text-center">
                  <h4 class="mt-1 mb-5 pb-1">Register</h4>
                </div>

                <form method="POST" action="">
                  <p><?php if (!empty($regError)){ echo htmlspecialchars($regError); } ?></p>

                  <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label" for="form2Example11">Username</label>
                    <input type="text" id="form2Example11" name="username" class="form-control" placeholder="Enter Username"/>
                  </div>

                  <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label" for="form2Example22">Password</label>
                    <button type="button" style="border:0;" onclick="seeCharacters('form2Example22')">👁</button>
                    <input type="password" id="form2Example22" name="password" class="form-control" placeholder="Enter Password" />
                  </div>

                  <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label" for="form2Example33">Name</label>
                    <input type="text" id="form2Example33" name="firstname" class="form-control" placeholder="Enter Firstname"/>
                    <input type="text" id="form2Example44" name="lastname" class="form-control" placeholder="Enter Lastname"/>
                  </div>

                  <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label" for="form2Example55">Gender</label>
                    <input type='radio' name='gender' value='m'>Male  
                    <input type='radio' name='gender' value='f'>Female  
                    <input type='radio' name='gender' value='o'>Other
                  </div>

                  <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label" for="form2Example66">Address</label>
                    <input type="text" id="form2Example66" name="address" class="form-control" placeholder="Enter Address"/>
                  </div>

                  <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label" for="form2Example77">Date of birth</label>
                    <input type="date" id="form2Example77" name="dateofbirth" class="form-control"/>
                  </div>

                  <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label" for="form2Example88">Role</label>
                    <select name="role" id="form2Example88">
                        <option value='patient'>client</option>
                    </select>
                  </div>

                  <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label" for="form2Example99">Email</label>
                    <input type="text" id="form2Example99" name="email" class="form-control" placeholder="Enter Email"/>
                  </div>

                  <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label" for="form2Example1010">Contact Number</label>
                    <input type="text" id="form2Example1010" name="Contact_no" class="form-control" placeholder="Enter Contact Number" maxlength='10'/>
                  </div>

                  <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label" for="form2Example1111">Notes</label>
                    <textarea type="text" id="form2Example1111" name="notes" class="form-control" placeholder="Enter Notes"  col='25' row='5'></textarea>
                  </div>

                  <div class="text-center pt-1 mb-5 pb-1">
                    <button data-mdb-button-init data-mdb-ripple-init class="btn btn-success btn-block fa-lg gradient-custom-2 mb-3" type="submit">Submit</button>
                  </div>

                  <div class="d-flex align-items-center justify-content-center pb-4">
                    <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-danger" onclick="window.location.href='index.php'">Cancel</button>
                  </div>

                </form>

              </div>
            </div>
            
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

</body>
</html>