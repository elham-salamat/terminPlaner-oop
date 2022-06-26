<?php

$this -> pageContent = '
                        <body class="gray-bg">
                            <div class="middle-box text-center loginscreen animated fadeInDown">
                                <div>
                                    <div>
                                        <h1 class="logo-name">TP</h1>
                                    </div>
                                    <h3>Welcome to Termin Planer</h3>
                                    <p>Are you searching for an efficient way to organize your life.</p>
                                    <p>Sign in to TP to see its capability.</p>
                                    <form class="m-t" method= "POST">
                                            <div class="form-group">
                                                <input type="text" name="username" class="form-control" placeholder="Username">
                                            </div>
                                            <div class="form-group">
                                                <input type="password" name="pwd" class="form-control" placeholder="Password">
                                            </div>  
                                            <button type="submit" value="S1" name="signin" class="btn btn-primary block full-width m-b">Sign In</button>
                                            <p class="text-muted text-center"><small>Do not have an account?</small></p>
                                            <a class="btn btn-sm btn-white btn-block" href="/'.BASIC_PATH.'/signup">Create an account</a>
                                    </form>
                                    <p class="m-t"> <strong>All rights reserved</strong> 2021 &copy; <a href="#" target="_blank">Razieh Salamat</a></small> </p>
                                </div>
                            </div>

                            <!-- Mainly scripts -->
                            <script src="'.PATH_CORRECTION.'assets/js/jquery-2.1.1.js"></script>
                            <script src="'.PATH_CORRECTION.'assets/js/bootstrap.min.js"></script>

                            <!-- iCheck -->
                            <script src="'.PATH_CORRECTION.'assets/js/plugins/iCheck/icheck.min.js"></script>
                                <script>
                                    $(document).ready(function (){
                                    $(".i-checks").iCheck({
                                    checkboxClass: "icheckbox_square-green",
                                    radioClass: "iradio_square-green",
                                    });
                                    });
                                </script>
                        </body>
                    </html>
                    ';




