<template>
    <section class="sidebar-view main-sidebar">
      <div id="sidebar-wrapper" class="sidebar">
            <div class="user-panel info">
                <div class="pull-left image">
                    <img src="//placeholdit.imgix.net/~text?txtfont=monospace,bold&bg=DD4B39&txtclr=ffffff&txt=A&w=45&h=45&txtsize=16" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>{{ username }}</p>
                    <a href="#">
                        <i class="fa fa-circle text-success"></i> Online
                    </a>
                </div>
            </div>
            <ul class="sidebar-menu">
                <li class="header">MAIN NAVIGATION</li>
                <li :class="[dashboard__menu ? 'active' : '']">
                    <router-link to="/">
                        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    </router-link>
                </li>
                <li id="users__menu" class="treeview" :class="[users__menu ? 'active' : '']" @click="toggleSubMenus">
                    <a href="#">
                        <i class="fa fa-users"></i> <span>Users</span> <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <router-link to="/users">
                                <i class="fa fa-circle-o"></i> <span>User List</span>
                            </router-link>
                            <!-- <a href="/users">
                                <i class="fa fa-circle-o"></i> <span>User List</span>
                            </a> -->
                        </li>
                    </ul>
                </li>
                <li id="settings__menu" class="treeview" :class="[settings__menu ? 'active' : '']" @click="toggleSubMenus">
                    <a href="#">
                        <i class="fa fa-cog"></i> <span>Settings</span> <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="#">
                                <i class="fa fa-circle-o"></i> <span>User Roles</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-circle-o"></i> <span>User Permissions</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li id="calendar__menu" class="treeview" :class="[calendar__menu ? 'active' : '']" @click="toggleSubMenus">
                    <a href="#">
                        <i class="fa fa-calendar"></i> <span>Calendars</span><i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <router-link to="/calendar/dtc">
                                <i class="fa fa-circle-o"></i> <span>Diversified Calendar</span>
                            </router-link>
                        </li>
                        <li>
                            <router-link to="/calendar/sb">
                                <i class="fa fa-circle-o"></i> <span>Service Bureau Calendar</span>
                            </router-link>
                        </li>
                    </ul>
                </li>
                <li id="projects__menu" class="treeview" :class="[projects__menu ? 'active' : '']" @click="toggleSubMenus">
                    <a href="#">
                        <i class="fa fa-sitemap"></i> <span>Projects</span><i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="#">
                                <i class="fa fa-tasks"></i> <span>Tasks</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </section>
</template>

<script>
    export default {
        data() {
            return {
                isguest: dashboard.isGuest,
                username: dashboard.userData['name'],

                isActive: false,
                dashboard__menu: true,
                users__menu: false,
                settings__menu: false,
                calendar__menu: false,
                projects__menu: false,
                calendar: [],
            }
        },

        methods: {
            toggleSubMenus: function(e) {
                e.preventDefault();
                
                this.dashboard__menu = false
                this.users__menu = false
                this.settings__menu = false
                this.calendar__menu = false
                this.projects__menu = false

                var currentId = e.currentTarget.id
                this[currentId] = !this[currentId]
            },
        }
    }
</script>

<style lang="scss">
    ul.sidebar-menu > li {
        border: none;
    }

    li.sidebar-brand {
        height: 65px;
        font-size: 18px;
        line-height: 60px;
        color: #cdcdda;
    }

    ul.sidebar-menu > li.header {
        color: #53575e;
        border-top: 1px solid #53575e;
        border-bottom: 1px solid #53575e;
    }

    li.sidebar-brand a:hover {
        color: #fff;
        background: none;
    }

    .treeview-menu {
        display: none;
        list-style: none;
        padding: 0;
        margin: 0;
        padding-left: 5px;
        .treeview-menu {
            padding-left: 20px;
        }
        > li {
            margin: 0;
            > a {
                padding: 5px 5px 5px 15px;
                display: block;
                font-size: 14px;
                > .fa,
                > .glyphicon,
                > .ion {
                    width: 20px;
                }
                > .pull-right-container > .fa-angle-left,
                > .pull-right-container > .fa-angle-down,
                > .fa-angle-left,
                > .fa-angle-down {
                    width: auto;
                }
            }
        }
    }

    .sidebar {
        padding-bottom: 10px;
        background-color: #222d32;
    }

    .sidebar-menu {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .sidebar-menu > li {
        position: relative;
        margin: 0;
        padding: 0;
    }

    .sidebar-menu > li > a {
        padding: 12px 5px 12px 15px;
        display: block;
        text-decoration: none;
        color: #fff;
    }

    .sidebar-menu > li > a > .fa,
    .sidebar-menu > li > a > .glyphicon,
    .sidebar-menu > li > a > .ion {
        width: 20px;
    }

    .sidebar-menu > li .label,
    .sidebar-menu > li .badge {
        margin-right: 5px;
    }

    .sidebar-menu > li .badge {
        margin-top: 3px;
    }

    .sidebar-menu li.header {
        padding: 10px 25px 10px 15px;
        font-size: 12px;
    }

    .sidebar-menu li > a > .fa-angle-left,
    .sidebar-menu li > a > .pull-right-container > .fa-angle-left {
        width: auto;
        height: auto;
        padding: 0;
        margin-right: 10px;
    }

    .sidebar-menu li.active > a > .fa-angle-left > a > .pull-right-container > .fa-angle-left {
        -webkit-transform: rotate(-90deg);
        -ms-transform: rotate(-90deg);
        -o-transform: rotate(-90deg);
        transform: rotate(-90deg);
    }

    .sidebar-menu li.active > .treeview-menu {
        display: block;
    }

    .sidebar-menu .treeview-menu {
        display: none;
        list-style: none;
        padding: 0;
        margin: 0;
        padding-left: 5px;
    }

    .sidebar-menu .treeview-menu .treeview-menu {
        padding-left: 20px;
    }

    .sidebar-menu .treeview-menu > li {
        margin: 0;
    }

    .sidebar-menu .treeview-menu > li > a {
        padding: 5px 5px 5px 15px;
        display: block;
        font-size: 14px;
    }

    .sidebar-menu .treeview-menu > li > a > .fa,
    .sidebar-menu .treeview-menu > li > a > .glyphicon,
    .sidebar-menu .treeview-menu > li > a > .ion {
        width: 20px;
    }

    .sidebar-menu .treeview-menu > li > a > .pull-right-container > .fa-angle-left,
    .sidebar-menu .treeview-menu > li > a > .pull-right-container > .fa-angle-down,
    .sidebar-menu .treeview-menu > li > a > .fa-angle-left,
    .sidebar-menu .treeview-menu > li > a > .fa-angle-down {
        width: auto;
    }

    .user-panel {
        color: #ededf5;
        position: relative;
        width: 100%;
        padding: 10px;
        overflow: hidden;
    }

    .user-panel:before,
    .user-panel:after {
        content: " ";
        display: table;
    }

    .user-panel:after {
        clear: both;
    }

    .user-panel > .image > img {
        width: 100%;
        max-width: 45px;
        height: auto;
    }

    .user-panel > .info {
        padding: 5px 5px 5px 15px;
        line-height: 1;
        position: absolute;
        left: 55px;
    }

    .user-panel > .info > p {
        font-weight: 600;
        margin-bottom: 9px;
    }

    .user-panel > .info > a {
        text-decoration: none;
        padding-right: 5px;
        margin-top: 3px;
        font-size: 11px;
    }

    .user-panel > .info > a > .fa,
    .user-panel > .info > a > .ion,
    .user-panel > .info > a > .glyphicon {
        margin-right: 3px;
    }
</style>