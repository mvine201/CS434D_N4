<template>
    <div class="receipt-container">
        <div class="receipt">
            <div class="header">
                <div class="logo">BV Đa Khoa DZCare</div>
                <div class="hospital-info">
                    <div class="address">32 Xuân Diệu, Hải Châu, TP. Đà Nẵng, Việt Nam</div>
                    <div>Email: contact@dzcare.vn</div>
                    <div>Tel: 0236 123 456 | Hotline: 1900.6017</div>
                </div>
            </div>

            <div class="receipt-title">HÓA ĐƠN KHÁM CHỮA BỆNH</div>

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
                        <span class="detail-label">SĐT</span>
                        <span class="detail-value">{{ info.so_dien_thoai_benh_nhan }}</span>
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
                        <span class="detail-value">Trong code không có</span>
                    </div>
                </div>
            </div>
            <div class="visit-section">
                <div class="section-title">Thông Tin Khám</div>
                <div class="visit-details">
                    <div class="visit-detail">
                        <span class="detail-label">Bác sĩ</span>
                        <span class="detail-value">{{ info.ten_bac_si }}</span>
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

            <div class="tickets-section">
                <div class="section-title"></div>
                <div class="ticket-item">
                    <div class="seat-info">
                        <span class="seat-number">Tổng Tiền</span>
                        <span class="seat-price">{{ info.tong_tien }}đ</span>
                    </div>
                </div>
            </div>

            <div class="transaction-info">
                <div class="transaction-id">Mã Phiếu: {{ info.ma_dat_lich }}</div>
            </div>

            <div class="qr-section">
                <div class="qr-code">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=70x70&data=DZCare-HD-20250926-001-HDBS123123-NguyenVanAn&format=png" alt="QR Code">
                </div>
                <div class="qr-label">Quét mã để xác thực hóa đơn</div>
            </div>

            <div class="perforated-edge"></div>

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
            info  : {
  "ten_benh_nhan": "Đoàn Thu Hà",
  "so_dien_thoai_benh_nhan": "0901234002",
  "email_benh_nhan": "doanthuha@example.com",
  "ma_dat_lich": "HDBS000002",
  "gioi_tinh": 0,
  "ngay_sinh": "1985-08-20",
  "ly_do_kham": "Đau đầu kéo dài",
  "tong_tien": 2200,
  "ten_bac_si": "Bác sĩ Trần Thị Bình",
  "so_dien_thoai_bac_si": "0901234568",
  "thoi_gian_bat_dau": "09:00",
  "don_gia_kham": 3000,
  "ten_phong_kham": "Phòng Khám Sài Gòn",
  "ngay_dat_hen": "25/08/2025"
}
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
                .then((response) => {
                    if(response.data.status) {
                        this.info = response.data.data;
                    } else {
                        this.$router.push('/admin/hoa-don');
                    }
                })
                .catch((error) => {
                    console.error("Error fetching bill details:", error);
                });
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
    background: white;
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
    border: 2px solid #000;
    overflow: hidden;
    position: relative;
}

.receipt-container::before {
    display: none;
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
    border-bottom: 2px solid #000;
    padding-bottom: 12px;
}

.logo {
    font-family: 'Roboto', sans-serif;
    font-size: 18px;
    font-weight: 700;
    color: #000;
    margin-bottom: 4px;
    letter-spacing: 0.5px;
    text-transform: uppercase;
}

.hospital-info {
    font-size: 10px;
    color: #000;
    line-height: 1.5;
}

.hospital-info .address {
    font-weight: 500;
    color: #000;
}

.receipt-title {
    background: #000;
    color: white;
    padding: 8px 0;
    margin: 16px -12px;
    text-align: center;
    font-weight: 700;
    font-size: 12px;
    letter-spacing: 1px;
    text-transform: uppercase;
}

.patient-section, .visit-section {
    background: white;
    margin: 0 -12px 10px -12px;
    padding: 12px;
    border: 1px solid #000;
}

.section-title {
    font-size: 11px;
    font-weight: 700;
    color: #000;
    margin-bottom: 8px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    text-align: center;
}

.patient-details, .visit-details {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 8px;
    font-size: 10px;
}

.patient-detail, .visit-detail {
    display: flex;
    flex-direction: column;
}

.detail-label {
    color: #000;
    font-weight: 500;
    margin-bottom: 2px;
}

.detail-value {
    color: #000;
    font-weight: 600;
}

.tickets-section {
    margin-bottom: 16px;
}

.ticket-item {
    background: #fff;
    border: 1px solid #000;
    padding: 10px;
    margin-bottom: 10px;
    position: relative;
    overflow: hidden;
}

.ticket-item::before {
    display: none;
}

.seat-info {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 4px;
    font-weight: 600;
}

.seat-number {
    color: #000;
    font-size: 12px;
}

.seat-price {
    color: #000;
    font-size: 12px;
    font-weight: 700;
}

.muted {
    text-align: center;
    color: #000;
    font-size: 10px;
}

.summary-section {
    background: white;
    margin: 0 -12px 16px -12px;
    padding: 12px;
    border-top: 2px solid #000;
}

.summary-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 6px;
    font-size: 10px;
}

.summary-label {
    color: #000;
}

.summary-value {
    color: #000;
    font-weight: 700;
}

.total-row {
    border-top: 1px solid #000;
    padding-top: 8px;
    margin-top: 8px;
    font-size: 12px;
}

.transaction-info {
    text-align: center;
    margin-bottom: 16px;
    font-size: 10px;
    color: #000;
}

.transaction-datetime {
    font-family: 'Roboto Mono', monospace;
    margin-bottom: 4px;
    font-weight: 500;
}

.transaction-id {
    font-family: 'Roboto Mono', monospace;
    font-size: 8px;
    color: #000;
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
    border: 2px solid #000;
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
    color: #000;
    font-weight: 500;
}

.footer {
    text-align: center;
    border-top: 2px solid #000;
    padding-top: 12px;
    font-size: 9px;
    color: #000;
    line-height: 1.6;
}

.footer-message {
    font-weight: 700;
    color: #000;
    margin-bottom: 6px;
}

.footer-note {
    margin-bottom: 4px;
}

.website {
    color: #000;
    font-weight: 600;
}

.perforated-edge {
    height: 12px;
    background: repeating-linear-gradient(90deg,
            transparent,
            transparent 8px,
            #000 8px,
            #000 12px);
    margin: 0 -12px;
}

@media print {
    body {
        background: white;
        padding: 0;
    }

    .receipt-container {
        border: none;
        width: 302px;
        max-width: 302px;
    }

    .receipt {
        color: #000 !important;
    }

    .receipt * {
        color: #000 !important;
        background: white !important;
        border-color: #000 !important;
    }

    .receipt-title {
        background: #000 !important;
        color: white !important;
    }
}
</style>