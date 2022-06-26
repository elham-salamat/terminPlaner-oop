<?php

$currentMonth = date('F');
$calendar = new calendar();

$this -> pageContent = '
                                <section id="pricing" class="pricing">
                                    <div class="container" style="width: 100%; margin-left: 0px; margin-right: 0px">
                                        <div class="row">
                                         
                                            <div class="col-lg-9 wow zoomIn">
                                                <ul class="pricing-plan list-unstyled selected">
                                                    <li class="pricing-title">
                                                        <ul>
                                                        <li style="display: inline" style="display: inline; float: left; margin-top: -20px">
                                                        <button type="button" class="btn btn-w-m btn-primary">
                                                            <a href="#">
                                                                <i style="color: white" class="fa fa-backward" id="previousyear"></i>
                                                            </a>
                                                        </button>                                                                                                                       
                                                        </li>
                        
                                                            <li style="display: inline;  margin-top: -20px; margin-left: 10px">
                                                                
                                                                    <strong style="font-size: 25px; color:white" id="yearnumber">2021</strong>
                                                              
                                                            </li>
                                                            <li style="display: inline">
                                                            <button type="button" class="btn btn-w-m btn-primary">
                                                                <a href="#">
                                                                    <i style="color: white" class="fa fa-forward" id="nextyear"></i>
                                                                </a>
                                                            </button>                                                                                                                       
                                                            </li>
                                                            <li style="display: inline">
                                                                <button id="previous" type="button" class="btn btn-w-m btn-primary">
                                                                    <a href="#">
                                                                        <i  style="color: white" class="fa fa-backward" ></i>
                                                                    </a>
                                                                </button>                                                                                                                        
                                                            </li>
                                                            <li style="display: inline">
                                                                                                                              
                                                                <strong id="monthlabel" style="font-size: 25px; color:white">';
                                                                                                                       
                                                                $this -> pageContent .= $currentMonth.'</strong>                                                        
                                                            </li>
                                                            <li style="display: inline">
                                                                <button id="next" type="button" class="btn btn-w-m btn-primary">
                                                                    <a href="#">
                                                                        <i style="color: white" class="fa fa-forward"></i>
                                                                    </a>
                                                                </button>                                                                                                                       
                                                            </li>
                                                         
                                                        </ul>
                                                    </li>
                                                    <li id="pagecontent" class="pricing-desc">';

                                                    
                                                    

                                                    $this -> pageContent .= $calendar -> monthlyCalendarCreate(date('n'), date('y'));

                                                    $this -> pageContent .= '                                             
                                                    </li>
                                                </ul>
                                            </div>

                                            <div class="col-lg-3 wow zoomIn">
                                                <ul class="pricing-plan list-unstyled">
                                                    <li class="pricing-title">
                                                        Public holiday in Germany
                                                    </li>
                                                    <li class="pricing-desc">
                                                        April, 2: Good Friday
                                                    </li>
                                                    <li class="pricing-price">
                                                        April, 4: Easter Sunday
                                                    </li>
                                                    <li>
                                                        April, 5: Easter Monday
                                                    </li>
                                                    <li>
                                                        May, 1: Labour Day
                                                    </li>
                                                    <li>
                                                        May, 13: Ascension Day
                                                    </li>
                                                    <li>
                                                        May, 24: Whit Monday
                                                    </li>
                                                    <li>
                                                        October, 3: German Unity Day
                                                    </li>
                                                    <li>
                                                        December, 25: Christmas Day
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                
                            
                                <!-- Mainly scripts -->
                                <script src="'.PATH_CORRECTION.'assets/js/jquery-2.1.1.js"></script>
                                <script src="'.PATH_CORRECTION.'assets/js/bootstrap.min.js"></script>
                                <script src="'.PATH_CORRECTION.'assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
                                <script src="'.PATH_CORRECTION.'assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

                                <!-- Custom and plugin javascript -->
                                <script src="'.PATH_CORRECTION.'assets/js/rada.js"></script>
                                <script src="'.PATH_CORRECTION.'assets/js/plugins/pace/pace.min.js"></script>
                                <script src="'.PATH_CORRECTION.'assets/js/plugins/wow/wow.min.js"></script>


                                <script>

                                    var months = ["empty","January","February", "March", "April", "May", "June","July", "August", "September", "October", "November", "December"];

                                    document.getElementById("nextyear").onclick = function(){                                                                             
                                        var yearNumber = parseInt(document.getElementById("yearnumber").innerHTML);
                                        document.getElementById("yearnumber").innerHTML = yearNumber+1;
                                        var activeMonth = document.getElementById("monthlabel").innerHTML;
                                        var activeMonthIndex = months.indexOf(activeMonth) ;
                                        var monthNumber = activeMonthIndex;
                                        changePageContent(yearNumber,monthNumber);

                                    };   

                                    document.getElementById("previousyear").onclick = function(){
                                        var yearNumber = parseInt(document.getElementById("yearnumber").innerHTML);
                                        document.getElementById("yearnumber").innerHTML = yearNumber-1;
                                        var activeMonth = document.getElementById("monthlabel").innerHTML;
                                        var activeMonthIndex = months.indexOf(activeMonth) ;
                                        var monthNumber = activeMonthIndex;
                                        changePageContent(yearNumber,monthNumber);
                                        
                                    };   
                                    
                                    

                                    document.getElementById("previous").onclick = function(){myFunction()};
                                    function myFunction()
                                    {
                                        var activeMonth = document.getElementById("monthlabel").innerHTML;
                                        var activeMonthIndex = months.indexOf(activeMonth);
                                        var yearNumber = parseInt(document.getElementById("yearnumber").innerHTML);
                                        if (activeMonthIndex != 1)
                                        {
                                            var monthNumber = activeMonthIndex-1;
                                            document.getElementById("monthlabel").innerHTML = months[monthNumber];
                                            changePageContent(yearNumber,monthNumber);
                                        } 
                                                                                                                                         
                                    }

                                    
                                    document.getElementById("next").onclick = function(){myFunction1()};   
                                    function myFunction1()
                                    {
                                        var activeMonth = document.getElementById("monthlabel").innerHTML;
                                        var activeMonthIndex = months.indexOf(activeMonth);
                                        var yearNumber = parseInt(document.getElementById("yearnumber").innerHTML);
                                        if (activeMonthIndex != 12)
                                        {
                                            var monthNumber = activeMonthIndex+1;
                                            document.getElementById("monthlabel").innerHTML = months[monthNumber];
                                            changePageContent(yearNumber,monthNumber);
                                        }
                                                                                                                                               
                                    }

                        


                                    function changePageContent(year, month)
                                    {
                                        var pageContent = document.getElementById("pagecontent");                                        
                                        var xhttp = new XMLHttpRequest(); 	
                                        xhttp.open("POST", "/'.BASIC_PATH.'/showcalendar", true); 
                                        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");	
                                                                        
                                        xhttp.send("year="+year+"&month="+month);	
                                        xhttp.onreadystatechange = function()
                                        {
                                            if(this.readyState == 4 && this.status == 200)
                                            {
                                                pageContent.innerHTML = xhttp.responseText;
                                            }			
                                        }	

                                    }


                                    $(document).ready(function () {

                                        $("body").scrollspy({
                                            target: ".navbar-fixed-top",
                                            offset: 80
                                        });

                                        // Page scrolling feature
                                        $("a.page-scroll").bind("click", function(event) {
                                            var link = $(this);
                                            $("html, body").stop().animate({
                                                scrollTop: $(link.attr("href")).offset().top - 50
                                            }, 500);
                                            event.preventDefault();
                                            $("#navbar").collapse("hide");
                                        });
                                    });

                                    var cbpAnimatedHeader = (function() {
                                        var docElem = document.documentElement,
                                                header = document.querySelector( ".navbar-default"),
                                                didScroll = false,
                                                changeHeaderOn = 200;
                                        function init() {
                                            window.addEventListener("scroll", function( event ) {
                                                if( !didScroll ) {
                                                    didScroll = true;
                                                    setTimeout( scrollPage, 250 );
                                                }
                                            }, false );
                                        }
                                        function scrollPage() {
                                            var sy = scrollY();
                                            if ( sy >= changeHeaderOn ) {
                                                $(header).addClass("navbar-scroll")
                                            }
                                            else {
                                                $(header).removeClass("navbar-scroll")
                                            }
                                            didScroll = false;
                                        }
                                        function scrollY() {
                                            return window.pageYOffset || docElem.scrollTop;
                                        }
                                        init();

                                    })();

                                    // Activate WOW.js plugin for animation on scrol
                                    new WOW().init();

                                </script>


                            </body>
                            </html>';



                        