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
export default {
  name: "Toolbar",
  created() {
    EventBus.$on("logout", () => {
      User.logout();
    });
  },
  data() {
    return {
      items: [
        { title: "Forum", to: "/forum", show: true },
        { title: "Ask Question", to: "/ask", show: User.loggedIn() },
        { title: "Category", to: "/category", show: User.loggedIn() },
        { title: "Login", to: "/login", show: !User.loggedIn() },
        { title: "Logout", to: "/logout", show: User.loggedIn() },
      ],
    };
  },
};
</script>
