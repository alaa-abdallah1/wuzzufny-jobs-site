<template>
  <div>
    <v-toolbar dense>
      <v-app-bar-nav-icon
        class="d-sm-none"
        @click="drawer = true"
      ></v-app-bar-nav-icon>
      <router-link to="/" class="text-decoration-none mainColor--text">
        <v-toolbar-title left>
          <strong><em>Wuzzufny</em></strong>
        </v-toolbar-title>
      </router-link>
      <v-spacer></v-spacer>

      <template>
        <v-btn
          class="d-none d-sm-flex font-weight-light py-6 rounded-0 navbar-links-sm"
          text
          v-for="(link, index) in loggedIn ? userLinks : guestLinks"
          :key="index"
          router
          :to="link.route"
          @click="fireFunction(link.function)"
        >
          <span v-if="!link.dropdown">
            <v-icon left v-if="link.icon">{{ link.icon }}</v-icon>
            <v-btn fab icon v-if="link.img" class="link-img">
              <v-avatar size="30">
                <img :src="link.img" left />
              </v-avatar>
            </v-btn>
            <span class="textLink">{{ link.name }}</span>
          </span>
          <v-menu v-else open-on-hover offset-y>
            <template v-slot:activator="{ on, attrs }">
              <v-btn
                v-bind="attrs"
                v-on="on"
                :color="$vuetify.theme.dark ? 'balck' : 'white'"
                depressed
                class="rounded-0 ma-n4 py-6"
              >
                <v-icon left v-if="link.icon">{{ link.icon }}</v-icon>
                <span>{{ link.name }}</span>
              </v-btn>
            </template>
            <v-list>
              <v-list-item
                v-for="(item, index) in link.dropdown.items"
                :key="index"
                router
                @click="fireFunction(item.function)"
                :to="item.route"
              >
                <v-list-item-title>
                  <v-icon left v-if="item.icon">{{ item.icon }}</v-icon>
                  <span>{{ item.name }}</span>
                </v-list-item-title>
              </v-list-item>
            </v-list>
          </v-menu>
        </v-btn>
      </template>

      <div class="text-center"></div>
    </v-toolbar>

    <v-navigation-drawer v-model="drawer" absolute temporary>
      <v-list>
        <v-list-item-group>
          <v-list-item
            v-for="(link, index) in loggedIn ? userLinks : guestLinks"
            :key="index"
            no-action
            router
            :to="link.route"
            @click="fireFunction(link.function)"
            :class="[link.dropdown ? 'dorpdown-menu-navbar' : '']"
          >
            <template v-if="!link.dropdown">
              <v-list-item-icon>
                <v-icon left v-if="link.icon">{{ link.icon }}</v-icon>
                <img width="20" :src="link.img" v-if="link.img" />
              </v-list-item-icon>
              <v-list-item-title>{{ link.name }}</v-list-item-title>
            </template>

            <v-list-group v-else class="dorpdown-menu-link">
              <template v-slot:activator>
                <v-list-item-content>
                  <v-list-item-title>{{ link.dropdownName }}</v-list-item-title>
                </v-list-item-content>
              </template>

              <v-list-item
                v-for="(dropdownLink, index) in link.dropdown.items"
                :key="index"
                router
                :to="dropdownLink.route"
                @click="fireFunction(dropdownLink.function)"
                class="subDorpdown-menu-link"
              >
                <v-icon left v-if="dropdownLink.icon">{{
                  dropdownLink.icon
                }}</v-icon>
                <v-list-item-content>
                  <v-list-item-title>{{ dropdownLink.name }}</v-list-item-title>
                </v-list-item-content>
              </v-list-item>
            </v-list-group>
          </v-list-item>
        </v-list-item-group>
      </v-list>
    </v-navigation-drawer>
  </div>
</template>

<script>
import { mapState, mapMutations } from "vuex";
export default {
  name: "Navbar",

  data: () => ({
    drawer: false,
    group: null
  }),
  computed: {
    ...mapState(["user"]),
    loggedIn() {
      return this.$store.getters.loggedIn;
    },
    userLinks() {
      return this.links.filter(link => link.status !== "guest");
    },
    guestLinks() {
      return this.links.filter(link => link.status !== "user");
    },
    userName() {
      if (this.loggedIn) {
        if (this.user.name.length > 12) {
          return this.user.name.slice(0, 12) + "...";
        } else {
          return this.user.name;
        }
      }
      return "";
    },
    links() {
      return [
        // { name: "Home", icon: "mdi-home", route: "/" },
        {
          name: "Home",
          icon: "mdi-home",
          route: "/"
        },
        {
          name: "Create Job",
          icon: "mdi-folder-plus",
          route: "/job/create",
          status: "user"
        },
        {
          name: this.userName,
          img: this.user.avatar,
          route: "/profile/view",
          status: "user"
        },
        {
          dropdownName: "More",
          icon: "mdi-arrow-down-drop-circle-outline",
          route: "",
          status: "user",
          dropdown: {
            items: [
              {
                name: "User Jobs",
                icon: "mdi-home",
                route: "/profile/jobs",
                status: "user",
                active: true
              },
              {
                name: "Edit Profile",
                icon: "mdi-pencil",
                route: "/profile/edit",
                status: "user"
              },
              {
                name: "Log Out",
                icon: "mdi-account-plus",
                status: "user",
                function: "logoutUser"
              }
            ]
          }
        },
        {
          name: "Sign In",
          icon: "mdi-login",
          route: "/sign-in",
          status: "guest"
        },
        {
          name: "Sign Up",
          icon: "mdi-account-plus",
          route: "/sign-up",
          status: "guest"
        }
      ];
    }
  },
  methods: {
    ...mapMutations(["logout"]),
    logoutUser() {
      this.logout();
    },
    fireFunction(func) {
      if (func) {
        this[func]();
      }
    }
  }
};
</script>
<style>
.navbar-links-sm .textLink {
  position: relative;
  top: 3px;
}
.link-img img {
  object-fit: cover;
}
</style>
