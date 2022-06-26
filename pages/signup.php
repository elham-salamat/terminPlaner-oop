<?php
$this->pageContent = '
                            <body class="gray-bg">
                                <div class="middle-box text-center loginscreen animated fadeInUp">
                                    <div>
                                        <div>
                                            <h1 class="logo-name">TP</h1>
                                        </div>
                                        <h3>Register to Termin Planer</h3>
                                        <p>Create account to see it in action.</p>
                                        <form class="m-t" role="form" method="POST">
                                            <div class="form-group">
                                                <input name="firstname" type="text" class="form-control" placeholder="First Name*">
                                            </div>
                                            <div class="form-group">
                                                <input name="lastname" type="text" class="form-control" placeholder="Last Name*">
                                            </div>
                                            <div class="form-group">
                                                <input name="username" type="text" class="form-control" placeholder="Username*">
                                            </div>
                                            <div class="form-group">
                                                <input name="email" type="email" class="form-control" placeholder="Email*">
                                            </div>
                                            <div class="form-group">
                                                <input name="pwd" type="password" class="form-control" placeholder="Password*">
                                            </div>
                                            <div class="form-group">
                                                <input name="re-pwd" type="password" class="form-control" placeholder="Repeat Password*">
                                            </div>
                                            <div class="form-group">
                                                <select class="form-control m-b" name="flag">
                                                <option>select country</option>
                                                <option value="DE">Germany</option>
                                                <option value="IR">Iran, Islamic Republic of</option>
                                                <option value="US">United States</option>
                                                </select>
                                            </div>
                                            <button name="signup" value="S1" type="submit" class="btn btn-primary block full-width m-b">Sign Up</button>                               
                                            <p class="text-muted text-center"><small>Already have an account?</small></p>
                                            <a class="btn btn-sm btn-white btn-block" href="/' . BASIC_PATH . '/signin">Sign in</a>
                                        </form>
                                        <p class="m-t"><strong>All rights reserved</strong> 2021 &copy; <a href="#" target="_blank">Razieh Salamat</a></p>
                                    </div>
                                </div>

                                <!-- Mainly scripts -->
                                <script src="' . PATH_CORRECTION . 'assets/js/jquery-2.1.1.js"></script>
                                <script src="' . PATH_CORRECTION . 'assets/js/bootstrap.min.js"></script>
                                <!-- iCheck -->
                                <script src="' . PATH_CORRECTION . 'assets/js/plugins/iCheck/icheck.min.js"></script>
                                <script>
                                    $(document).ready(function(){
                                        $(".i-checks").iCheck({
                                            checkboxClass: "icheckbox_square-green",
                                            radioClass: "iradio_square-green",
                                        });
                                    });
                                </script>
                            </body>
                        </html>
                        ';
