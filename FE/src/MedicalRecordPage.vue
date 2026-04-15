<script setup>
import { ref, computed, onMounted } from "vue";
import { useAuthStore } from "../stores/auth";

const auth = useAuthStore();

const search = ref("");
const records = ref([]);
const selected = ref(null);

onMounted(() => {
  // giả lập data từ BE
  records.value = [
    {
      id: "BA01",
      patient: { name: "Nguyễn A", age: 25 },
      doctorId: 1,
      date: "2026-04-10",
    },
    {
      id: "BA02",
      patient: { name: "Trần B", age: 30 },
      doctorId: 2,
      date: "2026-04-11",
    },
  ];
});

// chỉ lấy hồ sơ của bác sĩ login
const myRecords = computed(() =>
  records.value.filter((r) => r.doctorId === auth.user?.id)
);

const filtered = computed(() =>
  myRecords.value.filter(
    (r) =>
      r.patient.name.toLowerCase().includes(search.value.toLowerCase()) ||
      r.id.toLowerCase().includes(search.value.toLowerCase())
  )
);

// form
const form = ref({
  symptoms: "",
  diagnosis: "",
});
</script>

<template>
  <div class="flex min-h-screen bg-gray-100">
    <!-- Sidebar -->
    <aside class="w-60 bg-white p-4 shadow">
      <h2 class="font-bold">ClinicX</h2>
    </aside>

    <main class="flex-1 p-6">
      <!-- Header -->
      <div class="bg-white p-4 rounded shadow flex justify-between">
        <h1>Hồ sơ bệnh án</h1>
        <div>👨‍⚕️ {{ auth.user?.name }}</div>
      </div>

      <!-- Search -->
      <input
        v-model="search"
        class="mt-4 border p-2 w-full rounded"
        placeholder="Tìm kiếm..."
      />

      <!-- Table -->
      <div class="bg-white mt-4 p-4 rounded shadow">
        <table class="w-full">
          <tr v-for="r in filtered" :key="r.id">
            <td>{{ r.id }}</td>
            <td>{{ r.patient.name }}</td>
            <td>{{ r.date }}</td>
            <td>
              <button @click="selected = r">Xem</button>
            </td>
          </tr>
        </table>
      </div>

      <!-- Detail -->
      <div v-if="selected" class="bg-white mt-4 p-4 rounded shadow">
        <h2 class="font-bold">Chi tiết</h2>

        <p>Bệnh nhân: {{ selected.patient.name }}</p>

        <textarea v-model="form.symptoms" placeholder="Triệu chứng" />
        <textarea v-model="form.diagnosis" placeholder="Chẩn đoán" />

        <button class="bg-blue-500 text-white px-3 py-2 mt-2">
          Lưu
        </button>
      </div>
    </main>
  </div>
</template>