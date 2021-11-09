<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Register</title>
    
    <!-- boostrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>

<body class="bg-dark">
    <div class="account-pages my-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-pattern shadow-none">
                        <div class="card-body p-3">
                            <div class="px-3">
                                <h4 class="font-18 text-center">Register Page</h4>
                                <p class="text-muted text-center mb-4">Get your Account And Lets Shopping.</p>
                                <form class="form-horizontal" action="{{ route('post.register') }}" method="post">
                                    @csrf
                                    <div class="form-group mb-1">
                                        <label for="username">Username</label>
                                        <input name="username" type="text" class="form-control" id="username" placeholder="Enter username">
                                        @error('username') <div class="text-danger">{{$message}}</div>@enderror
                                    </div>
                                    
                                    <div class="form-group mb-1">
                                        <label for="useremail">Email</label>
                                        <input name="email" type="email" class="form-control" id="useremail" placeholder="Enter email">
                                        @error('email') <div class="text-danger">{{$message}}</div>@enderror
                                    </div>

                                    <div class="form-group mb-1">
                                        <label for="password">Password</label>
                                        <input name="password" type="password" class="form-control" id="password" placeholder="Enter password">
                                        @error('password') <div class="text-danger">{{$message}}</div>@enderror
                                    </div>

                                    <div class="form-group mb-1">
                                        <label for="repassword">Confirm Password</label>
                                        <input name="confirm-password" type="password" class="form-control" id="repassword" placeholder="Enter Confirm password">
                                        @error('confirm-password') <div class="text-danger">{{$message}}</div>@enderror
                                    </div>

                                    <div class="mt-4">
                                        <button class="btn btn-dark btn-block waves-effect waves-light" type="submit">Register</button>
                                    </div>

                                    <div class="mt-4 text-center">
                                        <p class="mb-0">Already have an account ? <a href="/login" class="font-500 "> Login </a> </p>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

</body>

</html>