<template>
  <div class="container py-5">
    <!-- Doctor Header -->
    <div class="card border-0 shadow-lg mb-5 bg-primary bg-gradient text-white">
      <div class="card-body py-5 px-4 px-lg-5">
        <div class="row align-items-center justify-content-center flex-lg-nowrap flex-wrap">
          <div class="col-lg-3 text-center mb-4 mb-lg-0">
            <div class="mb-3 d-flex justify-content-center">
              <img :src="doctor.hinh_anh" class="rounded-circle border  border-4 border-white shadow"
                style="width: 140px; height: 140px; object-fit: cover;" alt="PGS.TS Nguyễn Văn Nhân">
            </div>
          </div>
          <div class="col-lg-9 text-lg-start text-center">
            <h1 class="display-4 fw-bold mb-1 text-white">{{ doctor.ho_ten }}</h1>
            <p class="lead mb-1 fw-semibold">{{ doctor.chuc_danh }}</p>
            <p class="mb-4 fs-5">{{ doctor.ten_chuyen_khoa }}</p>
            <div class="d-flex flex-wrap gap-3 mb-4 justify-content-center justify-content-lg-start">
              <div
                class="rounded-circle d-flex flex-column align-items-center justify-content-center shadow bg-white bg-opacity-75"
                style="width: 90px; height: 90px;">
                <span class="mb-1"><i class="fas fa-star text-warning fs-4"></i></span>
                <span class="fw-bold text-dark">{{ doctor.diem_danh_gia }}</span>
                <span class="text-muted small">Đánh giá</span>
              </div>
              <div
                class="rounded-circle d-flex flex-column align-items-center justify-content-center shadow bg-white bg-opacity-75"
                style="width: 90px; height: 90px;">
                <span class="mb-1"><i class="fas fa-user-md text-primary fs-4"></i></span>
                <span class="fw-bold text-dark">{{ doctor.so_nam_kinh_nghiem }}</span>
                <span class="text-muted small">Năm KN</span>
              </div>
              <div
                class="rounded-circle d-flex flex-column align-items-center justify-content-center shadow bg-white bg-opacity-75"
                style="width: 90px; height: 90px;">
                <span class="mb-1"><i class="fas fa-users text-info fs-4"></i></span>
                <span class="fw-bold text-dark">5000+</span>
                <span class="text-muted small">Bệnh nhân</span>
              </div>
            </div>
            <router-link to="/dat-kham" class="btn btn-light btn-lg px-5 fw-bold shadow border-0">
              <i class="fas fa-calendar-plus me-2"></i>Đặt lịch khám
            </router-link>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-8">
        <!-- About -->
        <div class="card border-0 shadow-sm mb-4">
          <div class="card-body p-4">
            <h3 class="fw-bold mb-4">Giới thiệu</h3>
            <div class="mb-4">
              <p>{{ doctor.mo_ta }}</p>
            </div>

            <!-- Specializations -->
            <h4 class="fw-bold mb-3">Chuyên môn</h4>
            <div class="row mb-4">
              <div class="col-md-6 mb-3">
                <div class="d-flex align-items-center">
                  <i class="fas fa-heartbeat text-danger me-2"></i>
                  <span>{{ doctor.ten_chuyen_khoa }}</span>
                </div>
              </div>
            </div>

            <!-- Education -->
            <h4 class="fw-bold mb-3">Quá trình đào tạo</h4>
            <ul class="list-group mb-4">
              <li class="list-group-item">
                <div class="row align-items-center g-0">
                  <div class="col-auto d-flex align-items-center justify-content-center" style="width:48px;">
                    <span class="text-primary fs-4"><i class="fas fa-graduation-cap"></i></span>
                  </div>
                  <div class="col">
                    <div class="fw-bold">{{ doctor.chuc_danh }}</div>
                    <div class="text-muted">{{ doctor.chuyen_khoa }}</div>
                    <small class="text-muted">{{ doctor.chuyen_khoa }}</small>
                  </div>
                </div>
              </li>
            </ul>

            <!-- Experience -->
            <h4 class="fw-bold mb-3">Kinh nghiệm làm việc</h4>
            <ul class="list-group mb-4">
              <li class="list-group-item">
                <div class="row align-items-center g-0">
                  <div class="col-auto d-flex align-items-center justify-content-center" style="width:48px;">
                    <span class="text-warning fs-4"><i class="fas fa-briefcase"></i></span>
                  </div>
                  <div class="col">
                    <div class="fw-bold">Trưởng khoa Tim mạch</div>
                    <div class="text-muted">Bệnh viện Đa khoa ABC</div>
                    <small class="text-muted">2015 - Hiện tại</small>
                  </div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="row align-items-center g-0">
                  <div class="col-auto d-flex align-items-center justify-content-center" style="width:48px;">
                    <span class="text-primary fs-4"><i class="fas fa-user-md"></i></span>
                  </div>
                  <div class="col">
                    <div class="fw-bold">Phó khoa Tim mạch</div>
                    <div class="text-muted">Bệnh viện Đa khoa ABC</div>
                    <small class="text-muted">2010 - 2015</small>
                  </div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="row align-items-center g-0">
                  <div class="col-auto d-flex align-items-center justify-content-center" style="width:48px;">
                    <span class="text-info fs-4"><i class="fas fa-hospital-alt"></i></span>
                  </div>
                  <div class="col">
                    <div class="fw-bold">Bác sĩ Tim mạch</div>
                    <div class="text-muted">Bệnh viện Bạch Mai</div>
                    <small class="text-muted">2000 - 2010</small>
                  </div>
                </div>
              </li>
            </ul>

            <!-- Reviews -->
            <h4 class="fw-bold mb-4">Đánh giá từ bệnh nhân</h4>
            <div class="mb-4">
              <div class="d-flex mb-3">
                <img src="https://img.freepik.com/free-photo/portrait-white-man-isolated_53876-40306.jpg"
                  class="rounded-circle me-3" width="60" height="60" alt="Nguyễn Văn X">
                <div>
                  <h5 class="fw-bold mb-1">Nguyễn Văn X</h5>
                  <div class="d-flex align-items-center mb-2">
                    <div class="text-warning me-2">
                      <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                        class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                    <small class="text-muted">15/03/2024</small>
                  </div>
                  <p class="mb-0">Bác sĩ rất tận tâm và chuyên nghiệp. Tôi rất hài lòng với quá trình điều trị.</p>
                </div>
              </div>
              <div class="d-flex mb-3">
                <img
                  src="https://img.freepik.com/free-photo/young-beautiful-woman-pink-warm-sweater-natural-look-smiling-portrait-isolated-long-hair_285396-896.jpg"
                  class="rounded-circle me-3" width="60" height="60" alt="Trần Thị Y">
                <div>
                  <h5 class="fw-bold mb-1">Trần Thị Y</h5>
                  <div class="d-flex align-items-center mb-2">
                    <div class="text-warning me-2">
                      <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                        class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                    <small class="text-muted">10/03/2024</small>
                  </div>
                  <p class="mb-0">Bác sĩ giải thích rất rõ ràng về tình trạng bệnh và phương pháp điều trị.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-4">
        <!-- Appointment Form -->
        <div class="card border-0 shadow-sm mb-4">
          <div class="card-body p-4">
            <h4 class="fw-bold mb-4">Đặt lịch khám</h4>
            <div class="mb-3">
              <label class="form-label">Ngày khám</label>
              <input type="date" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Giờ khám</label>
              <select class="form-select" required>
                <option value="">-- Chọn giờ --</option>
                <option>08:00</option>
                <option>09:00</option>
                <option disabled>10:00 (Đã đặt)</option>
                <option>14:00</option>
                <option>15:00</option>
                <option disabled>16:00 (Đã đặt)</option>
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label">Lý do khám</label>
              <textarea class="form-control" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary w-100">
              <i class="fas fa-calendar-check me-2"></i>Xác nhận đặt lịch
            </button>
          </div>
        </div>

        <!-- Schedule -->
        <div class="card border-0 shadow-sm mb-4">
          <div class="card-body p-4">
            <h4 class="fw-bold mb-4">Lịch khám</h4>
            <div class="table-responsive">
              <table class="table table-bordered align-middle mb-0">
                <thead class="table-light">
                  <tr>
                    <th scope="col" class="text-center">Ngày</th>
                    <th scope="col" class="text-center">Thời gian</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="fw-bold text-center">Thứ 2</td>
                    <td class="text-center"><span class="text-success">8:00 - 16:00</span></td>
                  </tr>
                  <tr>
                    <td class="fw-bold text-center">Thứ 3</td>
                    <td class="text-center"><span class="text-success">8:00 - 16:00</span></td>
                  </tr>
                  <tr>
                    <td class="fw-bold text-center">Thứ 4</td>
                    <td class="text-center"><span class="text-success">13:00 - 17:00</span></td>
                  </tr>
                  <tr>
                    <td class="fw-bold text-center">Thứ 5</td>
                    <td class="text-center"><span class="text-success">8:00 - 16:00</span></td>
                  </tr>
                  <tr>
                    <td class="fw-bold text-center">Thứ 6</td>
                    <td class="text-center"><span class="text-success">8:00 - 16:00</span></td>
                  </tr>
                  <tr>
                    <td class="fw-bold text-center">Thứ 7</td>
                    <td class="text-center"><span class="text-danger">Nghỉ</span></td>
                  </tr>
                  <tr>
                    <td class="fw-bold text-center">Chủ nhật</td>
                    <td class="text-center"><span class="text-danger">Nghỉ</span></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <!-- Contact -->
        <!-- Thông tin liên hệ đẹp, chỉ dùng Bootstrap -->
        <div class="card border-0 shadow-sm">
          <div class="card-body p-4">
            <h4 class="fw-bold mb-4">
              <i class="fas fa-address-book text-primary me-2"></i>
              Thông tin liên hệ
            </h4>
            <hr class="text-primary">
            <ul class="list-group list-group-flush">
              <li class="list-group-item border-0 px-0 pb-3 d-flex align-items-center">
                <span
                  class="d-inline-flex align-items-center justify-content-center rounded-circle bg-primary bg-opacity-10 me-3"
                  style="width:44px; height:44px;">
                  <i class="fas fa-phone text-white fs-5"></i>
                </span>
                <div>
                  <div class="fw-bold mb-1">Điện thoại</div>
                  <div class="text-muted">0123 456 789</div>
                </div>
              </li>
              <li class="list-group-item border-0 px-0 pb-3 d-flex align-items-center">
                <span
                  class="d-inline-flex align-items-center justify-content-center rounded-circle bg-primary bg-opacity-10 me-3"
                  style="width:44px; height:44px;">
                  <i class="fas fa-envelope text-white fs-5"></i>
                </span>
                <div>
                  <div class="fw-bold mb-1">Email</div>
                  <div class="text-muted">bs.nguyenvannhan@phongkham.com</div>
                </div>
              </li>
              <li class="list-group-item border-0 px-0 d-flex align-items-center">
                <span
                  class="d-inline-flex align-items-center justify-content-center rounded-circle bg-primary bg-opacity-10 me-3"
                  style="width:44px; height:44px;">
                  <i class="fas fa-map-marker-alt text-white fs-5"></i>
                </span>
                <div>
                  <div class="fw-bold mb-1">Phòng khám</div>
                  <div class="text-muted">Phòng 301, Tầng 3, Tòa nhà A</div>
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
      doctor: {}
    }
  },
  mounted() {
    this.loadData();
  },
  methods: {
    loadData() {
      axios
        .get(`http://127.0.0.1:8000/api/client/bac-si/chi-tiet/${this.$route.params.id}`)
        .then((res) => {
          this.doctor = res.data.data;
        });
    }
  }
}
</script>
<style></style>