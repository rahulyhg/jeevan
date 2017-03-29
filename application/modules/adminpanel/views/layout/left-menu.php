<nav class="navbar navbar-default" role="navigation">
    <div class="side-menu-container">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">
                <div class="icon logo_fav">
                    <img src="<?php echo load_lib(); ?>theme/images/logo_fav.png" alt="" />
                </div>
                <div class="title logo">
                    <?php // echo get_label('site_title');?>
                    <img src="<?php echo load_lib(); ?>theme/images/logo.png" alt="" />
                </div>
            </a>
            <button type="button" class="navbar-expand-toggle pull-right visible-xs">
                <i class="fa fa-times icon"></i>
            </button>
        </div>
        <ul class="nav navbar-nav">
            <li class="<?php echo ($module == "dashboard") ? 'active' : ''; ?>">
                <a href="<?php echo admin_url() . "dashboard" ?>">
                    <span class="icon fa fa-tachometer"></span><span class="title">Dashboard</span>
                </a>
            </li>

            <li class="<?php echo ($module == "user") ? 'active' : ''; ?>">
                <a href="<?php echo admin_url() . "user" ?>">
                    <span class="icon fa fa-users"></span><span class="title">Site Users</span>
                </a>
            </li>
            <li class="<?php echo ($module == "cmspage") ? 'active' : ''; ?>">
                <a href="<?php echo admin_url() . "cmspage" ?>">
                    <span class="icon fa fa-slack"></span><span class="title">Pages</span>
                </a>
            </li>   
            <li class="<?php echo ($module == "menugroups") ? 'active' : ''; ?>">
                <a href="<?php echo admin_url() . "menugroups" ?>">
                    <span class="icon fa fa-bars"></span><span class="title">Site Menus</span>
                </a>
            </li>   
            <li class="<?php echo ($module == "blocks") ? 'active' : ''; ?>">
                <a href="<?php echo admin_url() . "blocks" ?>">
                    <span class="icon fa fa-th-large"></span><span class="title">Widget Blocks</span>
                </a>
            </li>       
            </li>   
            <li class="<?php echo ($module == "photooftheday") ? 'active' : ''; ?>">
                <a href="<?php echo admin_url() . "photooftheday" ?>">
                    <span class="icon fa fa-picture-o"></span><span class="title">Photo of the day</span>
                </a>
            </li>          
            </li>   
            <li class="<?php echo ($module == "gallerycategories") ? 'active' : ''; ?>">
                <a href="<?php echo admin_url() . "gallerycategories" ?>">
                    <span class="icon fa fa-th"></span><span class="title">Media Gallery</span>
                </a>
            </li>         
            </li>   
            <li class="<?php echo ($module == "routeplan") ? 'active' : ''; ?>">
                <a href="<?php echo admin_url() . "routeplan" ?>">
                    <span class="icon fa fa-map"></span><span class="title">Route Plan</span>
                </a>
            </li>   
             <li class="<?php echo ($module == "events") ? 'active' : ''; ?>">
                <a href="<?php echo admin_url() . "events" ?>">
                    <span class="icon fa fa-calendar"></span><span class="title">Events</span>
                </a>
            </li>    
            <li class="<?php echo ($module == "emailtemplates") ? 'active' : ''; ?>">
                <a href="<?php echo admin_url() . "emailtemplates" ?>">
                    <span class="icon fa fa-envelope-o"></span><span class="title">Email Setting</span>
                </a>
            </li>      
            <?php /* ?>
              <li class="panel panel-default dropdown">
              <a data-toggle="collapse" href="#dropdown-table">
              <span class="icon fa fa-table"></span><span class="title">Table</span>
              </a>
              <!-- Dropdown level 1 -->
              <div id="dropdown-table" class="panel-collapse collapse">
              <div class="panel-body">
              <ul class="nav navbar-nav">
              <li><a href="table/table.html">Table</a>
              </li>
              <li><a href="table/datatable.html">Datatable</a>
              </li>
              </ul>
              </div>
              </div>
              </li>
              <li class="panel panel-default dropdown">
              <a data-toggle="collapse" href="#dropdown-form">
              <span class="icon fa fa-file-text-o"></span><span class="title">Form</span>
              </a>
              <!-- Dropdown level 1 -->
              <div id="dropdown-form" class="panel-collapse collapse">
              <div class="panel-body">
              <ul class="nav navbar-nav">
              <li><a href="form/ui-kits.html">Form UI Kits</a>
              </li>
              </ul>
              </div>
              </div>
              </li>
              <!-- Dropdown-->
              <li class="panel panel-default dropdown">
              <a data-toggle="collapse" href="#component-example">
              <span class="icon fa fa-cubes"></span><span class="title">Components</span>
              </a>
              <!-- Dropdown level 1 -->
              <div id="component-example" class="panel-collapse collapse">
              <div class="panel-body">
              <ul class="nav navbar-nav">
              <li><a href="components/pricing-table.html">Pricing Table</a>
              </li>
              <li><a href="components/chartjs.html">Chart.JS</a>
              </li>
              </ul>
              </div>
              </div>
              </li>
              <!-- Dropdown-->
              <li class="panel panel-default dropdown">
              <a data-toggle="collapse" href="#dropdown-example">
              <span class="icon fa fa-slack"></span><span class="title">Page Example</span>
              </a>
              <!-- Dropdown level 1 -->
              <div id="dropdown-example" class="panel-collapse collapse">
              <div class="panel-body">
              <ul class="nav navbar-nav">
              <li><a href="pages/login.html">Login</a>
              </li>
              <li><a href="pages/index.html">Landing Page</a>
              </li>
              </ul>
              </div>
              </div>
              </li>
              <!-- Dropdown-->
              <li class="panel panel-default dropdown">
              <a data-toggle="collapse" href="#dropdown-icon">
              <span class="icon fa fa-archive"></span><span class="title">Icons</span>
              </a>
              <!-- Dropdown level 1 -->
              <div id="dropdown-icon" class="panel-collapse collapse">
              <div class="panel-body">
              <ul class="nav navbar-nav">
              <li><a href="icons/glyphicons.html">Glyphicons</a>
              </li>
              <li><a href="icons/font-awesome.html">Font Awesomes</a>
              </li>
              </ul>
              </div>
              </div>
              </li>
              <li>
              <a href="license.html">
              <span class="icon fa fa-thumbs-o-up"></span><span class="title">License</span>
              </a>
              </li> <?php */ ?>
        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>