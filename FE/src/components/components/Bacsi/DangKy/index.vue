<template>
    <div class="login-wrapper">
        <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
            <div class="container-fluid">
                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                    <div class="col mx-auto">
                        <div class="mb-4 text-center">
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="border p-4 rounded">
                                    <div class="text-center">
                                        <h3 class="">Đăng ký bác sĩ</h3>
                                    </div>
                                    <div class="form-body">
                                        <form v-on:submit.prevent="dangky()" class="row g-3">
                                            <div class="col-12">
                                                <label class="form-label">Email</label>
                                                <input tabindex="1" v-model="dangKyForm.email" type="email"
                                                    class="form-control" required />
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label">Mật khẩu</label>
                                                <div class="input-group">
                                                    <input tabindex="2" v-model="dangKyForm.password"
                                                        :type="showPassword ? 'text' : 'password'"
                                                        class="form-control border-end-0" required />
                                                    <span class="input-group-text bg-transparent"
                                                        @click="showPassword = !showPassword">
                                                        <i class="bx" :class="showPassword ? 'bx-hide' : 'bx-show'"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label">Nhập lại mật khẩu</label>
                                                <div class="input-group">
                                                    <input tabindex="2" v-model="dangKyForm.re_password"
                                                        :type="showPassword ? 'text' : 'password'"
                                                        class="form-control border-end-0" required />
                                                    <span class="input-group-text bg-transparent"
                                                        @click="showPassword = !showPassword">
                                                        <i class="bx" :class="showPassword ? 'bx-hide' : 'bx-show'"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Họ và tên</label>
                                                <input tabindex="3" v-model="dangKyForm.ho_ten" type="text"
                                                    class="form-control" required />
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Số điện thoại</label>
                                                <input tabindex="4" v-model="dangKyForm.so_dien_thoai" type="text"
                                                    class="form-control" required />
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Địa chỉ</label>
                                                <input tabindex="5" v-model="dangKyForm.dia_chi" type="text"
                                                    class="form-control" required />
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label">Ngày sinh</label>
                                                <input tabindex="6" v-model="dangKyForm.ngay_sinh" type="date"
                                                    class="form-control" required />
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label">Giới tính</label>
                                                <select tabindex="7" v-model="dangKyForm.gioi_tinh" class="form-control"
                                                    required>
                                                    <option value="0">Nam</option>
                                                    <option value="1">Nữ</option>
                                                </select>
                                            </div>
                                            <div class="col-12 ">
                                                <p class="text-center">Đã có tài khoản? <router-link
                                                        to="/bac-si/login">Đăng nhập</router-link></p>
                                            </div>
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-primary">Đăng ký</button>
                                                </div>
                                            </div>
                                        </form>
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
            dangKyForm: {
                email: '',
                password: '',
                re_password: '',
                ho_ten: '',
                so_dien_thoai: '',
                ngay_sinh: '',
                gioi_tinh: '',
                dia_chi: '',
            },
            showPassword: false,
            isLoading: false,
            error: null
        }
    },
    mounted() {
    },
    methods: {
        dangky() {
            baseRequestBacsi.post('bac-si/register', this.dangKyForm)
                .then(response => {
                    if (response.data.status) {
                        this.$toast.success(response.data.message);
                        this.$router.push('/bac-si/login');
                    } else {
                        this.$toast.error(response.data.message);
                    }
                })
                .catch((err) => {
                    this.loaded = false;
                    const listErr = err.response.data.errors;
                    Object.values(listErr).forEach((error) => {
                        this.$toast.error(error[0]);
                    });
                });
        }
    }
}
</script>
