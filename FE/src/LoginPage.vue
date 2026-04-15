<script setup>
import { ref } from "vue";
import { useAuthStore } from "../stores/auth";
import { useRouter } from "vue-router";

const auth = useAuthStore();
const router = useRouter();

const name = ref("");

const handleLogin = () => {
  // giả lập login (sau này gọi API)
  auth.login({
    id: name.value === "cong" ? 1 : 2,
    name: name.value,
  });

  router.push("/medical");
};
</script>

<template>
  <div class="flex items-center justify-center h-screen bg-gray-100">
    <div class="bg-white p-6 rounded shadow w-80">
      <h2 class="text-xl font-bold mb-4">Đăng nhập</h2>

      <input
        v-model="name"
        placeholder="Nhập tên bác sĩ..."
        class="w-full border p-2 mb-3 rounded"
      />

      <button
        @click="handleLogin"
        class="w-full bg-blue-500 text-white py-2 rounded"
      >
        Đăng nhập
      </button>
    </div>
  </div>
</template>
