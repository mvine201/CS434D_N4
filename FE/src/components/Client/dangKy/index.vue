<template>
    <div class="register-page">
        <!-- Background decoration -->
        <div class="bg-decor">
            <div class="circle circle-1"></div>
            <div class="circle circle-2"></div>
            <div class="circle circle-3"></div>
        </div>

        <div class="register-container">
            <!-- Left panel -->
            <div class="left-panel">
                <div class="brand">
                    <div class="brand-icon">
                        <svg width="32" height="32" viewBox="0 0 32 32" fill="none">
                            <rect width="32" height="32" rx="10" fill="white" fill-opacity="0.2"/>
                            <path d="M16 7v18M7 16h18" stroke="white" stroke-width="3" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <span class="brand-name">MediCare</span>
                </div>
                <div class="left-content">
                    <h1>Chào mừng bạn<br/>đến với chúng tôi</h1>
                    <p>Đăng ký để đặt lịch khám, theo dõi hồ sơ sức khỏe và kết nối với các bác sĩ hàng đầu.</p>
                    <div class="features">
                        <div class="feature-item">
                            <div class="feature-dot"></div>
                            <span>Đặt lịch khám nhanh chóng</span>
                        </div>
                        <div class="feature-item">
                            <div class="feature-dot"></div>
                            <span>Hồ sơ bệnh án điện tử</span>
                        </div>
                        <div class="feature-item">
                            <div class="feature-dot"></div>
                            <span>Kết nối bác sĩ chuyên khoa</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right panel - Form -->
            <div class="right-panel">
                <div class="form-wrapper">
                    <div class="form-header">
                        <h2>Tạo tài khoản</h2>
                        <p>Điền thông tin bên dưới để đăng ký</p>
                    </div>

                    <form v-on:submit.prevent="dangky()" class="register-form">
                        <!-- Email -->
                        <div class="field-group full">
                            <label>Email <span class="required">*</span></label>
                            <div class="input-wrap">
                                <span class="input-icon">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                        <polyline points="22,6 12,13 2,6"/>
                                    </svg>
                                </span>
                                <input v-model="dangKyForm.email" type="email" placeholder="example@email.com" required />
                            </div>
                        </div>

                        <!-- Password row -->
                        <div class="field-row">
                            <div class="field-group">
                                <label>Mật khẩu <span class="required">*</span></label>
                                <div class="input-wrap">
                                    <span class="input-icon">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                                            <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                                        </svg>
                                    </span>
                                    <input v-model="dangKyForm.password"
                                        :type="showPassword ? 'text' : 'password'"
                                        placeholder="Nhập mật khẩu" required />
                                    <span class="toggle-pw" @click="showPassword = !showPassword">
                                        <i class="bx" :class="showPassword ? 'bx-hide' : 'bx-show'"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="field-group">
                                <label>Nhập lại mật khẩu <span class="required">*</span></label>
                                <div class="input-wrap">
                                    <span class="input-icon">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                                            <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                                        </svg>
                                    </span>
                                    <input v-model="dangKyForm.re_password"
                                        :type="showPassword ? 'text' : 'password'"
                                        placeholder="Xác nhận mật khẩu" required />
                                    <span class="toggle-pw" @click="showPassword = !showPassword">
                                        <i class="bx" :class="showPassword ? 'bx-hide' : 'bx-show'"></i>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Full name -->
                        <div class="field-group full">
                            <label>Họ và tên <span class="required">*</span></label>
                            <div class="input-wrap">
                                <span class="input-icon">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                        <circle cx="12" cy="7" r="4"/>
                                    </svg>
                                </span>
                                <input v-model="dangKyForm.ho_ten" type="text" placeholder="Nguyễn Văn A" required />
                            </div>
                        </div>

                        <!-- Phone + Address -->
                        <div class="field-row">
                            <div class="field-group">
                                <label>Số điện thoại <span class="required">*</span></label>
                                <div class="input-wrap">
                                    <span class="input-icon">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13.6 19.79 19.79 0 0 1 1.61 5a2 2 0 0 1 1.95-2.18h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 10.1a16 16 0 0 0 6 6l.91-.91a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 17z"/>
                                        </svg>
                                    </span>
                                    <input v-model="dangKyForm.so_dien_thoai" type="text" placeholder="0912 345 678" required />
                                </div>
                            </div>
                            <div class="field-group">
                                <label>Địa chỉ <span class="required">*</span></label>
                                <div class="input-wrap">
                                    <span class="input-icon">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                                            <circle cx="12" cy="10" r="3"/>
                                        </svg>
                                    </span>
                                    <input v-model="dangKyForm.dia_chi" type="text" placeholder="Số nhà, đường, quận..." required />
                                </div>
                            </div>
                        </div>

                        <!-- DOB + Gender -->
                        <div class="field-row">
                            <div class="field-group">
                                <label>Ngày sinh <span class="required">*</span></label>
                                <div class="input-wrap">
                                    <span class="input-icon">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                                            <line x1="16" y1="2" x2="16" y2="6"/>
                                            <line x1="8" y1="2" x2="8" y2="6"/>
                                            <line x1="3" y1="10" x2="21" y2="10"/>
                                        </svg>
                                    </span>
                                    <input v-model="dangKyForm.ngay_sinh" type="date" required />
                                </div>
                            </div>
                            <div class="field-group">
                                <label>Giới tính <span class="required">*</span></label>
                                <div class="input-wrap">
                                    <span class="input-icon">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <circle cx="12" cy="8" r="4"/>
                                            <path d="M12 12v8M8 16h8"/>
                                        </svg>
                                    </span>
                                    <select v-model="dangKyForm.gioi_tinh" required>
                                        <option value="" disabled selected>Chọn giới tính</option>
                                        <option value="0">Nam</option>
                                        <option value="1">Nữ</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Submit -->
                        <button type="submit" class="submit-btn">
                            <span>Đăng ký ngay</span>
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <line x1="5" y1="12" x2="19" y2="12"/>
                                <polyline points="12,5 19,12 12,19"/>
                            </svg>
                        </button>

                        <p class="login-link">
                            Đã có tài khoản?
                            <router-link to="/login">Đăng nhập</router-link>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    name: 'DangKyClient',
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
    methods: {
        dangky() {
            axios
                .post("http://127.0.0.1:8000/api/benh-nhan/register", this.dangKyForm)
                .then(response => {
                    if (response.data.status) {
                        this.$toast.success(response.data.message);
                        this.$router.push('/login');
                    } else {
                        this.$toast.error(response.data.message);
                    }
                })
                .catch(err => {
                    if (err.response?.data?.errors) {
                        Object.values(err.response.data.errors).forEach(error => {
                            this.$toast.error(error[0]);
                        });
                    }
                });
        }
    }
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@300;400;500;600;700&display=swap');

* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

.register-page {
    font-family: 'Be Vietnam Pro', sans-serif;
    min-height: 100vh;
    background: #f0f4ff;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
    position: relative;
    overflow: hidden;
}

/* Background decoration */
.bg-decor {
    position: fixed;
    inset: 0;
    pointer-events: none;
    z-index: 0;
}
.circle {
    position: absolute;
    border-radius: 50%;
    opacity: 0.15;
}
.circle-1 {
    width: 500px; height: 500px;
    background: radial-gradient(circle, #2563eb, transparent);
    top: -200px; right: -100px;
}
.circle-2 {
    width: 350px; height: 350px;
    background: radial-gradient(circle, #06b6d4, transparent);
    bottom: -100px; left: -80px;
}
.circle-3 {
    width: 200px; height: 200px;
    background: radial-gradient(circle, #818cf8, transparent);
    top: 50%; left: 30%;
}

/* Main container */
.register-container {
    position: relative;
    z-index: 1;
    width: 100%;
    max-width: 960px;
    display: grid;
    grid-template-columns: 1fr 1.4fr;
    background: white;
    border-radius: 24px;
    overflow: hidden;
    box-shadow: 0 25px 80px rgba(37, 99, 235, 0.15);
}

/* Left panel */
.left-panel {
    background: linear-gradient(145deg, #1d4ed8 0%, #0ea5e9 100%);
    padding: 48px 40px;
    display: flex;
    flex-direction: column;
    color: white;
    position: relative;
    overflow: hidden;
}
.left-panel::before {
    content: '';
    position: absolute;
    width: 250px; height: 250px;
    border-radius: 50%;
    background: rgba(255,255,255,0.05);
    bottom: -80px; right: -80px;
}

.brand {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 60px;
}
.brand-name {
    font-size: 20px;
    font-weight: 700;
    letter-spacing: -0.3px;
}

.left-content h1 {
    font-size: 30px;
    font-weight: 700;
    line-height: 1.35;
    margin-bottom: 16px;
    letter-spacing: -0.5px;
}
.left-content p {
    font-size: 14px;
    line-height: 1.7;
    opacity: 0.85;
    margin-bottom: 40px;
}

.features {
    display: flex;
    flex-direction: column;
    gap: 14px;
}
.feature-item {
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 14px;
    font-weight: 500;
}
.feature-dot {
    width: 8px; height: 8px;
    border-radius: 50%;
    background: rgba(255,255,255,0.7);
    flex-shrink: 0;
}

/* Right panel */
.right-panel {
    padding: 40px 44px;
    overflow-y: auto;
    max-height: 100vh;
}

.form-header {
    margin-bottom: 28px;
}
.form-header h2 {
    font-size: 26px;
    font-weight: 700;
    color: #0f172a;
    letter-spacing: -0.5px;
    margin-bottom: 6px;
}
.form-header p {
    font-size: 14px;
    color: #64748b;
}

/* Form layout */
.register-form {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.field-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 14px;
}

.field-group {
    display: flex;
    flex-direction: column;
    gap: 6px;
}
.field-group.full {
    grid-column: 1 / -1;
}

label {
    font-size: 13px;
    font-weight: 600;
    color: #374151;
    letter-spacing: 0.1px;
}
.required {
    color: #ef4444;
}

.input-wrap {
    position: relative;
    display: flex;
    align-items: center;
}
.input-icon {
    position: absolute;
    left: 12px;
    color: #94a3b8;
    display: flex;
    align-items: center;
    pointer-events: none;
}
.input-wrap input,
.input-wrap select {
    width: 100%;
    padding: 10px 12px 10px 38px;
    border: 1.5px solid #e2e8f0;
    border-radius: 10px;
    font-size: 14px;
    font-family: 'Be Vietnam Pro', sans-serif;
    color: #1e293b;
    background: #f8fafc;
    transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
    outline: none;
    appearance: none;
}
.input-wrap input::placeholder {
    color: #cbd5e1;
}
.input-wrap input:focus,
.input-wrap select:focus {
    border-color: #2563eb;
    background: white;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
}

.toggle-pw {
    position: absolute;
    right: 12px;
    color: #94a3b8;
    cursor: pointer;
    display: flex;
    align-items: center;
    font-size: 16px;
    transition: color 0.2s;
}
.toggle-pw:hover { color: #475569; }

/* Submit button */
.submit-btn {
    margin-top: 6px;
    width: 100%;
    padding: 13px 24px;
    background: linear-gradient(135deg, #2563eb, #0ea5e9);
    color: white;
    border: none;
    border-radius: 12px;
    font-size: 15px;
    font-weight: 600;
    font-family: 'Be Vietnam Pro', sans-serif;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    transition: opacity 0.2s, transform 0.15s, box-shadow 0.2s;
    box-shadow: 0 4px 20px rgba(37, 99, 235, 0.35);
    letter-spacing: 0.2px;
}
.submit-btn:hover {
    opacity: 0.92;
    transform: translateY(-1px);
    box-shadow: 0 6px 28px rgba(37, 99, 235, 0.45);
}
.submit-btn:active {
    transform: translateY(0);
}

.login-link {
    text-align: center;
    font-size: 13.5px;
    color: #64748b;
}
.login-link a {
    color: #2563eb;
    font-weight: 600;
    text-decoration: none;
    margin-left: 4px;
}
.login-link a:hover { text-decoration: underline; }

/* Responsive */
@media (max-width: 700px) {
    .register-container {
        grid-template-columns: 1fr;
    }
    .left-panel {
        padding: 32px 28px;
    }
    .left-content h1 { font-size: 22px; }
    .right-panel {
        padding: 28px 24px;
    }
    .field-row {
        grid-template-columns: 1fr;
    }
}
</style>
