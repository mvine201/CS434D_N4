<template>
    <div class="container py-4">
      <div class="row justify-content-center">
        <!-- Khung tìm kiếm -->
        <div class="col-lg-5 mb-4">
          <div class="card shadow-sm">
            <div class="card-body">
              <h5 class="mb-3">
                <i class="fas fa-search me-2"></i>Tìm phiếu đặt lịch
              </h5>
              <div class="input-group">
                <input
                  type="text"
                  class="form-control"
                  v-model="search.ma_dat_lich"
                  placeholder="Nhập mã đặt lịch"
                  @keyup.enter="timKiem"
                />
                <button class="btn btn-primary" @click="timKiem" :disabled="loading">
                  <span v-if="loading" class="spinner-border spinner-border-sm me-1"></span>
                  Tìm kiếm
                </button>
              </div>
            </div>
          </div>
        </div>
  
        <!-- Kết quả -->
        <div class="col-lg-7">
          <!-- Không tìm thấy -->
          <div v-if="status === 0" class="alert alert-danger text-center" role="alert">
            <i class="fa-solid fa-circle-exclamation me-2"></i>
            Không tìm thấy kết quả phù hợp
          </div>
  
          <!-- Thông tin phiếu -->
          <div
            v-if="status === 1"
            class="card shadow-lg border-0"
          >
            <div
              class="card-header d-flex justify-content-between align-items-center text-white"
              style="background: linear-gradient(135deg, #2bb2ff 0%, #0077b6 100%);"
            >
              <h5 class="mb-0">
                <i class="bx bx-calendar-check me-2"></i> Phiếu đặt lịch
              </h5>
              <span
                class="badge"
                :class="phieu.is_thanh_toan === 1 ? 'bg-success' : 'bg-warning text-dark'"
              >
                {{ phieu.is_thanh_toan === 1 ? 'Đã thanh toán' : 'Chưa thanh toán' }}
              </span>
            </div>
            <div class="card-body">
              <div class="row g-4">
                <div class="col-md-6">
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                      <small class="text-muted">Mã đặt lịch</small>
                      <div class="fw-bold">{{ phieu.ma_dat_lich }}</div>
                    </li>
                    <li class="list-group-item">
                      <small class="text-muted">Thời gian</small>
                      <div>
                        <i class="bx bx-time me-1"></i>
                        {{ phieu.thoi_gian_bat_dau }} - {{ phieu.thoi_gian_ket_thuc }}
                      </div>
                    </li>
                    <li class="list-group-item">
                      <small class="text-muted">Chuyên khoa</small>
                      <div>{{ phieu.ten_chuyen_khoa || '-' }}</div>
                    </li>
                    <li class="list-group-item">
                      <small class="text-muted">Phòng khám</small>
                      <div>{{ phieu.ten_phong_kham || '-' }}</div>
                    </li>
                  </ul>
                </div>
  
                <div class="col-md-6">
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                      <small class="text-muted">Bệnh nhân</small>
                      <div class="fw-semibold">
                        <i class="bx bx-user me-1"></i>{{ phieu.ten_benh_nhan }}
                      </div>
                    </li>
                    <li class="list-group-item">
                      <small class="text-muted">Bác sĩ</small>
                      <div class="fw-semibold">
                        <i class="bx bx-user-pin me-1"></i>{{ phieu.ten_bac_si }}
                      </div>
                    </li>
                    <li class="list-group-item">
                      <small class="text-muted">Lý do khám</small>
                      <div>{{ phieu.ly_do_kham || '-' }}</div>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
  
          <!-- Loading -->
          <div v-if="loading && status === null" class="text-center mt-3">
            <div class="spinner-border text-primary"></div>
            <p class="mt-2">Đang tìm kiếm...</p>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import baseRequestAdmin from "../../../core/baseRequestAdmin";
  
  export default {
    data() {
      return {
        search: { ma_dat_lich: "" },
        status: null,
        phieu: {},
        loading: false,
      };
    },
    methods: {
      timKiem() {
        if (!this.search.ma_dat_lich.trim()) {
          this.$toast && this.$toast.error("Vui lòng nhập mã đặt lịch");
          return;
        }
        this.loading = true;
        this.status = null;
        baseRequestAdmin
          .post("admin/kiem-tra-phieu-dat-lich", this.search)
          .then((res) => {
            if (res.data.status) {
              this.phieu = res.data.data;
              this.status = 1;
              this.search.ma_dat_lich = "";
              this.$toast && this.$toast.success(res.data.message);
            } else {
              this.status = 0;
              this.$toast && this.$toast.error(res.data.message);
            }
          })
          .catch((err) => {
            this.status = 0;
            try {
              const list = Object.values(err.response.data.errors);
              list.forEach((v) => this.$toast && this.$toast.error(v[0]));
            } catch (e) {
              this.$toast && this.$toast.error(err.response.data.message);
            }
          })
          .finally(() => {
            this.loading = false;
          });
      },
    },
  };
  </script>
  