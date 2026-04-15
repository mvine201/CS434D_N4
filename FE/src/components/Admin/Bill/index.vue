<template>
    <div class="receipt-container">
        <div class="receipt">
            <!-- Header -->
            <div class="header">
                <div class="logo">BV Đa Khoa DZCare</div>
                <div class="hospital-info">
                    <div class="address">32 Xuân Diệu, Hải Châu, TP. Đà Nẵng, Việt Nam</div>
                    <div>Email: contact@dzcare.vn</div>
                    <div>Tel: 0236 123 456 | Hotline: 1900.6017</div>
                </div>
            </div>

            <!-- Title -->
            <div class="receipt-title">HÓA ĐƠN KHÁM CHỮA BỆNH</div>

            <!-- Thông tin bệnh nhân -->
            <div class="patient-section">
                <div class="section-title">Thông Tin Bệnh Nhân</div>
                <div class="patient-details">
                    <div class="patient-detail">
                        <span class="detail-label">Họ tên</span>
                        <span class="detail-value">{{ info.ten_benh_nhan }}</span>
                    </div>
                    <div class="patient-detail">
                        <span class="detail-label">Ngày sinh</span>
                        <span class="detail-value">{{ info.ngay_sinh }}</span>
                    </div>
                    <div class="patient-detail">
                        <span class="detail-label">Giới tính</span>
                        <span class="detail-value">{{ info.gioi_tinh }}</span>
                    </div>
                    <div class="patient-detail">
                        <span class="detail-label">SĐT</span>
                        <span class="detail-value">{{ info.so_dien_thoai_benh_nhan }}</span>
                    </div>
                    <div class="patient-detail">
                        <span class="detail-label">Email</span>
                        <span class="detail-value">{{ info.email_benh_nhan }}</span>
                    </div>
                    <div class="patient-detail">
                        <span class="detail-label">Ngày khám</span>
                        <span class="detail-value">{{ info.ngay_dat_hen }}</span>
                    </div>
                    <div class="patient-detail">
                        <span class="detail-label">Lý do khám</span>
                        <span class="detail-value">{{ info.ly_do_kham }}</span>
                    </div>
                    <div class="patient-detail">
                        <span class="detail-label">Chuẩn đoán</span>
                        <span class="detail-value">{{ info.chuan_doan }}</span>
                    </div>
                    <div class="patient-detail">
                        <span class="detail-label">Đơn thuốc</span>
                        <span class="detail-value">{{ info.don_thuoc }}</span>
                    </div>
                    <div class="patient-detail">
                        <span class="detail-label">Ghi chú</span>
                        <span class="detail-value">{{ info.ghi_chu }}</span>
                    </div>
                </div>
            </div>

            <!-- Thông tin khám -->
            <div class="visit-section">
                <div class="section-title">Thông Tin Khám</div>
                <div class="visit-details">
                    <div class="visit-detail">
                        <span class="detail-label">Bác sĩ</span>
                        <span class="detail-value">{{ info.ten_bac_si }}</span>
                    </div>
                    <div class="visit-detail">
                        <span class="detail-label">SĐT Bác sĩ</span>
                        <span class="detail-value">{{ info.so_dien_thoai_bac_si }}</span>
                    </div>
                    <div class="visit-detail">
                        <span class="detail-label">Chuyên khoa</span>
                        <span class="detail-value">{{ info.ten_chuyen_khoa }}</span>
                    </div>
                    <div class="visit-detail">
                        <span class="detail-label">Phòng khám</span>
                        <span class="detail-value">{{ info.ten_phong_kham }}</span>
                    </div>
                    <div class="visit-detail">
                        <span class="detail-label">Thời gian khám</span>
                        <span class="detail-value">{{ info.thoi_gian_bat_dau }} - {{ info.thoi_gian_ket_thuc }}</span>
                    </div>
                </div>
            </div>

            <!-- Tổng tiền -->
            <div class="tickets-section">
                <div class="ticket-item">
                    <div class="seat-info">
                        <span class="seat-number">Tổng Tiền</span>
                        <span class="seat-price">{{ info.don_gia_kham }}đ</span>
                    </div>
                </div>
            </div>

            <!-- Mã hóa đơn -->
            <div class="transaction-info">
                <div class="transaction-id">Mã Phiếu: HD-{{ info.ma_dat_lich }}</div>
            </div>

            <!-- QR -->
            <div class="qr-section">
                <div class="qr-code">
                    <img :src="`https://api.qrserver.com/v1/create-qr-code/?size=70x70&data=DZCare-HD-${info.ma_dat_lich}-${info.ten_bac_si}-${info.ten_benh_nhan}`"
                        alt="QR Code">
                </div>
                <div class="qr-label">Quét mã để xác thực hóa đơn</div>
            </div>

            <div class="perforated-edge"></div>

            <!-- Footer -->
            <div class="footer">
                <div class="footer-message">Cảm ơn quý khách đã sử dụng dịch vụ!</div>
                <div class="footer-note">Vui lòng giữ hóa đơn để đối chiếu khi cần</div>
                <div class="website">www.dzcare.vn</div>
            </div>
        </div>
    </div>
</template>

<script>
import baseRequestAdmin from '../../../core/baseRequestAdmin';

export default {
    props: ['id'],
    data() {
        return {
            billId: this.$route.params.id,
            info: {},
        }
    },
    mounted() {
        this.loadBill();
    },
    methods: {
        loadBill() {
            var payload = {
                id: this.billId
            };
            baseRequestAdmin.post("admin/hoa-don/chi-tiet", payload)
                .then((res) => {
                    if (res.data.status) {
                        this.info = res.data.data;
                    } else {
                        this.$route.push("/admin/hoa-don")
                    }
                })
                .catch((error) => {
                    console.error("Lỗi bill", error);
                })
        }
    }
}
</script>
<style>
@import url('https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@300;400;500;700&family=Roboto:wght@300;400;500;700&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    background: #f2f5f9;
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px;
    font-family: 'Roboto', sans-serif;
}

.receipt-container {
    background: white;
    width: 320px;
    max-width: 320px;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
    position: relative;
}

.receipt-container::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #2ecc71, #27ae60, #16a085);
}

.receipt {
    padding: 16px 12px;
    font-size: 11px;
    line-height: 1.4;
    color: #333;
    background: white;
}

.header {
    text-align: center;
    margin-bottom: 16px;
    border-bottom: 2px dashed #ddd;
    padding-bottom: 12px;
}

.logo {
    font-family: 'Roboto', sans-serif;
    font-size: 18px;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 4px;
    letter-spacing: 0.5px;
    text-transform: uppercase;
}

.hospital-info {
    font-size: 10px;
    color: #555;
    line-height: 1.5;
}

.hospital-info .address {
    font-weight: 500;
    color: #2c3e50;
}

.receipt-title {
    background: linear-gradient(45deg, #2ecc71, #27ae60);
    color: white;
    padding: 8px 0;
    margin: 16px -12px;
    text-align: center;
    font-weight: 700;
    font-size: 12px;
    letter-spacing: 1px;
    text-transform: uppercase;
}

.patient-section,
.visit-section {
    background: #f8f9fa;
    margin: 0 -12px 10px -12px;
    padding: 12px;
    border-left: 4px solid #2ecc71;
}

.section-title {
    font-size: 11px;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 8px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    text-align: center;
}

.patient-details,
.visit-details {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 8px;
    font-size: 10px;
}

.patient-detail,
.visit-detail {
    display: flex;
    flex-direction: column;
}

.detail-label {
    color: #7f8c8d;
    font-weight: 500;
    margin-bottom: 2px;
}

.detail-value {
    color: #2c3e50;
    font-weight: 600;
}

.tickets-section {
    margin-bottom: 16px;
}

.ticket-item {
    background: #fff;
    border: 1px solid #e9ecef;
    border-radius: 6px;
    padding: 10px;
    margin-bottom: 10px;
    position: relative;
    overflow: hidden;
}

.ticket-item::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 2px;
    background: linear-gradient(90deg, #2ecc71, #27ae60, #16a085);
}

.seat-info {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 4px;
    font-weight: 600;
}

.seat-number {
    color: #2c3e50;
    font-size: 12px;
}

.seat-price {
    color: #e74c3c;
    font-size: 12px;
    font-weight: 700;
}

.muted {
    text-align: center;
    color: #999;
    font-size: 10px;
}

.summary-section {
    background: #f8f9fa;
    margin: 0 -12px 16px -12px;
    padding: 12px;
    border-top: 2px dashed #ddd;
}

.summary-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 6px;
    font-size: 10px;
}

.summary-label {
    color: #666;
}

.summary-value {
    color: #2c3e50;
    font-weight: 700;
}

.total-row {
    border-top: 1px solid #ddd;
    padding-top: 8px;
    margin-top: 8px;
    font-size: 12px;
}

.transaction-info {
    text-align: center;
    margin-bottom: 16px;
    font-size: 10px;
    color: #666;
}

.transaction-datetime {
    font-family: 'Roboto Mono', monospace;
    margin-bottom: 4px;
    font-weight: 500;
}

.transaction-id {
    font-family: 'Roboto Mono', monospace;
    font-size: 8px;
    color: #999;
    word-break: break-all;
}

.qr-section {
    text-align: center;
    margin-bottom: 16px;
}

.qr-code {
    width: 70px;
    height: 70px;
    margin: 0 auto 8px auto;
    border: 2px solid #2ecc71;
    border-radius: 8px;
    background: white;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
}

.qr-code img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.qr-label {
    font-size: 9px;
    color: #7f8c8d;
    font-weight: 500;
}

.footer {
    text-align: center;
    border-top: 2px dashed #ddd;
    padding-top: 12px;
    font-size: 9px;
    color: #666;
    line-height: 1.6;
}

.footer-message {
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 6px;
}

.footer-note {
    margin-bottom: 4px;
}

.website {
    color: #2ecc71;
    font-weight: 600;
}

.perforated-edge {
    height: 12px;
    background: repeating-linear-gradient(90deg,
            transparent,
            transparent 8px,
            #ddd 8px,
            #ddd 12px);
    margin: 0 -12px;
}

@media print {
    body {
        background: white;
        padding: 0;
    }

    .receipt-container {
        box-shadow: none;
        border-radius: 0;
        width: 302px;
        max-width: 302px;
    }
}
</style>