<template>
    <div class="section-authentication-signin d-flex align-items-center justify-content-center">
        <div class="container">
            <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-2">
                <div class="col mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <div class="p-4 rounded  border">
                                <div class="text-center">
                                    <img src="../../../assets/images/icons/forgot-2.png" width="120" alt="">
                                </div>
                                <div class="text-center">
                                    <h4 class="mt-3 font-weight-bold">Quên Mật Khẩu?</h4>
                                    <p class="text-muted">Nhập Email để lấy lại mật khẩu</p>
                                </div>
                                <div class="my-4">
                                    <input v-model="benh_nhan.email" type="text" class="form-control form-control-lg"
                                        placeholder="Nhập vào Email">
                                </div>
                                <div class="d-grid gap-2">
                                    <button v-on:click="GuiMatKhau()" type="button" class="btn btn-primary btn-lg">Gửi</button>
                                    <router-link to="/login">
                                        <a class="btn btn-light w-100"><i class="bx bx-arrow-back mr-1"></i>Quay lại trang
                                            đăng nhập</a>
                                    </router-link>
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
    data() {
        return {
            benh_nhan : {
                email: '',
            }
        }
    },
    methods: {
        GuiMatKhau() {
            baseRequestBenhNhan.post('benh-nhan/quen-mat-khau', this.benh_nhan)
                .then((res) => {
                    if (res.data.status) {
                        this.$toast.success(res.data.message);
                        this.$router.push('/login');
                    } else {
                        this.$toast.error(res.data.message);
                        this.$router.push('/dang-ky');
                    }
                })
                .catch((err) => {
                    const listErr = err.response.data.errors;
                    Object.values(listErr).forEach((error) => {
                        this.$toast.error(error[0]);
                    });
                })
        }
    },
}
</script>
<style></style>