<template>
  <div class="container py-5">
    <!-- Banner Header -->
    <div class="card bg-primary text-white border-0 mb-5 shadow-lg rounded-4">
      <div class="card-body py-5">
        <div class="row align-items-center">
          <div class="col-lg-8">
            <h1 class="display-5 fw-bold mb-3 text-white">
              <i class="fa-solid fa-heart-pulse me-2"></i>
              {{ khoa.ten_chuyen_khoa }}
            </h1>
            <p class="lead mb-4 ">{{ khoa.mo_ta }}</p>
            <div class="d-flex flex-wrap gap-2">
              <button class="btn btn-light btn-lg px-4 py-2 fw-bold shadow-sm">
                <i class="fa-solid fa-calendar-plus me-2"></i>Đặt lịch khám ngay
              </button>
              <button class="btn btn-outline-light btn-lg px-4 py-2 fw-bold shadow-sm">
                <i class="fa-solid fa-phone me-2"></i>Gọi tư vấn miễn phí
              </button>
            </div>
          </div>
          <div class="col-lg-4 text-center">
            <img src="https://img.freepik.com/free-photo/doctor-with-stethoscope-hands-hospital-background_1423-1.jpg"
              class="img-fluid rounded-circle border border-4 border-white shadow" width="240" height="240"
              alt="Khoa Tim mạch">
          </div>
        </div>
      </div>
    </div>

    <div class="row mb-5 gy-4">
      <!-- Main Content -->
      <div class="col-lg-8">
        <!-- Tổng quan & Dịch vụ -->
        <div class="card border-0 shadow-sm mb-4 rounded-4">
          <div class="card-body p-4">
            <h3 class="fw-bold mb-4">
              <i class="fa-solid fa-circle-info text-primary me-2"></i>
              Về Khoa {{ khoa.ten_chuyen_khoa }}
            </h3>
            <div class="mb-4">
              <p>{{ khoa.mo_ta }}</p>
            </div>
            <div class="row g-3">
              <div class="col-md-6">
                <div class="card border-0 bg-primary bg-opacity-10 mb-3">
                  <div class="card-body">
                    <h5 class="fw-bold text-primary mb-3">
                      <i class="fa-solid fa-list-check me-2"></i>Dịch vụ nổi bật
                    </h5>
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item border-0 bg-transparent px-0 py-2 d-flex align-items-center">
                        <span
                          class="d-inline-flex align-items-center justify-content-center rounded-circle bg-white shadow-sm me-3"
                          style="width:38px;height:38px;">
                          <i class="fa-solid fa-heart text-primary"></i>
                        </span>
                        <span class="fw-semibold text-white">Khám và tư vấn bệnh tim mạch</span>
                      </li>
                      <li class="list-group-item border-0 bg-transparent px-0 py-2 d-flex align-items-center">
                        <span
                          class="d-inline-flex align-items-center justify-content-center rounded-circle bg-white shadow-sm me-3"
                          style="width:38px;height:38px;">
                          <i class="fa-solid fa-heart-pulse text-primary"></i>
                        </span>
                        <span class="fw-semibold text-white">Điện tim, Siêu âm tim</span>
                      </li>
                      <li class="list-group-item border-0 bg-transparent px-0 py-2 d-flex align-items-center">
                        <span
                          class="d-inline-flex align-items-center justify-content-center rounded-circle bg-white shadow-sm me-3"
                          style="width:38px;height:38px;">
                          <i class="fa-solid fa-clock text-primary"></i>
                        </span>
                        <span class="fw-semibold text-white">Đo huyết áp 24h</span>
                      </li>
                      <li class="list-group-item border-0 bg-transparent px-0 py-2 d-flex align-items-center">
                        <span
                          class="d-inline-flex align-items-center justify-content-center rounded-circle bg-white shadow-sm me-3"
                          style="width:38px;height:38px;">
                          <i class="fa-solid fa-x-ray text-primary"></i>
                        </span>
                        <span class="fw-semibold text-white">Chụp mạch vành</span>
                      </li>
                      <li class="list-group-item border-0 bg-transparent px-0 py-2 d-flex align-items-center">
                        <span
                          class="d-inline-flex align-items-center justify-content-center rounded-circle bg-white shadow-sm me-3"
                          style="width:38px;height:38px;">
                          <i class="fa-solid fa-stethoscope text-primary"></i>
                        </span>
                        <span class="fw-semibold text-white">Can thiệp tim mạch</span>
                      </li>
                      <li class="list-group-item border-0 bg-transparent px-0 py-2 d-flex align-items-center">
                        <span
                          class="d-inline-flex align-items-center justify-content-center rounded-circle bg-white shadow-sm me-3"
                          style="width:38px;height:38px;">
                          <i class="fa-solid fa-apple-whole text-primary"></i>
                        </span>
                        <span class="fw-semibold text-white">Tư vấn dinh dưỡng tim mạch</span>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="card border-0 bg-info bg-opacity-10 mb-3">
                  <div class="card-body">
                    <h5 class="fw-bold text-info mb-3">
                      <i class="fa-solid fa-hospital-user me-2"></i>Cam kết chất lượng
                    </h5>
                    <ul class="mb-0 ps-3">
                      <li>Đội ngũ bác sĩ đầu ngành, tận tâm</li>
                      <li>Trang thiết bị hiện đại, đồng bộ</li>
                      <li>Quy trình khám chữa bệnh chuyên nghiệp</li>
                      <li>Chăm sóc khách hàng 24/7</li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Đội ngũ bác sĩ -->
        <div class="card border-0 shadow-sm mb-4 rounded-4">
          <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
              <h3 class="fw-bold mb-0">
                <i class="fa-solid fa-user-doctor me-2 text-primary"></i>
                Đội ngũ bác sĩ tiêu biểu
              </h3>
              <button class="btn btn-outline-primary rounded-pill px-4">Xem tất cả</button>
            </div>
            <div class="row g-4">
              <template v-for="(value, idx) in list_bac_si" :key="idx">
                <div class="col-md-6">
                  <div class="card border-0 shadow-sm h-100 rounded-3">
                    <div class="card-body p-3">
                      <div class="d-flex align-items-center">
                        <img
                          src="https://img.freepik.com/free-photo/doctor-with-his-arms-crossed-white-background_1368-5790.jpg"
                          class="rounded-circle border border-2 border-primary me-3" width="80" height="80"
                          alt="PGS.TS Nguyễn Văn A">
                        <div>
                          <h5 class="fw-bold mb-1">{{ value.ho_ten }}</h5>
                          <p class="text-muted mb-2">{{ value.chuc_danh }}</p>
                          <div class="d-flex align-items-center mb-2">
                            <i class="fa-solid fa-star text-warning me-1"></i>
                            <span class="fw-bold me-1">{{ value.diem_danh_gia }}</span>
                            <span class="text-muted small">({{ value.so_luong_danh_gia }} đánh giá)</span>
                          </div>
                          <button class="btn btn-primary btn-sm rounded-pill px-3">
                            <i class="fa-solid fa-calendar-check me-1"></i>Đặt lịch khám
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </template>
            </div>
          </div>
        </div>

        <!-- Cơ sở vật chất -->
        <div class="card border-0 shadow-sm rounded-4">
          <div class="card-body p-4">
            <h3 class="fw-bold mb-4 text-primary">
              <i class="fa-solid fa-hospital me-2"></i>Cơ sở vật chất & tiện nghi
            </h3>
            <div class="row g-4">
              <div class="col-md-6">
                <div class="bg-light rounded-3 p-3 h-100 shadow-sm">
                  <img
                    src="https://img.freepik.com/free-photo/empty-hospital-room-with-beds-medical-equipment_1340-32.jpg"
                    class="img-fluid rounded mb-3 border border-2" alt="Phòng khám tim mạch">
                  <h5 class="fw-bold mb-2">Phòng khám tim mạch</h5>
                  <p class="text-muted mb-0">Được trang bị đầy đủ thiết bị hiện đại phục vụ khám và điều trị.</p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="bg-light rounded-3 p-3 h-100 shadow-sm">
                  <img src="https://img.freepik.com/free-photo/medical-equipment-modern-operating-room_1340-32.jpg"
                    class="img-fluid rounded mb-3 border border-2" alt="Phòng can thiệp tim mạch">
                  <h5 class="fw-bold mb-2">Phòng can thiệp tim mạch</h5>
                  <p class="text-muted mb-0">Hệ thống máy chụp mạch vành DSA hiện đại bậc nhất.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Sidebar -->
      <div class="col-lg-4">
        <!-- Đặt lịch nhanh -->
        <div class="card border-0 shadow-sm mb-4 rounded-4">
          <div class="card-body p-4">
            <h4 class="fw-bold mb-4">
              <i class="fa-solid fa-calendar-plus text-primary me-2"></i>Đặt lịch nhanh
            </h4>
            <form>
              <div class="mb-3">
                <label class="form-label">Chọn bác sĩ</label>
                <select class="form-select rounded-pill" required>
                  <option value="">-- Chọn bác sĩ --</option>
                  <option>PGS.TS Nguyễn Văn A</option>
                  <option>TS.BS Lê Thị B</option>
                </select>
              </div>
              <div class="mb-3">
                <label class="form-label">Ngày khám</label>
                <input type="date" class="form-control rounded-pill" required>
              </div>
              <div class="mb-3">
                <label class="form-label">Giờ khám</label>
                <select class="form-select rounded-pill" required>
                  <option value="">-- Chọn giờ --</option>
                  <option>08:00</option>
                  <option>09:00</option>
                  <option>10:00</option>
                  <option>14:00</option>
                  <option>15:00</option>
                  <option>16:00</option>
                </select>
              </div>
              <div class="mb-3">
                <label class="form-label">Ghi chú</label>
                <textarea class="form-control rounded-3" rows="3"></textarea>
              </div>
              <button type="submit" class="btn btn-primary w-100 rounded-pill fw-bold py-2">
                <i class="fa-solid fa-calendar-check me-2"></i>Xác nhận đặt lịch
              </button>
            </form>
          </div>
        </div>

        <!-- Giờ làm việc -->
        <div class="card border-0 shadow-sm mb-4 rounded-4">
          <div class="card-body p-4">
            <h4 class="fw-bold mb-4">
              <i class="fa-solid fa-clock text-primary me-2"></i>Giờ làm việc
            </h4>
            <ul class="list-unstyled mb-0">
              <li class="d-flex justify-content-between mb-2">
                <span>Thứ 2 - Thứ 6</span>
                <span class="fw-bold text-primary">7:30 - 18:00</span>
              </li>
              <li class="d-flex justify-content-between mb-2">
                <span>Thứ 7</span>
                <span class="fw-bold text-primary">7:30 - 17:00</span>
              </li>
              <li class="d-flex justify-content-between">
                <span>Chủ nhật</span>
                <span class="fw-bold text-primary">8:00 - 12:00</span>
              </li>
            </ul>
          </div>
        </div>

        <!-- Thông tin liên hệ -->
        <div class="card border-0 shadow-sm rounded-4">
          <div class="card-body p-4">
            <h4 class="fw-bold mb-4">
              <i class="fa-solid fa-address-book text-primary me-2"></i>
              Thông tin liên hệ
            </h4>
            <hr class="text-primary">
            <ul class="list-group list-group-flush">
              <li class="list-group-item border-0 px-0 py-3 d-flex align-items-center">
                <div class="me-3">
                  <span
                    class="d-inline-flex align-items-center justify-content-center rounded-circle bg-primary bg-opacity-10"
                    style="width: 44px; height: 44px;">
                    <i class="fa-solid fa-phone text-white fs-5"></i>
                  </span>
                </div>
                <div>
                  <div class="fw-bold mb-1">Tổng đài tư vấn</div>
                  <div class="text-dark fw-bold fs-6 mb-0">0905523543</div>
                  <small class="text-muted">Hỗ trợ 24/7</small>
                </div>
              </li>
              <li class="list-group-item border-0 px-0 py-3 d-flex align-items-center">
                <div class="me-3">
                  <span
                    class="d-inline-flex align-items-center justify-content-center rounded-circle bg-success bg-opacity-10"
                    style="width: 44px; height: 44px;">
                    <i class="fa-solid fa-envelope text-white fs-5"></i>
                  </span>
                </div>
                <div>
                  <div class="fw-bold mb-1">Email</div>
                  <div class="text-dark mb-0">quoclongdn@gmail.com</div>
                  <small class="text-muted">Phản hồi trong 24h</small>
                </div>
              </li>
              <li class="list-group-item border-0 px-0 py-3 d-flex align-items-center">
                <div class="me-3">
                  <span
                    class="d-inline-flex align-items-center justify-content-center rounded-circle bg-warning bg-opacity-10"
                    style="width: 44px; height: 44px;">
                    <i class="fa-solid fa-map-marker-alt text-warning fs-5"></i>
                  </span>
                </div>
                <div>
                  <div class="fw-bold mb-1">Địa chỉ</div>
                  <div class="text-dark mb-0">32 Xuân Diệu, Đà Nẵng</div>
                  <button class="btn btn-outline-warning btn-sm mt-2 d-inline-flex align-items-center">
                    <i class="fas fa-directions text-warning me-1"></i>Chỉ đường
                  </button>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import axios from 'axios';
export default {
  data() {
    return {
      khoa: {},
      list_bac_si: []
    }
  },
  mounted() {
    this.loadData();
  },
  methods: {
    loadData() {
      axios
        .get(`http://127.0.0.1:8000/api/client/chuyen-khoa/chi-tiet/${this.$route.params.id}`)
        .then((res) => {
          this.khoa = res.data.data;
          this.list_bac_si = res.data.data_bac_si;
        });
    }
  }
}
</script>
<style></style>