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
                                        <h3 class="">Đăng nhập</h3>
                                    </div>
                                    <div class="form-body">
                                        <form class="row g-3" >
                                            <div class="col-12">
                                                <label class="form-label">Email</label>
                                                <input type="email" class="form-control" v-model="user.email" required />
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Mật khẩu</label>
                                                <div class="input-group">
                                                    <input :type="showPassword ? 'text' : 'password'" 
                                                          class="form-control border-end-0" 
                                                          v-model="user.password"
                                                          required />
                                                    <span class="input-group-text bg-transparent" 
                                                          @click="showPassword = !showPassword">
                                                        <i class="bx" :class="showPassword ? 'bx-hide' : 'bx-show'"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <router-link to="/quen-mat-khau">Quên mật khẩu?</router-link>
                                            </div>
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="button" class="btn btn-primary" v-on:click="DangNhap()"><i
                                                        class="fa-solid fa-lock-open"></i>Đăng
                                                    Nhập</button>
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
import baseRequestBenhNhan from '../../../core/baseRequestBenhNhan';
export default {
    name: 'AdminLogin',
    data() {
        return {
            user: {
                email: '',
                password: ''
            },
            showPassword: false,    
        }
    },
    methods: {
        DangNhap() {
            baseRequestBenhNhan.post('benh-nhan/login', this.user)
                .then((res) => {
                    if (res.data.status) {
                        this.$toast.success(res.data.message)
                        this.user = {};
                        localStorage.setItem('token_benh_nhan', res.data.token);
                        localStorage.setItem('ho_ten_benh_nhan', res.data.ho_ten);
                        this.$router.push('/');
                    } else {
                        this.$toast.error(res.data.message);
                    }
                })
                .catch((err) => {
                    const listErr = err.response.data.errors;
                    Object.values(listErr).forEach((error) => {
                        this.$toast.error(error[0]);
                    });
                })
        }
       
    }
}
</script>
