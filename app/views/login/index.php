<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9 my-5"><br>

            <?php Flasher::flash(); ?>

            <div class="card o-hidden border-0 shadow-lg">
                <div class="card-body p-0">

                    <div class="row">
                        <!-- Side image -->
                        <div class="col-lg-6 d-none d-lg-block bg-image"></div>

                        <!-- Login form -->
                        <div class="col-lg-6">
                            <div class="p-5">

                                <!-- Login title -->
                                <div class="text-center"><br><br>
                                    <h1 class="h2 text-gray-900 mb-4 accent-font font-weight-bold">LOGIN</h1>
                                    <br>
                                </div>

                                <!-- Login form -->
                                <form class="user" method="post" action="Login/login_handler" autocomplete="off">

                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Username" value="<?= isset($_COOKIE['cUsername']) ? $_COOKIE['cUsername'] : ''; ?>">
                                    </div>

                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password" value="<?= isset($_COOKIE['cPassword']) ? $_COOKIE['cPassword'] : ''; ?>">
                                    </div>

                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <input name="remember" type="checkbox" class="custom-control-input" id="remember" <?= isset($_COOKIE['cRemember']) ? 'checked' : ''; ?>>
                                            <label class="custom-control-label" for="remember">Remember Me</label>
                                        </div>
                                    </div>

                                    <button class="btn btn-primary btn-user btn-block" type="submit">
                                    Login
                                    </button>

                                    <br><br><br>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>