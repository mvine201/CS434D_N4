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

                        <!-- Tab Content -->
                        <div class="tab-content">
                            <!-- Thông Tin Cá Nhân -->
                            <div class="tab-pane fade show active" id="profile-tab" role="tabpanel">
                                <div class="row justify-content-center">
                                    <div class="col-lg-8">
                                        <div class="card border-0 shadow-sm">
                                            <div class="card-header bg-primary text-white">
                                                <h5 class="mb-0 text-white">
                                                    <i class="bx bx-user me-2"></i>Thông Tin Cá Nhân
                                                </h5>
                                            </div>
                                            <div class="card-body p-4">
                                                <div class="text-center mb-4">
                                                    <div class="position-relative d-inline-block">
                                                        <img :src="anh_tmp || profile.hinh_anh || '../../../assets/images/avatars/avatar-1.png'"
                                                            class="rounded-circle border border-3 border-primary"
                                                            style="width: 120px; height: 120px; object-fit: cover;">
                                                        <div class="position-absolute bottom-0 end-0">
                                                            <label for="inputAvatar"
                                                                class="btn btn-light rounded-circle p-2 shadow-sm mb-0">
                                                                <i class="bx bx-camera text-primary"></i>
                                                            </label>
                                                        </div>
                                                        <input id="inputAvatar" type="file" class="d-none"
                                                            accept="image/*"
                                                            @change="loadAnhTuLocal($event); uploadAvatar()">
                                                    </div>
                                                </div>
                                                <div class="row g-4">
                                                    <div class="col-md-6">
                                                        <div class="d-flex align-items-center p-3 bg-light rounded">
                                                            <i class="bx bx-user text-primary me-3 fs-4"></i>
                                                            <div>
                                                                <h6 class="mb-1 text-muted">Họ và Tên</h6>
                                                                <p class="mb-0 fw-bold">{{ profile.ho_ten}}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="d-flex align-items-center p-3 bg-light rounded">
                                                            <i class="bx bx-envelope text-primary me-3 fs-4"></i>
                                                            <div>
                                                                <h6 class="mb-1 text-muted">Email</h6>
                                                                <p class="mb-0 fw-bold">{{ profile.email}}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="d-flex align-items-center p-3 bg-light rounded">
                                                            <i class="bx bx-phone text-primary me-3 fs-4"></i>
                                                            <div>
                                                                <h6 class="mb-1 text-muted">Số Điện Thoại</h6>
                                                                <p class="mb-0 fw-bold">{{ profile.so_dien_thoai}}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="d-flex align-items-center p-3 bg-light rounded">
                                                            <i class="bx bx-briefcase text-primary me-3 fs-4"></i>
                                                            <div>
                                                                <h6 class="mb-1 text-muted">Chức Vụ</h6>
                                                                <p class="mb-0 fw-bold">{{ profile.ten_chuc_vu}}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Tab Cập Nhật Thông Tin -->
                            <div class="tab-pane fade" id="update-tab" role="tabpanel">
                                <div class="row justify-content-center">
                                    <div class="col-lg-8">
                                        <div class="card border-0 shadow-sm">
                                            <div class="card-header bg-primary text-white">
                                                <h5 class="mb-0 text-white">
                                                    <i class="bx bx-edit me-2"></i>Cập Nhật Thông Tin Cá Nhân
                                                </h5>
                                            </div>
                                            <div class="card-body p-4">
                                                <form>
                                                    <div class="row g-4">
                                                        <div class="col-md-6">
                                                            <label class="form-label fw-bold">
                                                                <i class="bx bx-user text-primary me-2"></i>Họ và Tên
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="text" class="form-control form-control-lg"
                                                                v-model="update_profile.ho_ten"
                                                                placeholder="Nhập họ và tên">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label fw-bold">
                                                                <i class="bx bx-envelope text-primary me-2"></i>Email
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="email" class="form-control form-control-lg"
                                                                v-model="update_profile.email" 
                                                                placeholder="Email">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label fw-bold">
                                                                <i class="bx bx-phone text-primary me-2"></i>Số Điện
                                                                Thoại
                                                            </label>
                                                            <input type="text" class="form-control form-control-lg"
                                                                v-model="update_profile.so_dien_thoai"
                                                                placeholder="Nhập số điện thoại">
                                                        </div>
                                                        <div class="col-12 text-center mt-4">
                                                            <button type="button" class="btn btn-primary btn-lg px-5"
                                                                @click="updateProfile()">
                                                                <i class="bx bx-save me-2"></i>Cập Nhật Thông Tin
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Tab Đổi Mật Khẩu -->
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
                                                        <input :type="showPassword.password ? 'text' : 'password'"
                                                            class="form-control"
                                                            v-model="update_password_profile.password"
                                                            placeholder="Nhập mật khẩu hiện tại">
                                                        <button @click="showPassword.password = !showPassword.password"
                                                            class="btn btn-outline-secondary" type="button">
                                                            <i
                                                                :class="showPassword.password ? 'bx bx-hide' : 'bx bx-show'"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Mật Khẩu Mới <span
                                                            class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <input :type="showPassword.new_password ? 'text' : 'password'"
                                                            class="form-control"
                                                            v-model="update_password_profile.new_password"
                                                            placeholder="Nhập mật khẩu mới">
                                                        <button
                                                            @click="showPassword.new_password = !showPassword.new_password"
                                                            class="btn btn-outline-secondary" type="button">
                                                            <i
                                                                :class="showPassword.new_password ? 'bx bx-hide' : 'bx bx-show'"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="mb-4">
                                                    <label class="form-label">Xác Nhận Mật Khẩu Mới <span
                                                            class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <input :type="showPassword.re_newpassword ? 'text' : 'password'"
                                                            class="form-control"
                                                            v-model="update_password_profile.re_newpassword"
                                                            placeholder="Nhập lại mật khẩu mới">
                                                        <button
                                                            @click="showPassword.re_newpassword = !showPassword.re_newpassword"
                                                            class="btn btn-outline-secondary" type="button">
                                                            <i
                                                                :class="showPassword.re_newpassword ? 'bx bx-hide' : 'bx bx-show'"></i>
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
import baseRequestAdmin from '../../../core/baseRequestAdmin';

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
            showPassword: {
                password: false,
                new_password: false,
                re_newpassword: false
            },
            list_chuc_vu: []
        }
    },
    mounted() {
        this.loadProfile();
        this.loadChucVu();
    },
    methods: {
        loadChucVu() {
            baseRequestAdmin.get('admin/chuc-vu/data')
                .then((res) => {
                    if (res.data.status) {
                        this.list_chuc_vu = res.data.data;
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
            baseRequestAdmin.get('admin/profile/data', {
                headers: {
                    Authorization: "Bearer " + localStorage.getItem("token_admin"),
                },
            })
                .then(res => {
                    if (res.data.status) {
                        this.profile = res.data.data;
                        this.update_profile = { ...res.data.data };
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
            baseRequestAdmin.post('admin/profile/update', this.update_profile, {
                headers: {
                    Authorization: "Bearer " + localStorage.getItem("token_admin"),
                },
            })
                .then(res => {
                    if (res.data.status) {
                        this.loadProfile();
                        this.$toast.success(res.data.message);
                    } else {
                        this.$toast.error(res.data.message);
                    }
                })
                .catch((err) => {
                    console.error('Lỗi khi cập nhật profile:', err);
                    if (err.response && err.response.data && err.response.data.errors) {
                        const listErr = err.response.data.errors;
                        Object.values(listErr).forEach((error) => {
                            this.$toast.error(error[0]);
                        });
                    } else {
                        this.$toast.error('Không thể cập nhật thông tin');
                    }
                });
        },
        updatePassword() {
            baseRequestAdmin.post('admin/profile/change-password', this.update_password_profile, {
                headers: {
                    Authorization: "Bearer " + localStorage.getItem("token_admin"),
                },
            })
                .then(res => {
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
        loadAnhTuLocal(event) {
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
            baseRequestAdmin.post('admin/profile/update-avatar', formData, {
                headers: {
                    Authorization: "Bearer " + localStorage.getItem("token_admin"),
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
