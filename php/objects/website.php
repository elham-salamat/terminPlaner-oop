<?php

class website
{
    public $navigationLinks = "links";
    public $headPart;
    protected $pageContent = "not available at the moment";


    public function __construct($links, $pageContent)
    {
        $this -> navigationLinks = $links;
        $this -> pageContent = $pageContent;
    }

    protected function webPagesCreation()
	{
        $this -> headPart = '<html lang="en">
        <head>
            
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="description" content="">
            <meta name="author" content="">
            <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
            
            <title>TP-homepage</title>

            <link rel="stylesheet" type="text/css" href="'.PATH_CORRECTION.'assets/wizard/css/raleway-font1.css">
            <link rel="stylesheet" type="text/css" href="'.PATH_CORRECTION.'assets/wizard/fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">
            <!-- Jquery -->
            <link rel="stylesheet" href="https://jqueryvalidation.org/files/demo/site-demos.css">
            <!-- Main Style Css -->
            <link rel="stylesheet" href="'.PATH_CORRECTION.'assets/wizard/css/stylecolorlib.css"/>
            <link href="'.PATH_CORRECTION.'assets/css/bootstrap.min.css" rel="stylesheet">
            <link href="'.PATH_CORRECTION.'assets/css/animate.css" rel="stylesheet">
            <link href="'.PATH_CORRECTION.'assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
            <link href="'.PATH_CORRECTION.'assets/css/style.css" rel="stylesheet">

        </head>';
    
        $string = "";
        if (SELECTED_PAGE == "/")
        {
            $string .= $this -> headPart;
            $string .= '
                        <body id="page-top" class="landing-page">
                            <div class="navbar-wrapper">
                                <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
                                    <div class="container">
                                        <div class="navbar-header page-scroll">
                                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                                <span class="sr-only">Toggle navigation</span>
                                                <span class="icon-bar"></span>
                                                <span class="icon-bar"></span>
                                                <span class="icon-bar"></span>
                                            </button>
                                        </div>
                                        <div id="navbar" class="navbar-collapse collapse">
                                            <ul class="nav navbar-nav navbar-right" style="margin-top: 40px">';
                                
            $string .= $this -> navigationLinks;
            $string .= '
                            </ul>
                            <ul class="nav navbar-top-links navbar-left" style="margin-left: -200px">
                                <li>
                                    <a href="">
                                    <h1 style="font-weight: bold;">Termin Planer</h1>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
            <div id="inSlider" class="carousel carousel-fade" data-ride="carousel">
                <div class="carousel-inner" role="listbox">  
                    <div class="header-back two"></div>
                </div>    
            </div>';
            $string .= $this -> pageContent;
            }
            else
            {
                $string .= $this -> headPart;
                $string .= $this -> pageContent;
            }
        
        return $string;
	}

	public function __toString()
	{
		return $this-> webPagesCreation();
	}	
}
