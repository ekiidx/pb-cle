<script setup>
import { ref } from "vue";
import { Link, router } from "@inertiajs/vue3";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";

const showingNavigationDropdown = ref(false);

defineProps({
    title: String,
    canLogin: Boolean,
    canRegister: Boolean,
});

// const switchToTeam = (team) => {
//     router.put(route('current-team.update'), {
//         team_id: team.id,
//     }, {
//         preserveState: false,
//     });
// };

const logout = () => {
    router.post(route('logout'));
};
</script>

<template>
  <div>

    <div class="main-wrapper">

      <!-- navigation top-->
      <div class="nav-header bg-dark shadow-xs border-0">
        <div class="nav-top">
          <a href="/"><i class="feather-zap text-darkorchid display1-size me-2 ms-0"></i><span class="d-inline-block fredoka-font ls-3 fw-600 text-current font-xxl logo-text mb-0">Pb-Cle.org</span></a>
          <!--<a href="#" class="mob-menu ms-auto me-2 chat-active-btn"><i class="feather-message-circle text-grey-900 font-sm btn-round-md bg-darkorchid"></i></a>
          <a href="default-video.html" class="mob-menu me-2"><i class="feather-video text-grey-900 font-sm btn-round-md bg-darkorchid"></i></a>
          <a href="#" class="me-2 menu-search-icon mob-menu"><i class="feather-search text-grey-900 font-sm btn-round-md bg-darkorchid"></i></a>-->
          <!-- <button class="nav-menu me-0 ms-2"></button> -->
        </div>

        <!-- <form action="#" class="float-left header-search">
          <div class="form-group mb-0 icon-input">
            <i class="feather-search font-sm text-grey-400"></i>
            <input type="text" placeholder="Start typing to search.." class="bg-grey border-0 lh-32 pt-2 pb-2 ps-5 pe-3 font-xssss fw-500 rounded-xl w350 bg-black">
          </div>
        </form> -->

        <a href="/communities" class="p-2 text-center ms-3 menu-icon center-menu-icon"><i class="feather-home font-lg bg-darkorchid btn-round-lg theme-dark-bg text-current "></i></a>
        <a href="/events" class="p-2 text-center ms-0 menu-icon center-menu-icon"><i class="feather-zap font-lg bg-darkorchid btn-round-lg theme-dark-bg text-grey-400 "></i></a>
        <!-- <a href="#" class="p-2 text-center ms-0 menu-icon center-menu-icon"><i class="feather-video font-lg bg-darkorchid btn-round-lg theme-dark-bg text-grey-500 "></i></a> -->
        <!-- <a href="/ravers" class="p-2 text-center ms-0 menu-icon center-menu-icon"><i class="feather-user font-lg bg-darkorchid btn-round-lg theme-dark-bg text-grey-500 "></i></a> -->
        <!-- <a href="#" class="p-2 text-center ms-0 menu-icon center-menu-icon"><i class="feather-shopping-bag font-lg bg-darkorchid btn-round-lg theme-dark-bg text-grey-500 "></i></a> -->

        <a href="#" class="p-2 text-center ms-auto menu-icon" id="dropdownMenu3" data-bs-toggle="dropdown" aria-expanded="false"><!--<span class="dot-count bg-warning"></span><i class="feather-bell font-xl text-current"></i>--></a>
        
        <!-- <div class="dropdown-menu dropdown-menu-end p-4 rounded-3 border-0 shadow-lg" aria-labelledby="dropdownMenu3">
            
          <h4 class="fw-700 font-xss mb-4">Notification</h4>
          <div class="card bg-transparent-card w-100 bg-dark border-0 ps-5 mb-3">
            <img src="https://via.placeholder.com/50x50.png" alt="user" class="w40 position-absolute left-0">
            <h5 class="font-xsss text-grey-900 mb-1 mt-0 fw-700 d-block">Hendrix Stamp <span class="text-grey-400 font-xsssss fw-600 float-right mt-1"> 3 min</span></h5>
            <h6 class="text-grey-500 fw-500 font-xssss lh-4">There are many variations of pass..</h6>
          </div>
          <div class="card bg-transparent-card w-100 bg-dark border-0 ps-5 mb-3">
            <img src="https://via.placeholder.com/50x50.png" alt="user" class="w40 position-absolute left-0">
            <h5 class="font-xsss text-grey-900 mb-1 mt-0 fw-700 d-block">Goria Coast <span class="text-grey-400 font-xsssss fw-600 float-right mt-1"> 2 min</span></h5>
            <h6 class="text-grey-500 fw-500 font-xssss lh-4">Mobile Apps UI Designer is require..</h6>
          </div>

          <div class="card bg-transparent-card w-100 bg-dark border-0 ps-5 mb-3">
            <img src="https://via.placeholder.com/50x50.png" alt="user" class="w40 position-absolute left-0">
            <h5 class="font-xsss text-grey-900 mb-1 mt-0 fw-700 d-block">Surfiya Zakir <span class="text-grey-400 font-xsssss fw-600 float-right mt-1"> 1 min</span></h5>
            <h6 class="text-grey-500 fw-500 font-xssss lh-4">Mobile Apps UI Designer is require..</h6>
          </div>
          <div class="card bg-transparent-card w-100 bg-dark border-0 ps-5">
            <img src="https://via.placeholder.com/50x50.png" alt="user" class="w40 position-absolute left-0">
            <h5 class="font-xsss text-grey-900 mb-1 mt-0 fw-700 d-block">Victor Exrixon <span class="text-grey-400 font-xsssss fw-600 float-right mt-1"> 30 sec</span></h5>
            <h6 class="text-grey-500 fw-500 font-xssss lh-4">Mobile Apps UI Designer is require..</h6>
          </div>
        </div> -->
        <!-- <a href="#" class="p-2 text-center ms-3 menu-icon chat-active-btn"><i class="feather-message-square font-xl text-current"></i></a> -->
  
        <nav class="main-nav">
          <div style="display: flex; justify-content: end;">

          <!-- Logo -->
          <!-- <Link href="/">
            <ApplicationLogo class="block h-9 w-auto" />
          </Link> -->
    
          <!-- Primary Navigation Menu -->
      
          <!-- Logo -->
          <!-- <div class="flex">
            <div class="shrink-0 flex items-center">
                <Link :href="route('welcome')">
                    <ApplicationMark class="block h-9 w-auto" />
                </Link>
            </div>
          </div> -->         

          <!-- Settings Dropdown -->
          <div class="relative" v-if="$page.props.auth.user">
            <Dropdown align="right" width="48">
              <template #trigger>

                <button v-if="$page.props.jetstream.managesProfilePhotos" class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                  <img class="profile-img rounded-full object-cover" :src="$page.props.auth.user.profile_photo_url" :alt="$page.props.auth.user.username">
                </button>

                <span v-else class="inline-flex rounded-md">
                  <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none focus:bg-gray-50 dark:focus:bg-gray-700 active:bg-gray-50 dark:active:bg-gray-700 transition ease-in-out duration-150">

                    {{ $page.props.auth.user.username }}

                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                  </button>
                </span>
              </template>

              <template #content>
                <!-- Account Management -->
                <!-- <div class="block px-4 py-2 text-xs text-gray-400">
                  Manage Account
                </div> -->

                <!-- Home -->
                <DropdownLink :href="route('welcome')">
                  Home
                </DropdownLink>

                <!-- Communities -->
                <DropdownLink :href="route('communities.index')">
                  Communities
                </DropdownLink>

                <!-- Settings -->
                <DropdownLink :href="route('profile.show')">
                  Settings
                </DropdownLink>

                <!-- <DropdownLink v-if="$page.props.jetstream.hasApiFeatures" :href="route('api-tokens.index')">
                  API Tokens
                </DropdownLink> -->

                <div class="border-t border-gray-200 dark:border-gray-600" />

                <!-- Logout -->
                <form @submit.prevent="logout">
                  <DropdownLink as="button">
                    Log Out
                  </DropdownLink>
                </form>
              </template>
            </Dropdown>
          </div>

          <template v-else>
            <Link
              :href="route('login')"
              class="text-sm text-gray-700 fw-600 login-btn"
            >
              Log in
            </Link>

            <Link
              :href="route('register')"
              class="ml-2 md:ml-3 lg:ml-3 text-sm text-gray-700 bg-darkorchid register-btn text-center text-white fw-600"
            >
              Register
            </Link>
          </template>

          <!-- Hamburger -->
          <!-- <div class="-mr-2 flex items-center sm:hidden">
            <button class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out" @click="showingNavigationDropdown = ! showingNavigationDropdown">
              <svg
                class="h-6 w-6"
                stroke="currentColor"
                fill="none"
                viewBox="0 0 24 24"
              >
                <path
                  :class="{'hidden': showingNavigationDropdown, 'inline-flex': ! showingNavigationDropdown }"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M4 6h16M4 12h16M4 18h16"
                />
                <path
                  :class="{'hidden': ! showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M6 18L18 6M6 6l12 12"
                />
              </svg>
            </button>
          </div> -->

          <!-- Responsive Navigation Menu -->
          <div :class="{'block': showingNavigationDropdown, 'hidden': ! showingNavigationDropdown}" class="sm:hidden">
            <!-- <div class="pt-2 pb-3 space-y-1">
              <ResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                  Dashboard
              </ResponsiveNavLink>
            </div> -->

            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
              <div class="flex items-center px-4"></div>
              <div class="mt-3 space-y-1">

                <!-- Home -->
                <!-- <ResponsiveNavLink :href="route('profile.show')">
                  Home
                </ResponsiveNavLink> -->

                <!-- Settings -->
                <!-- <ResponsiveNavLink :href="route('profile.show')">
                  Communities
                </ResponsiveNavLink> -->

                <!-- Settings -->
                <!-- <ResponsiveNavLink :href="route('profile.show')" :active="route().current('profile.show')">
                  Settings
                </ResponsiveNavLink> -->

                <!-- <ResponsiveNavLink v-if="$page.props.jetstream.hasApiFeatures" :href="route('api-tokens.index')" :active="route().current('api-tokens.index')">
                  API Tokens
                </ResponsiveNavLink> -->

                <!-- Authentication -->
                <!-- <form method="POST" @submit.prevent="logout">
                  <ResponsiveNavLink as="button">
                    Log Out
                  </ResponsiveNavLink>
                </form> -->

                <!-- Team Management -->
                <!-- <template v-if="$page.props.jetstream.hasTeamFeatures">
                  <div class="border-t border-gray-200 dark:border-gray-600" />

                  <div class="block px-4 py-2 text-xs text-gray-400">
                    Manage Team
                  </div> -->

                  <!-- Team Settings -->
                  <!-- <ResponsiveNavLink :href="route('teams.show', $page.props.auth.user.current_team)" :active="route().current('teams.show')">
                      Team Settings
                  </ResponsiveNavLink>

                  <ResponsiveNavLink v-if="$page.props.jetstream.canCreateTeams" :href="route('teams.create')" :active="route().current('teams.create')">
                    Create New Team
                  </ResponsiveNavLink> -->

                  <!-- Team Switcher -->
                  <!-- <template v-if="$page.props.auth.user.all_teams.length > 1">
                    <div class="border-t border-gray-200 dark:border-gray-600" />

                    <div class="block px-4 py-2 text-xs text-gray-400">
                      Switch Teams
                    </div>

                    <template v-for="team in $page.props.auth.user.all_teams" :key="team.id">
                      <form @submit.prevent="switchToTeam(team)">
                        <ResponsiveNavLink as="button">
                          <div class="flex items-center">
                            <svg v-if="team.id == $page.props.auth.user.current_team_id" class="mr-2 h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>{{ team.name }}</div>
                          </div>
                        </ResponsiveNavLink>
                      </form>
                    </template>
                  </template>
                </template> -->
              </div>
            </div>
          </div>
          </div>
        </nav>


        <!-- <div class="p-2 text-center ms-3 position-relative dropdown-menu-icon menu-icon cursor-pointer">
        <i class="feather-settings d-inline-block font-xl text-current"></i>
        <div class="dropdown-menu-settings switchcolor-wrap">
          <h4 class="fw-700 font-sm mb-4">Settings</h4>
          <h6 class="font-xssss text-grey-500 fw-700 mb-3 d-block">Choose Color Theme</h6>
          <ul>
            <li>
              <label class="item-radio item-content">
                <input type="radio" name="color-radio" value="red" checked=""><i class="ti-check"></i>
                <span class="circle-color bg-red" style="background-color: #ff3b30;"></span>
              </label>
            </li>
            <li>
              <label class="item-radio item-content">
                <input type="radio" name="color-radio" value="green"><i class="ti-check"></i>
                <span class="circle-color bg-green" style="background-color: #4cd964;"></span>
              </label>
            </li>
            <li>
              <label class="item-radio item-content">
                <input type="radio" name="color-radio" value="blue" checked=""><i class="ti-check"></i>
                <span class="circle-color bg-blue" style="background-color: #132977;"></span>
              </label>
            </li>
            <li>
              <label class="item-radio item-content">
                <input type="radio" name="color-radio" value="pink"><i class="ti-check"></i>
                <span class="circle-color bg-pink" style="background-color: #ff2d55;"></span>
              </label>
            </li>
            <li>
              <label class="item-radio item-content">
                <input type="radio" name="color-radio" value="yellow"><i class="ti-check"></i>
                <span class="circle-color bg-yellow" style="background-color: #ffcc00;"></span>
              </label>
            </li>
            <li>
              <label class="item-radio item-content">
                <input type="radio" name="color-radio" value="orange"><i class="ti-check"></i>
                <span class="circle-color bg-orange" style="background-color: #ff9500;"></span>
              </label>
            </li>
            <li>
              <label class="item-radio item-content">
                <input type="radio" name="color-radio" value="gray"><i class="ti-check"></i>
                <span class="circle-color bg-gray" style="background-color: #8e8e93;"></span>
              </label>
            </li>

            <li>
              <label class="item-radio item-content">
                <input type="radio" name="color-radio" value="brown"><i class="ti-check"></i>
                <span class="circle-color bg-brown" style="background-color: #D2691E;"></span>
              </label>
            </li>
            <li>
              <label class="item-radio item-content">
                <input type="radio" name="color-radio" value="darkgreen"><i class="ti-check"></i>
                <span class="circle-color bg-darkgreen" style="background-color: #228B22;"></span>
              </label>
            </li>
            <li>
              <label class="item-radio item-content">
                <input type="radio" name="color-radio" value="deeppink"><i class="ti-check"></i>
                <span class="circle-color bg-deeppink" style="background-color: #FFC0CB;"></span>
              </label>
            </li>
            <li>
              <label class="item-radio item-content">
                <input type="radio" name="color-radio" value="cadetblue"><i class="ti-check"></i>
                <span class="circle-color bg-cadetblue" style="background-color: #5f9ea0;"></span>
              </label>
            </li>
            <li>
              <label class="item-radio item-content">
                <input type="radio" name="color-radio" value="darkorchid"><i class="ti-check"></i>
                <span class="circle-color bg-darkorchid" style="background-color: #9932cc;"></span>
              </label>
            </li>
          </ul>
          
          <div class="card bg-transparent-card border-0 d-block mt-3">
            <h4 class="d-inline font-xssss mont-font fw-700">Header Background</h4>
            <div class="d-inline float-right mt-1">
              <label class="toggle toggle-menu-color"><input type="checkbox"><span class="toggle-icon"></span></label>
            </div>
          </div>
          <div class="card bg-transparent-card border-0 d-block mt-3">
            <h4 class="d-inline font-xssss mont-font fw-700">Menu Position</h4>
            <div class="d-inline float-right mt-1">
              <label class="toggle toggle-menu"><input type="checkbox"><span class="toggle-icon"></span></label>
            </div>
          </div>
          <div class="card bg-transparent-card border-0 d-block mt-3">
            <h4 class="d-inline font-xssss mont-font fw-700">Dark Mode</h4>
            <div class="d-inline float-right mt-1">
              <label class="toggle toggle-dark"><input type="checkbox"><span class="toggle-icon"></span></label>
            </div>
          </div>
        </div> -->
      </div>

      <!-- main content -->
      <!-- <div class="main-column loaded container"> -->
          
        <!-- loader wrapper -->
        <!-- <div class="preloader-wrap p-3">
          <div class="box shimmer">
            <div class="lines">
              <div class="line s_shimmer"></div>
              <div class="line s_shimmer"></div>
              <div class="line s_shimmer"></div>
              <div class="line s_shimmer"></div>
            </div>
          </div>
          <div class="box shimmer mb-3">
            <div class="lines">
              <div class="line s_shimmer"></div>
              <div class="line s_shimmer"></div>
              <div class="line s_shimmer"></div>
              <div class="line s_shimmer"></div>
            </div>
          </div>
          <div class="box shimmer">
            <div class="lines">
              <div class="line s_shimmer"></div>
              <div class="line s_shimmer"></div>
              <div class="line s_shimmer"></div>
              <div class="line s_shimmer"></div>
            </div>
          </div>
        </div> -->
          
        <!-- <div class="row feed-body">
          <div class="col-12"> -->

            <!-- Page Heading -->
            <header class="bg-dark border text-white rounded-lg mb-3 shadow" v-if="$slots.header">
              <slot name="header" />
            </header>

            <!-- Page Content -->
            <slot />

          </div>      
        <!-- </div>
      </div>
    </div> -->
  </div>
</template>
