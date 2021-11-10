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
        <v-btn>
          <span>Forum</span>

        </v-btn>

        <v-btn>
          <span>AskQuestion</span>

        </v-btn>

        <v-btn>
          <span>Category</span>

        </v-btn>

        <v-btn>

          <router-link to='/login'><span>Login</span></router-link>
        </v-btn>

      </v-toolbar-items>
    </v-toolbar>
  </v-card>
</template>
