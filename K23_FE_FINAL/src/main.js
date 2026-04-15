import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import LayoutAdmin from './layout/wrapper/Admin/layoutAdmin.vue'
import LayoutBacSi from './layout/wrapper/BacSi/layoutBacSi.vue'
import Blank from './layout/wrapper/blank.vue';
import Client from './layout/wrapper/Client/index.vue'

import Toaster from "@meforma/vue-toaster";

const app = createApp(App)

app.use(Toaster, {
    position: "top-right",
  });
app.use(router)
app.component("bac-si-layout", LayoutBacSi);
app.component("admin-layout", LayoutAdmin);
app.component("blank-layout", Blank);
app.component("client-layout", Client);

app.mount("#app")