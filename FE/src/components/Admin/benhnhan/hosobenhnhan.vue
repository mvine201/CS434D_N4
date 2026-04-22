<template>
  <div class="container">
    <h1>QUẢN LÝ BỆNH NHÂN</h1>

    <div class="content">
      <!-- LEFT -->
      <div class="left">
        <div class="search-box">
          <input
            v-model="search"
            type="text"
            placeholder="🔍 Tìm kiếm theo tên hoặc số điện thoại"
          />
        </div>

        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Tên</th>
              <th>SĐT</th>
              <th>Nhóm máu</th>
              <th>Hành động</th>
            </tr>
          </thead>

          <tbody>
            <tr v-for="p in filteredPatients" :key="p.id">
              <td>{{ p.id }}</td>
              <td>{{ p.name }}</td>
              <td>{{ p.phone }}</td>
              <td>{{ p.blood }}</td>
              <td>
                <button class="edit" @click="editPatient(p)">Sửa</button>
                <button class="delete" @click="deletePatient(p.id)">Xóa</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- RIGHT -->
      <div class="right">
        <h2>Thông tin bệnh nhân</h2>

        <input v-model="form.name" placeholder="Tên bệnh nhân" />
        <input v-model="form.phone" placeholder="Số điện thoại" />
        <input v-model="form.address" placeholder="Địa chỉ" />
        <input v-model="form.blood" placeholder="Nhóm máu" />
        <input v-model="form.emergency" placeholder="Liên hệ khẩn cấp" />
        <input v-model="form.allergy" placeholder="Dị ứng" />
        <input v-model="form.history" placeholder="Tiền sử bệnh" />

        <div class="buttons">
          <button class="save" @click="savePatient">Lưu</button>
          <button class="reset" @click="resetForm">Reset</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from "vue";

const search = ref("");

const patients = ref([
  {
    id: 1,
    name: "Nguyễn Văn A",
    phone: "0123456789",
    blood: "O+",
  },
]);

const form = ref({
  id: null,
  name: "",
  phone: "",
  address: "",
  blood: "",
  emergency: "",
  allergy: "",
  history: "",
});

// 🔍 Search
const filteredPatients = computed(() => {
  return patients.value.filter(
    (p) =>
      p.name.toLowerCase().includes(search.value.toLowerCase()) ||
      p.phone.includes(search.value)
  );
});

// ➕ Save
const savePatient = () => {
  if (form.value.id) {
    const index = patients.value.findIndex((p) => p.id === form.value.id);
    patients.value[index] = { ...form.value };
  } else {
    form.value.id = Date.now();
    patients.value.push({ ...form.value });
  }
  resetForm();
};

// ✏️ Edit
const editPatient = (p) => {
  form.value = { ...p };
};

// ❌ Delete
const deletePatient = (id) => {
  patients.value = patients.value.filter((p) => p.id !== id);
};

// 🔄 Reset
const resetForm = () => {
  form.value = {
    id: null,
    name: "",
    phone: "",
    address: "",
    blood: "",
    emergency: "",
    allergy: "",
    history: "",
  };
};
</script>

<style>
@import "./index.css";
</style>
