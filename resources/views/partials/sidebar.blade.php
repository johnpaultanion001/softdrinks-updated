<!-- Sidenav -->
<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header  align-items-center">
        <a class="navbar-brand" href="{{ route("admin.dashboard") }}">
          <!-- <img src="../assets/img/brand/blue.png" class="navbar-brand-img" alt="..."> -->

          <h3 class="text-primary">JEWEL & NICKEL STORE</h3>
          <hr class="my-1 bg-primary">
        </a>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav">
            @can('manager_dashboard_access')
              <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/dashboard') || request()->is('admin/dashboard/*') ? 'active' : '' }}" href="{{ route("admin.dashboard") }}">
                  <i class="ni ni-tv-2 "></i>
                  <span class="nav-link-text text-uppercase">Dashboard</span>
                </a>
              </li>
            @endcan
            @can('receiving_goods_access')
              <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/receiving_goods') || request()->is('admin/receiving_goods/*') ? 'active' : '' }}" href="{{ route("admin.receiving_goods.index") }}">
                  <i class="fas fa-truck"></i>
                  <span class="nav-link-text text-uppercase">Receiving goods</span>
                </a>
              </li>
            @endcan
            @can('sales_inventory_access')
              <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/sales_inventory') || request()->is('admin/sales_inventory/*') ? 'active' : '' }}" href="{{ route("admin.sales_inventory.index") }}">
                  <i class="ni ni-bullet-list-67"></i>
                  <span class="nav-link-text text-uppercase">Sales Inventories</span>
                </a>
              </li>
            @endcan
            @can('empty_bottles_inventory_access')
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/empty_bottles_inventory') || request()->is('admin/empty_bottles_inventory/*') ? 'active' : '' }}" href="{{ route("admin.empty_bottles_inventory.index") }}">
                  <i class="ni ni-bullet-list-67"></i>
                  <span class="nav-link-text text-uppercase">Empty Bottles Inventories</span>
                </a>
              </li>
            @endcan
            @can('sales_invoice_access')
            <li class="nav-item">
              <a class="nav-link {{ request()->is('admin/salesInvoice') || request()->is('admin/salesInvoice/*') ? 'active' : '' }}" href="{{ route("admin.salesInvoice.index") }}">
                <i class="ni ni-cart"></i>
                <span class="nav-link-text text-uppercase">Sales Invoice</span>
              </a>
            </li>
            @endcan
            @can('location_transfer_access')
              <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/location_transfer') || request()->is('admin/location_transfer/*') ? 'active' : '' }}" href="{{ route("admin.location_transfer.index") }}">
                  <i class="ni ni-bullet-list-67"></i>
                  <span class="nav-link-text text-uppercase">Location Transfer</span>
                </a>
              </li>
            @endcan
          </ul>

          @can('setting_section')  
              <hr class="my-3 bg-pink">
                <h6 class="navbar-heading p-0 text-muted">
                  <span class="docs-normal text-uppercase">Settings</span>
                </h6>
                <ul class="navbar-nav mb-md-3">
                    @can('customers_access')
                      <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/customers') || request()->is('admin/customers/*') ? 'active' : '' }}" href="{{ route("admin.customers.index") }}">
                          <i class="text-pink ni ni-bullet-list-67"></i>
                          <span class="nav-link-text text-uppercase">Customers</span>
                        </a>
                      </li>
                    @endcan
                    @can('supplier_access')
                      <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/suppliers') || request()->is('admin/suppliers/*') ? 'active' : '' }}" href="{{ route("admin.suppliers.index") }}">
                          <i class="text-pink far fa-building"></i>
                          <span class="nav-link-text text-uppercase">Suppliers</span>
                        </a>
                      </li>
                    @endcan
                    @can('price_type_access')
                      <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/price_type') || request()->is('admin/price_type/*') ? 'active' : '' }}" href="{{ route("admin.price_type.index") }}">
                          <i class="text-pink far fa-building"></i>
                          <span class="nav-link-text text-uppercase">Price Types</span>
                        </a>
                      </li>
                    @endcan
                    @can('sizes_access')
                      <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/sizes') || request()->is('admin/sizes/*') ? 'active' : '' }}" href="{{ route("admin.sizes.index") }}">
                          <i class=" text-pink fas fa-boxes"></i>
                          <span class="nav-link-text text-uppercase">Sizes</span>
                        </a>
                      </li>
                    @endcan
                    @can('category_access')
                    <li class="nav-item">
                      <a class="nav-link {{ request()->is('admin/categories') || request()->is('admin/categories/*') ? 'active' : '' }}" href="{{ route("admin.categories.index") }}">
                      <i class="text-pink fas fa-tags"></i>
                        <span class="nav-link-text text-uppercase">Categories</span>
                      </a>
                    </li>
                    @endcan
                    @can('locations_access')
                    <li class="nav-item">
                      <a class="nav-link {{ request()->is('admin/locations') || request()->is('admin/locations/*') ? 'active' : '' }}" href="{{ route("admin.locations.index") }}">
                      <i class="text-pink fas fa-tags"></i>
                        <span class="nav-link-text text-uppercase">Locations</span>
                      </a>
                    </li>
                    @endcan
                    @can('status_return_access')
                      <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/status-return') || request()->is('admin/status-return/*') ? 'active' : '' }}" href="{{ route("admin.status-return.index") }}">
                        <i class="text-pink fas fa-tags"></i>
                          <span class="nav-link-text text-uppercase">Status of Return</span>
                        </a>
                      </li>
                    @endcan
                    @can('assign_deliver_access')
                      <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/assign_deliver') || request()->is('admin/assign_deliver/*') ? 'active' : '' }}" href="{{ route("admin.assign_deliver.index") }}">
                        <i class="text-pink fas fa-tags"></i>
                          <span class="nav-link-text text-uppercase">Assign Deliver</span>
                        </a>
                      </li>
                    @endcan
                    
                </ul>
            @endcan

            @can('report_section')  
              <hr class="my-3 bg-info">
                <h6 class="navbar-heading p-0 text-muted">
                  <span class="docs-normal text-uppercase">Reports</span>
                </h6>
                <ul class="navbar-nav mb-md-3">
                @can('transaction_access')
                  <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/transactions') || request()->is('admin/transactions/*') ? 'active' : '' }}" href="{{ route("admin.transactions.index") }}">
                    <i class="text-info fas fa-file-invoice-dollar"></i>
                      <span class="nav-link-text  text-uppercase">Transactions</span>
                    </a>
                  </li>
                @endcan
                @can('ucs_access')
                  <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/ucs') || request()->is('admin/ucs/*') ? 'active' : '' }}" href="{{ route("admin.ucs.index") }}">
                    <i class="text-info fas fa-file-invoice-dollar"></i>
                      <span class="nav-link-text  text-uppercase">UCS</span>
                    </a>
                  </li>
                @endcan
                @can('graph_access')
                  <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/graph') || request()->is('admin/graph/*') ? 'active' : '' }}" href="{{ route("admin.graph") }}">
                    <i class="text-info ni ni-chart-bar-32"></i>
                      <span class="nav-link-text text-uppercase">Graph</span>
                    </a>
                  </li>
                @endcan
                </ul>
            @endcan
            @can('user_management_section')
            <hr class="my-3 bg-success">
              <h6 class="navbar-heading p-0 text-muted">
                <span class="docs-normal text-uppercase">User Management</span>
              </h6>
                <ul class="navbar-nav mb-md-3">
                
                @can('role_access')
                  <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}" href="{{ route("admin.roles.index") }}">
                    <i class="text-success ni ni-badge"></i>
                      <span class="nav-link-text text-uppercase">Roles</span>
                    </a>
                  </li>
                @endcan
                @can('user_access')
                  <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}" href="{{ route("admin.users.index") }}">
                    <i class="text-success ni ni-circle-08"></i>
                      <span class="nav-link-text text-uppercase">Users</span>
                    </a>
                  </li>
                @endcan
                </ul>
              @endcan

        </div>

      </div>
    </div>
  </nav>