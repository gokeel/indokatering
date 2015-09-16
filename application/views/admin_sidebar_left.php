	<!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <!-- <div class="user-panel">
            <div class="pull-left image">
              <img src="<?php echo ADMIN_LTE_DIR;?>/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
              <p><?php echo $this->session->userdata('fn');?></p>

              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div> -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
			<li class="treeview <?php echo ($am=='dashboard' ? 'active' : '');?>">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              </a>
            </li>
			<li class="treeview <?php echo ($am=='order' ? 'active' : '');?> ">
				<a href="#">
					<i class="fa fa-shopping-cart"></i>
					Customer Order
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li class="<?php echo ($asm_1=='view_all' ? 'active' : '');?>">
						<a href="<?php echo base_url('cms/view_order');?>">
							<i class="fa fa-circle-o"></i>
							View all
						</a>
					</li>
					<li class="<?php echo ($asm_1=='payment' ? 'active' : '');?>">
						<a href="<?php echo base_url('cms/view_payment');?>">
							<i class="fa fa-circle-o"></i>
							Payments
						</a>
					</li>
				</ul>
			</li>
			<li class="treeview <?php echo ($am=='post' ? 'active' : '');?> ">
				<a href="#">
					<i class="fa fa-users"></i>
					Post
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li class="<?php echo ($asm_1=='view_all' ? 'active' : '');?>">
						<a href="<?php echo base_url('cms/view_post?ty=post');?>">
							<i class="fa fa-circle-o"></i>
							View all
						</a>
					</li>
					<li class="<?php echo ($asm_1=='new' ? 'active' : '');?>">
						<a href="<?php echo base_url('cms/post_new');?>">
							<i class="fa fa-circle-o"></i>
							Add new
						</a>
					</li>
					<li class="<?php echo ($asm_1=='view_category' ? 'active' : '');?>">
						<a href="<?php echo base_url('cms/category_view?ty=post');?>">
							<i class="fa fa-circle-o"></i>
							Category
						</a>
					</li>
				</ul>
			</li>
			<li class="treeview <?php echo ($am=='product' ? 'active' : '');?> ">
				<a href="#">
					<i class="fa fa-users"></i>
					Product
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li class="<?php echo ($asm_1=='view_all' ? 'active' : '');?>">
						<a href="<?php echo base_url('cms/view_post?ty=product');?>">
							<i class="fa fa-circle-o"></i>
							View all
						</a>
					</li>
					<li class="<?php echo ($asm_1=='new' ? 'active' : '');?>">
						<a href="<?php echo base_url('cms/product_new');?>">
							<i class="fa fa-circle-o"></i>
							Add new
						</a>
					</li>
					<li class="<?php echo ($asm_1=='view_category' ? 'active' : '');?>">
						<a href="<?php echo base_url('cms/category_view?ty=product');?>">
							<i class="fa fa-circle-o"></i>
							Category
						</a>
					</li>
				</ul>
			</li>
			<li class="treeview <?php echo ($am=='page' ? 'active' : '');?>">
				<a href="#">
					<i class="fa fa-cogs"></i>
					Page
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li class="<?php echo ($asm_1=='view_all' ? 'active' : '');?>">
						<a href="<?php echo base_url('cms/view_post?ty=page');?>">
							<i class="fa fa-expand"></i>
							View All
						</a>
					</li>
					<li class="<?php echo ($asm_1=='new' ? 'active' : '');?>">
						<a href="<?php echo base_url('cms/page_new');?>">
							<i class="fa fa-expand"></i>
							Add New
						</a>
					</li>
				</ul>	
			</li>
			<li class="treeview <?php echo ($am=='user' ? 'active' : '');?> ">
				<a href="#">
					<i class="fa fa-users"></i>
					User Management
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li class="<?php echo ($asm_1=='view_all' ? 'active' : '');?>">
						<a href="<?php echo base_url('users/user_view?v=all');?>">
							<i class="fa fa-circle-o"></i>
							View all
						</a>
					</li>
					<li class="<?php echo ($asm_1=='new' ? 'active' : '');?>">
						<a href="<?php echo base_url('users/add_user');?>">
							<i class="fa fa-circle-o"></i>
							Add new
						</a>
					</li>
					<li class="<?php echo ($asm_1=='change-password' ? 'active' : '');?>">
						<a href="<?php echo base_url('users/change_password_view');?>">
							<i class="fa fa-circle-o"></i>
							Change Password
						</a>
					</li>
				</ul>
			</li>
			<li class="treeview <?php echo ($am=='media' ? 'active' : '');?>">
				<a href="<?php echo base_url();?>">
					<i class="fa fa-cogs"></i>
					Media
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li class="<?php echo ($asm_1=='view_all' ? 'active' : '');?>">
						<a href="<?php echo base_url('cms/media_view_all');?>">
							<i class="fa fa-expand"></i>
							View All
						</a>
					</li>
					<li class="<?php echo ($asm_1=='new' ? 'active' : '');?>">
						<a href="#">
							<i class="fa fa-expand"></i>
							Add New
						</a>
					</li>
				</ul>	
			</li>
			<li class="treeview <?php echo ($am=='setting' ? 'active' : '');?> ">
				<a href="#">
					<i class="fa fa-users"></i>
					Settings
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li class="<?php echo ($asm_1=='general' ? 'active' : '');?>">
						<a href="<?php echo base_url('cms/set_options');?>">
							General
						</a>
					</li>
					<li class="<?php echo ($asm_1=='commerce' ? 'active' : '');?>">
						<a href="<?php echo base_url('cms/set_commerce');?>">
							E-Commerce
						</a>
					</li>
				</ul>
			</li>
            <li><a href="<?php echo base_url();?>users/do_logout"><i class="fa fa-book"></i> Logout</a></li>
          </ul>
		
          <!-- /.sidebar menu -->
		  
        </section>
        <!-- /.sidebar -->
      </aside>