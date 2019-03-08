  <aside class="main-sidebar">
    <section class="sidebar">
      <ul class="sidebar-menu">
        <li class="treeview <?php echo $this->params->params["controller"] == "statistics" ? "active" : ""; ?>">
          <a href="<?php echo $this->Html->url("/users/add") ?>">
            <i class="fa fa-area-chart"></i> <span><?php echo __('Comprar productos') ?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>