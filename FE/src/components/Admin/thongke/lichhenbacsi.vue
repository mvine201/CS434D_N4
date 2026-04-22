<template>
  <div class="container">
    <h2>📅 Lịch hẹn bác sĩ</h2>

    <!-- Chọn ngày -->
    <div class="date-picker">
      <label>Chọn ngày:</label>
      <input type="date" v-model="selectedDate" />
    </div>

    <!-- Danh sách lịch -->
    <div class="appointment-list">
      <h3>Lịch hẹn ngày {{ selectedDate }}</h3>
      <div v-if="filteredAppointments.length === 0">
        Không có lịch hẹn
      </div>

      <div
        v-for="(item, index) in filteredAppointments"
        :key="index"
        class="appointment-card"
      >
        <p><strong>Bệnh nhân:</strong> {{ item.patient }}</p>
        <p><strong>Bác sĩ:</strong> {{ item.doctor }}</p>
        <p><strong>Giờ:</strong> {{ item.time }}</p>
      </div>
    </div>

    <!-- Form đặt lịch -->
    <div class="form">
      <h3>Đặt lịch mới</h3>

      <input v-model="newAppointment.patient" placeholder="Tên bệnh nhân" />
      <input v-model="newAppointment.doctor" placeholder="Tên bác sĩ" />
      <input v-model="newAppointment.time" type="time" />

      <button @click="addAppointment">Đặt lịch</button>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from "vue";

const selectedDate = ref(new Date().toISOString().split("T")[0]);

const appointments = ref([
  {
    date: selectedDate.value,
    patient: "Nguyễn Văn A",
    doctor: "Dr. Minh",
    time: "09:00",
  },
]);

const newAppointment = ref({
  patient: "",
  doctor: "",
  time: "",
});

const filteredAppointments = computed(() =>
  appointments.value.filter((a) => a.date === selectedDate.value)
);

const addAppointment = () => {
  if (
    !newAppointment.value.patient ||
    !newAppointment.value.doctor ||
    !newAppointment.value.time
  ) {
    alert("Vui lòng nhập đầy đủ thông tin");
    return;
  }

  appointments.value.push({
    date: selectedDate.value,
    ...newAppointment.value,
  });

  newAppointment.value = {
    patient: "",
    doctor: "",
    time: "",
  };
};
</script>

<style scoped>
.container {
  max-width: 600px;
  margin: auto;
  font-family: Arial;
}

.date-picker {
  margin-bottom: 20px;
}

.appointment-card {
  border: 1px solid #ccc;
  padding: 10px;
  margin-bottom: 10px;
  border-radius: 8px;
}

.form input {
  display: block;
  margin-bottom: 10px;
  padding: 8px;
  width: 100%;
}

button {
  padding: 10px;
  background: #4caf50;
  color: white;
  border: none;
  cursor: pointer;
}
</style>
