<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar position-relative">
        <div class="multinav">
            <div class="multinav-scroll" style="height: 100%;">
                <!-- sidebar menu-->
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header">Sidebar Menu</li>

                    @if (Auth::user()->unit === 'ADMIN')
                        <li class="{{ Request::is('*user*') ? 'active' : '' }}">
                            <a href={{ route('users') }}>
                                <i class="fal fa-user-alt"></i>
                                <span>User</span>
                            </a>
                        </li>
                    @endif
                    {{-- DASHBOARD --}}
                    <li class="treeview {{ Request::is('*document*') ? 'active menu-open' : '' }}">
                        <a href="#">
                            <i span class="icon-Layout-grid"><span class="path1"></span><span
                                    class="path2"></span></i>
                            <span>Document</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{ Request::is('*receive*') ? 'active' : '' }}"><a
                                    href="{{ route('documents', 'receive') }}"><i class="icon-Commit"><span
                                            class="path1"></span><span class="path2"></span></i>Receive</a></li>
                            <li class="{{ Request::is('*sent*') ? 'active' : '' }}"><a
                                    href="{{ route('documents', 'sent') }}"><i class="icon-Commit"><span
                                            class="path1"></span><span class="path2"></span></i>Sent</a></li>
                            <li class="{{ Request::is('*list-approval*') ? 'active' : '' }}"><a
                                    href="{{ route('list-approval') }}"><i class="icon-Commit"><span
                                            class="path1"></span><span class="path2"></span></i>Approvement</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <div class="sidebar-footer">
        <a href="javascript:void(0)" class="link" data-bs-toggle="tooltip" title="Settings"><span
                class="icon-Settings-2"></span></a>
        <a href="mailbox.html" class="link" data-bs-toggle="tooltip" title="Email"><span
                class="icon-Mail"></span></a>
        <a href="javascript:void(0)" class="link" data-bs-toggle="tooltip" title="Logout"><span
                class="icon-Lock-overturning"><span class="path1"></span><span class="path2"></span></span></a>
    </div>
</aside>
