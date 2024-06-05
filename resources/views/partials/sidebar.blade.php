<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar position-relative">
        <div class="multinav">
            <div class="multinav-scroll" style="height: 100%;">
                <!-- sidebar menu-->
                <ul class="sidebar-menu" data-widget="tree">

                    <li class="d-flex justify-content-center mb-5">
                        <button class="btn btn-danger w-p75" type="button" alt="default" data-bs-toggle="modal"
                            data-bs-target=".bs-example-modal-lg">
                            <i class="fal fa-edit"></i>
                            <span>Compose</span>
                        </button>
                    </li>

                    {{-- <li class="header">Sidebar Menu</li> --}}

                    <li class="{{ Request::is('*dashboard*') ? 'active' : '' }}">
                        <a href={{ route('dashboard') }}>
                            <i class="fal fa-columns"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li class="{{ Request::is('*receive*') ? 'active' : '' }}">
                        <a href="{{ route('list-data', 'receive') }}"><i class="fal fa-inbox-in"></i>
                            <span>Inbox</span>
                        </a>
                    </li>

                    <li class="{{ Request::is('*sent*') ? 'active' : '' }}">
                        <a href="{{ route('list-data', 'sent') }}"><i class="fal fa-paper-plane"></i>
                            <span>Sent</span>
                        </a>
                    </li>

                    <li class="{{ Request::is('*approval*') ? 'active' : '' }}">
                        <a href="{{ route('list-data', 'approval') }}"><i class="fal fa-signature"></i>
                            <span>Approvement</span>
                        </a>
                    </li>

                    @if (Auth::user()->jabatan === 'ADMIN')
                        <li class="{{ Request::is('*user*') ? 'active' : '' }}">
                            <a href={{ route('users.index') }}>
                                <i class="fal fa-users-cog"></i>
                                <span>User</span>
                            </a>
                        </li>
                    @endif

                    <li class="{{ Request::is('*disposisi*') ? 'active' : '' }}">
                        <a href={{ route('list-data', 'disposisi') }}>
                            <i class="fal fa-share-all"></i>
                            <span>Disposition</span>
                        </a>
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
