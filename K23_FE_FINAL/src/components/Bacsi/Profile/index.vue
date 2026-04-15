<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <!-- Tab Navigation -->
                        <ul class="nav nav-tabs nav-fill mb-4" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-tab"
                                    type="button" role="tab" aria-selected="true">
                                    <i class="bx bx-user me-2"></i>Thông Tin Cá Nhân
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#update-tab" type="button"
                                    role="tab" aria-selected="false">
                                    <i class="bx bx-edit me-2"></i>Cập Nhật Thông Tin
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#password-tab"
                                    type="button" role="tab" aria-selected="false">
                                    <i class="bx bx-lock me-2"></i>Đổi Mật Khẩu
                                </button>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="profile-tab" role="tabpanel">
                                <div class="row">
                                    <div class="col-lg-4 mb-4">
                                        <div class="card border-0 shadow-sm h-100">
                                            <div class="card-body text-center p-4">
                                                <div class="position-relative mb-4">
                                                    <img :src="anh_tmp || profile.hinh_anh"
                                                        class="rounded-circle border border-3 border-primary"
                                                        style="width: 150px; height: 150px; object-fit: cover;">
                                                    <div class="position-absolute bottom-0 end-0">
                                                        <label for="inputAvatar" class="btn btn-light rounded-circle p-2 shadow-sm mb-0">
                                                            <i class="bx bx-camera text-primary"></i>
                                                        </label>
                                                    </div>
                                                    <input id="inputAvatar" type="file" class="d-none" accept="image/*" @change="loadAnhTuLocal($event); uploadAvatar()">
                                                </div>

                                                <h4 class="mb-2 text-dark"><b>{{ profile.ho_ten }}</b></h4>
                                                <p class="text-muted mb-3"><b>{{ profile.chuc_danh }}</b></p>

                                                <div class="row g-2 mb-4">
                                                    <div class="col-6">
                                                        <div class="bg-light rounded-3 p-3">
                                                            <h5 class="mb-0 text-primary"><b>{{
                                                                profile.so_nam_kinh_nghiem }}</b></h5>
                                                            <small class="text-muted">Năm KN</small>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="bg-light rounded-3 p-3">
                                                            <h5 class="mb-0 text-primary">
                                                                <b><span v-if="profile.gioi_tinh == 1">Nam</span>
                                                                    <span v-else>Nữ</span>
                                                                </b>
                                                            </h5>
                                                            <small class="text-muted">Giới tính</small>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="text-start">
                                                    <div class="d-flex align-items-center mb-2">
                                                        <i class="bx bx-envelope text-primary me-2"></i>
                                                        <span class="small"><b>{{ profile.email }}</b></span>
                                                    </div>
                                                    <div class="d-flex align-items-center mb-2">
                                                        <i class="bx bx-phone text-primary me-2"></i>
                                                        <span class="small"><b>{{ profile.so_dien_thoai }}</b></span>
                                                    </div>
                                                    <div class="d-flex align-items-center mb-2">
                                                        <i class="bx bx-calendar text-primary me-2"></i>
                                                        <span class="small"><b>{{ profile.ngay_sinh }}</b></span>
                                                    </div>
                                                    <div class="d-flex align-items-center mb-2">
                                                        <i class="bx bx-building text-primary me-2"></i>
                                                        <span class="small"><b>{{ profile.ten_phong_kham }}</b></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-8">
                                        <div class="card border-0 shadow-sm mb-4">
                                            <div class="card-header bg-primary text-white">
                                                <h6 class="mb-0 text-white">
                                                    <i class="bx bx-plus-medical me-2"></i>Chuyên Khoa 
                                                </h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="row" v-if="profile.list_chuyen_khoa">
                                                    <div class="col-12">
                                                        <div class="d-flex align-items-center p-2 bg-light rounded">
                                                            <i class="bx bx-check-circle text-success me-2"></i>
                                                            <span><b>{{ profile.list_chuyen_khoa }}</b></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div v-else class="text-muted">
                                                    <i class="bx bx-info-circle me-2"></i>Chưa có thông tin chuyên khoa
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card border-0 shadow-sm mb-4">
                                            <div class="card-header bg-info text-white">
                                                <h6 class="mb-0 text-white">
                                                    <i class="bx bx-briefcase me-2"></i>Kinh Nghiệm & Đào Tạo
                                                </h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="mb-3">
                                                    <h6 class="text-muted mb-2">Kinh nghiệm làm việc</h6>
                                                    <p class="mb-0" v-if="profile.kinh_nghiem_lam_viec"><b>{{
                                                        profile.kinh_nghiem_lam_viec }}</b></p>
                                                    <p class="mb-0 text-muted" v-else>Chưa cập nhật thông tin</p>
                                                </div>
                                                <div>
                                                    <h6 class="text-muted mb-2">Quá trình đào tạo</h6>
                                                    <p class="mb-0" v-if="profile.qua_trinh_dao_tao"><b>{{
                                                        profile.qua_trinh_dao_tao }}</b></p>
                                                    <p class="mb-0 text-muted" v-else>Chưa cập nhật thông tin</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card border-0 shadow-sm mb-4">
                                            <div class="card-header bg-success text-white">
                                                <h6 class="mb-0 text-white">
                                                    <i class="bx bx-certification me-2"></i>Chứng Chỉ & Thành Tựu
                                                </h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="mb-3">
                                                    <h6 class="text-muted mb-2">Chứng chỉ</h6>
                                                    <p class="mb-0" v-if="profile.chung_chi"><b>{{ profile.chung_chi
                                                            }}</b></p>
                                                    <p class="mb-0 text-muted" v-else>Chưa cập nhật thông tin</p>
                                                </div>
                                                <div>
                                                    <h6 class="text-muted mb-2">Thành tựu</h6>
                                                    <p class="mb-0" v-if="profile.thanh_tuu"><b>{{ profile.thanh_tuu
                                                            }}</b> </p>
                                                    <p class="mb-0 text-muted" v-else>Chưa cập nhật thông tin</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card border-0 shadow-sm">
                                            <div class="card-header bg-warning text-dark">
                                                <h6 class="mb-0 text-white">
                                                    <i class="bx bx-detail me-2"></i>Thông Tin Khác
                                                </h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="mb-3">
                                                    <h6 class="text-muted mb-2">Thành viên tổ chức</h6>
                                                    <p class="mb-0" v-if="profile.thanh_vien_to_chuc"><b>{{
                                                        profile.thanh_vien_to_chuc }}</b></p>
                                                    <p class="mb-0 text-muted" v-else>Chưa cập nhật thông tin</p>
                                                </div>
                                                <div>
                                                    <h6 class="text-muted mb-2">Mô tả</h6>
                                                    <p class="mb-0" v-if="profile.mo_ta"><b>{{ profile.mo_ta }}</b></p>
                                                    <p class="mb-0 text-muted" v-else>Chưa cập nhật thông tin</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="update-tab" role="tabpanel">
                                <div class="row justify-content-center">
                                    <div class="col-lg-10">
                                        <div class="card border-0 shadow-sm">
                                            <div class="card-header bg-primary text-white"  >
                                                <h5 class="mb-0 text-white">
                                                    <i class="bx bx-edit me-2"></i>Cập Nhật Thông Tin Cá Nhân
                                                </h5>
                                            </div>
                                            <div class="card-body p-4">
                                                <form>
                                                    <div class="row g-3">
                                                        <div class="col-12">
                                                            <h6 class="text-primary mb-3">Thông Tin Cơ Bản</h6>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">Họ và Tên <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" class="form-control"
                                                                v-model="update_profile.ho_ten">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">Email <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="email" class="form-control"
                                                                v-model="update_profile.email">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">Số Điện Thoại</label>
                                                            <input type="text" class="form-control"
                                                                v-model="update_profile.so_dien_thoai">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">Ngày Sinh</label>
                                                            <input type="date" class="form-control"
                                                                v-model="update_profile.ngay_sinh">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">Giới Tính</label>
                                                            <select class="form-select"
                                                                v-model="update_profile.gioi_tinh">
                                                                <option value="1">Nam</option>
                                                                <option value="0">Nữ</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">Chức Danh</label>
                                                            <input type="text" class="form-control"
                                                                v-model="update_profile.chuc_danh">
                                                        </div>

                                                        <div class="col-12 mt-4">
                                                            <h6 class="text-primary mb-3">Thông Tin Chuyên Môn</h6>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">Số Năm Kinh Nghiệm</label>
                                                            <input type="number" class="form-control"
                                                                v-model="update_profile.so_nam_kinh_nghiem" min="0">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">Phòng Khám</label>
                                                            <select class="form-select"
                                                                v-model="update_profile.id_phong_kham" required>
                                                                <option value="">-- Chọn phòng khám --</option>
                                                                <option v-for="phongKham in list_phong_kham"
                                                                    :key="phongKham.id" :value="phongKham.id">
                                                                    {{ phongKham.ten_phong_kham }}
                                                                </option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">Chuyên Khoa</label>
                                                            <select class="form-select" multiple
                                                                v-model="update_profile.chuyen_khoa">
                                                                <option v-for="ck in list_chuyen_khoa" :key="ck.id"
                                                                    :value="ck.id">
                                                                    {{ ck.ten_chuyen_khoa }}
                                                                </option>
                                                            </select>
                                                            <small class="text-muted">Giữ phím Ctrl (Windows) hoặc
                                                                Command (Mac) để chọn nhiều chuyên khoa</small>
                                                        </div>

                                                        <div class="col-12 mt-4">
                                                            <h6 class="text-primary mb-3">Thông Tin Chi Tiết</h6>
                                                        </div>
                                                        <div class="col-12">
                                                            <label class="form-label">Kinh Nghiệm Làm Việc</label>
                                                            <textarea class="form-control" rows="3"
                                                                v-model="update_profile.kinh_nghiem_lam_viec"
                                                                placeholder="Nhập kinh nghiệm làm việc..."></textarea>
                                                        </div>
                                                        <div class="col-12">
                                                            <label class="form-label">Quá Trình Đào Tạo</label>
                                                            <textarea class="form-control" rows="3"
                                                                v-model="update_profile.qua_trinh_dao_tao"
                                                                placeholder="Nhập quá trình đào tạo..."></textarea>
                                                        </div>
                                                        <div class="col-12">
                                                            <label class="form-label">Chứng Chỉ</label>
                                                            <textarea class="form-control" rows="3"
                                                                v-model="update_profile.chung_chi"
                                                                placeholder="Nhập chứng chỉ..."></textarea>
                                                        </div>
                                                        <div class="col-12">
                                                            <label class="form-label">Thành Tựu</label>
                                                            <textarea class="form-control" rows="3"
                                                                v-model="update_profile.thanh_tuu"
                                                                placeholder="Nhập thành tựu..."></textarea>
                                                        </div>
                                                        <div class="col-12">
                                                            <label class="form-label">Thành Viên Tổ Chức</label>
                                                            <textarea class="form-control" rows="3"
                                                                v-model="update_profile.thanh_vien_to_chuc"
                                                                placeholder="Nhập thành viên tổ chức..."></textarea>
                                                        </div>
                                                        <div class="col-12">
                                                            <label class="form-label">Mô Tả</label>
                                                            <textarea class="form-control" rows="4"
                                                                v-model="update_profile.mo_ta"
                                                                placeholder="Nhập mô tả..."></textarea>
                                                        </div>
                                                        <div class="col-12">
                                                            <label class="form-label">Hình Ảnh</label>
                                                            <input type="text" class="form-control"
                                                                v-model="update_profile.hinh_anh"
                                                                placeholder="Nhập đường dẫn ảnh">
                                                        </div>

                                                        <div class="col-12 text-end mt-4">
                                                            <button type="button" class="btn btn-primary"
                                                                @click="updateProfile()">
                                                                <i class="bx bx-save me-1"></i>Cập Nhật
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="tab-pane fade" id="password-tab" role="tabpanel">
                                <div class="row justify-content-center">
                                    <div class="col-lg-6">
                                        <div class="card border-0 shadow-sm">
                                            <div class="card-header bg-warning text-dark">
                                                <h5 class="mb-0 text-white">
                                                    <i class="bx bx-lock me-2"></i>Thay Đổi Mật Khẩu
                                                </h5>
                                            </div>
                                            <div class="card-body p-4">
                                                                                                 <div class="mb-3">
                                                     <label class="form-label">Mật Khẩu Hiện Tại <span
                                                             class="text-danger">*</span></label>
                                                     <div class="input-group">
                                                         <input :type="showPassword.password ? 'text' : 'password'" class="form-control"
                                                             v-model="update_password_profile.password"
                                                             placeholder="Nhập mật khẩu hiện tại">
                                                         <button @click="showPassword.password = !showPassword.password" class="btn btn-outline-secondary" type="button">
                                                             <i :class="showPassword.password ? 'bx bx-hide' : 'bx bx-show'"></i>
                                                         </button>
                                                     </div>
                                                 </div>
                                                 <div class="mb-3">
                                                     <label class="form-label">Mật Khẩu Mới <span
                                                             class="text-danger">*</span></label>
                                                     <div class="input-group">
                                                         <input :type="showPassword.new_password ? 'text' : 'password'" class="form-control"
                                                             v-model="update_password_profile.new_password"
                                                             placeholder="Nhập mật khẩu mới">
                                                         <button @click="showPassword.new_password = !showPassword.new_password" class="btn btn-outline-secondary" type="button">
                                                             <i :class="showPassword.new_password ? 'bx bx-hide' : 'bx bx-show'"></i>
                                                         </button>
                                                     </div>
                                                 </div>
                                                 <div class="mb-4">
                                                     <label class="form-label">Xác Nhận Mật Khẩu Mới <span
                                                             class="text-danger">*</span></label>
                                                     <div class="input-group">
                                                         <input :type="showPassword.re_newpassword ? 'text' : 'password'" class="form-control"
                                                             v-model="update_password_profile.re_newpassword"
                                                             placeholder="Nhập lại mật khẩu mới">
                                                         <button @click="showPassword.re_newpassword = !showPassword.re_newpassword" class="btn btn-outline-secondary" type="button">
                                                             <i :class="showPassword.re_newpassword ? 'bx bx-hide' : 'bx bx-show'"></i>
                                                         </button>
                                                     </div>
                                                 </div>
                                                <div class="text-end">
                                                    <button type="button" class="btn btn-warning"
                                                        @click="updatePassword()">
                                                        <i class="bx bx-lock-alt me-1"></i>Đổi Mật Khẩu
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import baseRequestBacsi from '../../../core/baseRequestBacsi';
export default {
    data() {
        return {
            profile: {},
            update_profile: {},
            update_password_profile: {
                password: '',
                new_password: '',
                re_newpassword: ''
            },
            file_anh: null,
            anh_tmp: '',
            list_phong_kham: [],
            list_chuyen_khoa: [],
            showPassword: {
                password: false,
                new_password: false,
                re_newpassword: false
            },
            
        }
    },
    mounted() {
        this.loadProfile();
        this.loadPhongKham();
        this.loadChuyenKhoa();
    },
    methods: {
        loadChuyenKhoa() {
            baseRequestBacsi.get('bac-si/chuyen-khoa/data')
                .then((res) => {
                    if (res.data.status) {
                        this.list_chuyen_khoa = res.data.data;
                    } else {
                        this.$toast.error(res.data.message);
                    }
                })
                .catch((err) => {
                    const listErr = err.response.data.errors;
                    Object.values(listErr).forEach((error) => {
                        this.$toast.error(error[0]);
                    });
                });
        },
        loadPhongKham() {
            baseRequestBacsi.get('bac-si/phong-kham/data')
                .then((res) => {
                    if (res.data.status) {
                        this.list_phong_kham = res.data.data;
                    } else {
                        this.$toast.error(res.data.message);
                    }
                })
                .catch((err) => {
                    const listErr = err.response.data.errors;
                    Object.values(listErr).forEach((error) => {
                        this.$toast.error(error[0]);
                    });
                });
        },
        loadProfile() {
            baseRequestBacsi.get('bac-si/profile/data', {
                headers: {
                    Authorization: "Bearer " + localStorage.getItem("token_bac_si"),
                },
            })
                .then(res => {
                    if (res.data.status) {
                        this.profile = res.data.data;
                        this.update_profile = res.data.data;
                    } else {
                        this.$toast.error(res.data.message);
                    }
                })
                .catch((err) => {
                    const listErr = err.response.data.errors;
                    Object.values(listErr).forEach((error) => {
                        this.$toast.error(error[0]);
                    });
                });
        },
        updateProfile() {
            baseRequestBacsi.post('bac-si/profile/update', this.update_profile, {
                headers: {
                    Authorization: "Bearer " + localStorage.getItem("token_bac_si"),
                },
            })
                .then(res => {
                    if (res.data.status) {
                        this.loadProfile();
                        this.update_profile = {};
                        this.$toast.success(res.data.message);
                    } else {
                        this.$toast.error(res.data.message);
                    }
                })
                .catch((err) => {
                    const listErr = err.response.data.errors;
                    Object.values(listErr).forEach((error) => {
                        this.$toast.error(error[0]);
                    });
                });
        },
        updatePassword() {
            baseRequestBacsi.post('bac-si/profile/change-password', this.update_password_profile, {
                headers: {
                    Authorization: "Bearer " + localStorage.getItem("token_bac_si"),
                },
            }).then(res => {
                    if (res.data.status) {
                        this.$toast.success(res.data.message);
                        this.update_password_profile = {
                            password: '',
                            new_password: '',
                            re_newpassword: ''
                        };
                        this.showPassword = {
                            password: false,
                            new_password: false,
                            re_newpassword: false
                        };
                    } else {
                        this.$toast.error(res.data.message);
                    }
                })
                .catch((err) => {
                    const listErr = err.response.data.errors;
                    Object.values(listErr).forEach((error) => {
                        this.$toast.error(error[0]);
                    });
                });
        },
        
        loadAnhTuLocal(event){
            this.file_anh = event.target.files[0];
            this.anh_tmp = this.createImage(this.file_anh);
        },
        createImage(file) {
            let reader = new FileReader();
            let vm = this; 
            reader.onload = (e) => {
                vm.anh_tmp = e.target.result;
            };
            reader.readAsDataURL(file);
        },
        uploadAvatar() {
            const formData = new FormData();
            formData.append('hinh_anh', this.file_anh);
            baseRequestBacsi.post('bac-si/profile/update-avatar', formData, {
                headers: {
                    Authorization: "Bearer " + localStorage.getItem("token_bac_si"),
                    'Content-Type': 'multipart/form-data'
                }
            })
            .then((res) => {
                if (res.data.status) {
                    this.$toast.success(res.data.message);
                    this.loadProfile();
                } else {
                    this.$toast.error(res.data.message);
                }
            })
            .catch((err) => {
                const listErr = err.response.data.errors;
                Object.values(listErr).forEach((error) => {
                    this.$toast.error(error[0]);
                });
            });
        }

    }
}
</script>

<style scoped></style>