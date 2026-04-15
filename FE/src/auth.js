import { defineStore } from "pinia";

export const useAuthStore = defineStore("auth", {
  state: () => ({
    user: null, // { id, name, role }
  }),

  actions: {
    login(user) {
      this.user = user;
    },
    logout() {
      this.user = null;
    },
  },
});