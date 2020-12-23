 <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <?php $be_url = $this->config->item('be_url'); ?>
    <?php $logged_in_user = $this->ps_auth->get_user_info(); ?>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
       <div class="text-center mt-3">
          <div class="image">
          <img src="<?php echo img_url( "shopping-cart.png" ); ?>" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info" style="font-size: 14px; color: #fff; font-style: bold;">
            <a href="<?php echo site_url("admin/shops/edit/" . $shop_id); ?>">
               <span class="brand-text"><?php echo $this->Shop->get_one('shop0b69bc5dbd68bbd57ea13dfc5488e20a')->name . " "; ?></span>
            </a>
        </div>
        <hr/>
      </div>
    
      <?php 

        $selected_menu_child_name = $this->uri->segment(2); 

        if($selected_menu_child_name == "multipleupload") {
          $selected_menu_child_name = "multipleupload/upload";
        }
        $conds['module_name'] = $selected_menu_child_name;

        $selected_menu_group_id = $this->Module->get_one_by($conds)->group_id;
        $selected_menu_child_id = $this->Module->get_one_by($conds)->module_id;

      ?>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <li class="nav-item has-treeview">
            <a href="<?php echo site_url('/admin') ?>" class="nav-link">
              <i class="nav-icon fa fa-fw <?php echo "fa-tachometer"; ?>"></i>
              <p>
                <?php echo "Dashboard"; ?>
              </p>
            </a>
          </li>


          <?php if ( !empty( $module_groups )): ?>
            <?php 
                
                $menu_open_state = "";

                foreach ( $module_groups as $group ): 

                    if($group->group_id == $selected_menu_group_id) {

                        $menu_open_state = "menu-open";

                    } else {
                        $menu_open_state = "";
                    }

                    if($selected_menu_child_name=="attributes" || $selected_menu_child_name=="attributedetails"){
                      if($group->group_id == '1') {

                        $menu_open_state = "menu-open";

                      } 
                    }
            ?>



          <li class="nav-item has-treeview <?php echo $menu_open_state; ?>">
            <a href="#" class="nav-link ">
              <i class="nav-icon fa fa-fw <?php echo $group->group_icon; ?>"></i>
              <p>
                <?php echo $group->group_name; ?>
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <?php if (!empty( $allowed_modules )): ?>
                <?php 

                  $active_state = "";

                  foreach ( $allowed_modules as $module ): 

                    if($selected_menu_child_id == $module->module_id) {
                        
                        $active_state = "active";
                    
                    } else {

                        $active_state = "";

                    }

                    if( $selected_menu_child_name=="attributes" || $selected_menu_child_name=="attributedetails" ){
                            if($module->module_id == '13') {
                           
                              $active_state = "active";
                        
                            } 
                        
                          }

                ?>
                  <?php if ( $module->is_show_on_menu == 1 &&
                    $module->group_id == $group->group_id ): ?>
              <li class="nav-item">
                <a href="<?php echo site_url($be_url) . '/'. strtolower( $module->module_name ); ?>" class="nav-link <?php echo $active_state; ?>">
                  <i class="fa fa-caret-right"></i>
                  <p><?php echo $module->module_desc; ?></p>
                </a>
              </li>
              <?php endif; ?>
            <?php endforeach; ?>
          <?php endif; ?>
            </ul>
          </li>
        <?php endforeach; ?>
      <?php endif; ?> 
         
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

 