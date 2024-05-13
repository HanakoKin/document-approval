<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar position-relative">
        <div class="multinav">
            <div class="multinav-scroll" style="height: 100%;">
                <!-- sidebar menu-->
                <ul class="sidebar-menu" data-widget="tree">

                    <li class="d-flex justify-content-center">
                        <button class="btn btn-danger w-p75" type="button" alt="default" data-bs-toggle="modal"
                            data-bs-target=".bs-example-modal-lg">
                            <i class="fa-thin fa-pen-to-square"></i>
                            <span>Compose</span>
                        </button>
                    </li>

                    <li class="header">Sidebar Menu</li>

                    <li class="{{ Request::is('*dashboard*') ? 'active' : '' }}">
                        <a href={{ route('dashboard') }}>
                            <i class="fa-duotone fa-grid-2"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li class="{{ Request::is('*receive*') ? 'active' : '' }}">
                        <a href="{{ route('show', 'receive') }}"><i class="fa-duotone fa-inbox"></i>
                            <span>Inbox</span>
                        </a>
                    </li>

                    <li class="{{ Request::is('*sent*') ? 'active' : '' }}">
                        <a href="{{ route('show', 'sent') }}"><i class="fa-light fa-paper-plane-top"></i>
                            <span>Sent</span>
                        </a>
                    </li>

                    <li class="{{ Request::is('*approval*') ? 'active' : '' }}">
                        <a href="{{ route('show', 'approval') }}"><i class="fa-regular fa-signature-lock"></i>
                            <span>Approvement</span>
                        </a>
                    </li>

                    {{-- <li class="treeview {{ Request::is('*document*') ? 'active menu-open' : '' }}">
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
                                    href="{{ url('/received') }}"><i class="icon-Commit"><span
                                            class="path1"></span><span class="path2"></span></i>Receive</a></li>
                            <li class="{{ Request::is('*receive*') ? 'active' : '' }}"><a
                                    href="{{ route('documents', 'receive') }}"><i class="icon-Commit"><span
                                            class="path1"></span><span class="path2"></span></i>Receive</a></li>
                            <li class="{{ Request::is('*sent*') ? 'active' : '' }}"><a
                                    href="{{ route('documents', 'sent') }}"><i class="icon-Commit"><span
                                            class="path1"></span><span class="path2"></span></i>Sent</a></li>
                            <li class="{{ Request::is('*approval*') ? 'active' : '' }}"><a
                                    href="{{ route('list-approval', 'approval') }}"><i class="icon-Commit"><span
                                            class="path1"></span><span class="path2"></span></i>Approvement</a></li>
                        </ul>
                    </li> --}}

                    @if (Auth::user()->jabatan === 'ADMIN')
                        <li class="{{ Request::is('*user*') ? 'active' : '' }}">
                            <a href={{ route('users') }}>
                                <i class="fa-duotone fa-user"></i>
                                <span>User</span>
                            </a>
                        </li>
                    @endif

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
