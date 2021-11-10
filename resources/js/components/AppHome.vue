<template>
  <div>
    <Toolbar />
    <v-container>
      <router-view></router-view>
    </v-container>

    <Footer />
  </div>
</template>

<script>
import Toolbar from "./Toolbar.vue";
import Footer from "./Footer.vue";
export default {
  components: { Toolbar, Footer },
  mounted() {
    console.log("Component mounted.");
  },
};
</script>
