<template>
  <v-card
    color="grey lighten-4"
    flat
    tile
  >
    <v-toolbar dense>
      <!-- <v-app-bar-nav-icon></v-app-bar-nav-icon> -->

      <v-toolbar-title>MakeWWW</v-toolbar-title>

      <v-spacer></v-spacer>

      <app-notifications v-if="loggedIn" />

      <v-toolbar-items>
        <v-btn
          v-for="item in items"
          :key="item.to"
          v-if="item.show"
        >
          <router-link :to='item.to'><span>{{ item.title }}</span></router-link>
        </v-btn>
      </v-toolbar-items>
    </v-toolbar>
  </v-card>
</template>

<script>
import AppNotifications from "./AppNotifications.vue";
export default {
  components: { AppNotifications },
  name: "Toolbar",
  created() {
    EventBus.$on("logout", () => {
      User.logout();
    });
  },
  data() {
    return {
      loggedIn: User.loggedIn(),
      items: [
        { title: "Forum", to: "/forum", show: true },
        { title: "Ask Question", to: "/ask", show: User.loggedIn() },
        { title: "Category", to: "/category", show: User.isAdmin() },
        { title: "Login", to: "/login", show: !User.loggedIn() },
        { title: "Logout", to: "/logout", show: User.loggedIn() },
      ],
    };
  },
};
</script>
