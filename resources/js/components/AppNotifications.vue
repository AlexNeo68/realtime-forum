<template>
  <div class="text-center mr-6">
    <v-menu offset-y>
      <template v-slot:activator="{ on, attrs }">
        <v-btn
          :color="color"
          dark
          v-bind="attrs"
          v-on="on"
          icon
        >
          <v-icon>mdi-bell</v-icon>
          {{ unreadCount }}
        </v-btn>
      </template>
      <v-list>
        <v-list-item
          v-for="(item, index) in unread"
          :key="index"
        >
          <router-link :to="item.question_path">
            <v-list-item-title @click="readIt(item)">

              {{ item.question }}

            </v-list-item-title>
          </router-link>
        </v-list-item>
      </v-list>
      <v-divider></v-divider>
      <v-list>
        <v-list-item
          v-for="(item, index) in read"
          :key="index"
        >
          <v-list-item-title>{{ item.question }}</v-list-item-title>
        </v-list-item>
      </v-list>
    </v-menu>
  </div>
</template>
<script>
export default {
  name: "AppNotifications",
  data: () => ({
    read: [],
    unread: [],
    unreadCount: 0,
  }),
  computed: {
    color() {
      return this.unreadCount > 0 ? "deep-orange" : "deep-orange lighten-4";
    },
  },
  created() {
    this.getNotification();
    Echo.private("App.Models.User." + User.id()).notification(
      (notification) => {
        if (notification.type == "App\\Notifications\\SendReplyNotification") {
          this.unread.unshift(notification.reply);
          this.unreadCount++;
        }
      }
    );
  },
  methods: {
    async getNotification() {
      try {
        const res = await axios.get("/api/notifications");
        this.read = res.data.read;
        this.unread = res.data.unread;
        this.unreadCount = this.unread.length;
      } catch (error) {
        console.log(error.response);
      }
    },
    async readIt(notification) {
      try {
        const res = await axios.get(`/api/notifications/${notification.id}`);
        this.getNotification();
      } catch (error) {
        console.log(error.response);
      }
    },
  },
};
</script>
