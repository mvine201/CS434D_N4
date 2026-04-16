<template>
    <div class="appointment-page">
        <div class="card shadow-sm border-0 appointment-card">
            <div class="card-body p-0">
                <!-- Header -->
                <div class="page-header d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3">
                    <div>
                        <h3 class="page-title mb-1">Lịch hẹn của tôi</h3>
                        <p class="page-subtitle mb-0">
                            Theo dõi và tra cứu danh sách lịch hẹn với bệnh nhân
                        </p>
                    </div>

                    <div class="header-stat">
                        <span class="stat-number">{{ filteredAppointments.length }}</span>
                        <span class="stat-label">Lịch hẹn</span>
                    </div>
                </div>

                <!-- Filter -->
                <div class="filter-section">
                    <div class="row g-3">
                        <div class="col-12 col-lg-6">
                            <label class="form-label custom-label">Tìm theo tên bệnh nhân</label>
                            <div class="input-group search-group">
                                <span class="input-group-text bg-white border-end-0">
                                    <i class="fas fa-search text-muted"></i>
                                </span>
                                <input
                                    type="text"
                                    class="form-control border-start-0"
                                    v-model.trim="tim_kiem.ten_benh_nhan"
                                    placeholder="Nhập tên bệnh nhân..."
                                >
                            </div>
                        </div>

                        <div class="col-12 col-lg-4">
                            <label class="form-label custom-label">Lọc theo trạng thái</label>
                            <select class="form-select" v-model="tim_kiem.tinh_trang">
                                <option value="">Tất cả trạng thái</option>
                                <option value="0">Chờ xác nhận</option>
                                <option value="1">Đã xác nhận</option>
                                <option value="2">Đã huỷ</option>
                                <option value="3">Hoàn thành</option>
                            </select>
                        </div>

                        <div class="col-12 col-lg-2 d-flex align-items-end">
                            <button class="btn btn-outline-secondary w-100" @click="resetFilter">
                                <i class="fas fa-rotate-left me-1"></i> Xoá lọc
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Quick stats -->
                <div class="stats-grid">
                    <div class="mini-stat waiting">
                        <div class="mini-stat-label">Chờ xác nhận</div>
                        <div class="mini-stat-value">{{ countByStatus(0) }}</div>
                    </div>
                    <div class="mini-stat confirmed">
                        <div class="mini-stat-label">Đã xác nhận</div>
                        <div class="mini-stat-value">{{ countByStatus(1) }}</div>
                    </div>
                    <div class="mini-stat cancelled">
                        <div class="mini-stat-label">Đã huỷ</div>
                        <div class="mini-stat-value">{{ countByStatus(2) }}</div>
                    </div>
                    <div class="mini-stat done">
                        <div class="mini-stat-label">Hoàn thành</div>
                        <div class="mini-stat-value">{{ countByStatus(3) }}</div>
                    </div>
                </div>

                <!-- Table -->
                <div class="table-wrap">
                    <div class="table-responsive">
                        <table class="table custom-table align-middle mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center" width="70">#</th>
                                    <th>Bệnh nhân</th>
                                    <th>Số điện thoại</th>
                                    <th class="text-center">Thời gian hẹn</th>
                                    <th>Lý do khám</th>
                                    <th class="text-center">Trạng thái</th>
                                    <th class="text-center" width="130">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody v-if="filteredAppointments.length">
                                <tr v-for="(value, index) in filteredAppointments" :key="value.id || index">
                                    <td class="text-center fw-semibold">{{ index + 1 }}</td>

                                    <td>
                                        <div class="patient-cell">
                                            <div class="patient-avatar">
                                                {{ getInitials(value.ten_benh_nhan) }}
                                            </div>
                                            <div>
                                                <div class="patient-name">{{ value.ten_benh_nhan || '-' }}</div>
                                                <div class="patient-meta">
                                                    {{ value.email_benh_nhan || 'Chưa có email' }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td>{{ value.sdt_benh_nhan || '-' }}</td>

                                    <td class="text-center">
                                        <div class="date-primary">{{ formatNgay(value.ngay_dat_hen) }}</div>
                                    </td>

                                    <td>
                                        <div class="reason-text">
                                            {{ value.ly_do_kham || '-' }}
                                        </div>
                                    </td>

                                    <td class="text-center">
                                        <span class="status-badge" :class="getStatusClass(value.tinh_trang)">
                                            {{ getStatusLabel(value.tinh_trang) }}
                                        </span>
                                    </td>

                                    <td class="text-center">
                                        <button
                                            class="btn btn-light-primary btn-sm px-3"
                                            data-bs-toggle="modal"
                                            data-bs-target="#chiTietModal"
                                            @click="openDetail(value)"
                                        >
                                            <i class="fas fa-eye me-1"></i> Chi tiết
                                        </button>
                                    </td>
                                </tr>
                            </tbody>

                            <tbody v-else>
                                <tr>
                                    <td colspan="7" class="text-center empty-cell">
                                        <div class="empty-state">
                                            <div class="empty-icon">
                                                <i class="fas fa-calendar-times"></i>
                                            </div>
                                            <h5 class="mb-2">Không tìm thấy lịch hẹn</h5>
                                            <p class="text-muted mb-0">
                                                Hãy thử thay đổi từ khoá hoặc bộ lọc trạng thái
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="chiTietModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content custom-modal border-0">
                    <div class="modal-header border-0 pb-0">
                        <div>
                            <h5 class="modal-title mb-1">Chi tiết lịch hẹn</h5>
                            <p class="text-muted mb-0">Thông tin bệnh nhân và nội dung buổi khám</p>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body pt-3">
                        <div class="detail-block">
                            <div class="detail-block-title">
                                <i class="fas fa-user me-2"></i>Thông tin bệnh nhân
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="detail-item">
                                        <span class="label">Họ tên</span>
                                        <span class="value">{{ chi_tiet_lich_hen.ten_benh_nhan || '-' }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="detail-item">
                                        <span class="label">Số điện thoại</span>
                                        <span class="value">{{ chi_tiet_lich_hen.sdt_benh_nhan || '-' }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="detail-item">
                                        <span class="label">Ngày sinh</span>
                                        <span class="value">{{ formatNgay(chi_tiet_lich_hen.ngay_sinh_benh_nhan) }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="detail-item">
                                        <span class="label">Giới tính</span>
                                        <span class="value">{{ getGenderLabel(chi_tiet_lich_hen.gioi_tinh_benh_nhan) }}</span>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="detail-item">
                                        <span class="label">Email</span>
                                        <span class="value">{{ chi_tiet_lich_hen.email_benh_nhan || '-' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="detail-block">
                            <div class="detail-block-title">
                                <i class="fas fa-calendar-check me-2"></i>Thông tin lịch hẹn
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="detail-item">
                                        <span class="label">Ngày hẹn</span>
                                        <span class="value">{{ formatNgay(chi_tiet_lich_hen.ngay_dat_hen) }}</span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="detail-item">
                                        <span class="label">Trạng thái</span>
                                        <span>
                                            <span class="status-badge" :class="getStatusClass(chi_tiet_lich_hen.tinh_trang)">
                                                {{ getStatusLabel(chi_tiet_lich_hen.tinh_trang) }}
                                            </span>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="detail-item vertical">
                                        <span class="label">Lý do khám</span>
                                        <div class="content-box">
                                            {{ chi_tiet_lich_hen.ly_do_kham || '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12" v-if="chi_tiet_lich_hen.nhan_xet">
                                    <div class="detail-item vertical">
                                        <span class="label">Nhận xét</span>
                                        <div class="content-box">
                                            {{ chi_tiet_lich_hen.nhan_xet }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div
                            class="detail-block"
                            v-if="chi_tiet_lich_hen.chuan_doan || chi_tiet_lich_hen.don_thuoc || chi_tiet_lich_hen.ghi_chu"
                        >
                            <div class="detail-block-title">
                                <i class="fas fa-stethoscope me-2"></i>Thông tin khám bệnh
                            </div>

                            <div class="row g-3">
                                <div class="col-12" v-if="chi_tiet_lich_hen.chuan_doan">
                                    <div class="detail-item vertical">
                                        <span class="label">Chẩn đoán</span>
                                        <div class="content-box">{{ chi_tiet_lich_hen.chuan_doan }}</div>
                                    </div>
                                </div>

                                <div class="col-12" v-if="chi_tiet_lich_hen.don_thuoc">
                                    <div class="detail-item vertical">
                                        <span class="label">Đơn thuốc</span>
                                        <div class="content-box">{{ chi_tiet_lich_hen.don_thuoc }}</div>
                                    </div>
                                </div>

                                <div class="col-12" v-if="chi_tiet_lich_hen.ghi_chu">
                                    <div class="detail-item vertical">
                                        <span class="label">Ghi chú</span>
                                        <div class="content-box">{{ chi_tiet_lich_hen.ghi_chu }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer border-0 pt-0">
                        <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">
                            Đóng
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import baseRequestBacSi from '../../../core/baseRequestBacsi';

export default {
    data() {
        return {
            list_lich_hen: [],
            tim_kiem: {
                ten_benh_nhan: '',
                tinh_trang: '',
            },
            chi_tiet_lich_hen: {},
        };
    },

    computed: {
        filteredAppointments() {
            return this.list_lich_hen.filter((item) => {
                const matchName = !this.tim_kiem.ten_benh_nhan ||
                    (item.ten_benh_nhan || '')
                        .toLowerCase()
                        .includes(this.tim_kiem.ten_benh_nhan.toLowerCase());

                const matchStatus = this.tim_kiem.tinh_trang === '' ||
                    String(item.tinh_trang) === String(this.tim_kiem.tinh_trang);

                return matchName && matchStatus;
            });
        },
    },

    mounted() {
        this.loadData();
    },

    methods: {
        formatNgay(ngay) {
            try {
                if (!ngay) return '-';
                const date = new Date(ngay);
                if (Number.isNaN(date.getTime())) return '-';

                const pad = (n) => (n < 10 ? `0${n}` : `${n}`);
                return `${pad(date.getDate())}/${pad(date.getMonth() + 1)}/${date.getFullYear()}`;
            } catch (e) {
                return '-';
            }
        },

        getInitials(name) {
            if (!name) return 'BN';
            return name
                .trim()
                .split(' ')
                .slice(-2)
                .map(word => word.charAt(0).toUpperCase())
                .join('');
        },

        getGenderLabel(gender) {
            if (gender === 1 || gender === '1') return 'Nam';
            if (gender === 0 || gender === '0') return 'Nữ';
            return '-';
        },

        getStatusLabel(status) {
            switch (Number(status)) {
                case 0: return 'Chờ xác nhận';
                case 1: return 'Đã xác nhận';
                case 2: return 'Đã huỷ';
                case 3: return 'Hoàn thành';
                default: return 'Không xác định';
            }
        },

        getStatusClass(status) {
            switch (Number(status)) {
                case 0: return 'warning';
                case 1: return 'primary';
                case 2: return 'danger';
                case 3: return 'success';
                default: return 'secondary';
            }
        },

        countByStatus(status) {
            return this.list_lich_hen.filter(item => Number(item.tinh_trang) === Number(status)).length;
        },

        resetFilter() {
            this.tim_kiem = {
                ten_benh_nhan: '',
                tinh_trang: '',
            };
        },

        openDetail(value) {
            this.chi_tiet_lich_hen = { ...value };
        },

        loadData() {
            baseRequestBacSi.get('bac-si/lich-hen/data', {
                headers: {
                    Authorization: 'Bearer ' + localStorage.getItem('token_bac_si'),
                },
            })
                .then((res) => {
                    if (res.data.status) {
                        this.list_lich_hen = res.data.data || [];
                    } else {
                        this.$toast.error(res.data.message);
                    }
                })
                .catch((err) => {
                    const listErr = err?.response?.data?.errors;
                    if (listErr) {
                        Object.values(listErr).forEach((error) => {
                            this.$toast.error(error[0]);
                        });
                    } else {
                        this.$toast.error('Có lỗi xảy ra khi tải dữ liệu');
                    }
                });
        },
    },
};
</script>

<style scoped>
.appointment-page {
    padding: 24px;
    background: #f6f8fb;
    min-height: 100%;
}

.appointment-card {
    border-radius: 20px;
    overflow: hidden;
    background: #ffffff;
}

.page-header {
    padding: 24px 24px 12px;
    border-bottom: 1px solid #eef1f6;
}

.page-title {
    font-size: 26px;
    font-weight: 700;
    color: #1f2937;
}

.page-subtitle {
    color: #6b7280;
    font-size: 14px;
}

.header-stat {
    min-width: 120px;
    padding: 14px 18px;
    border-radius: 16px;
    background: linear-gradient(135deg, #0d6efd, #3b82f6);
    color: #fff;
    text-align: center;
}

.stat-number {
    display: block;
    font-size: 24px;
    font-weight: 700;
    line-height: 1;
}

.stat-label {
    font-size: 13px;
    opacity: 0.9;
}

.filter-section {
    padding: 20px 24px 12px;
}

.custom-label {
    font-weight: 600;
    color: #374151;
    font-size: 14px;
}

.search-group .input-group-text,
.search-group .form-control,
.form-select {
    height: 46px;
    border-radius: 12px;
}

.search-group .input-group-text {
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
}

.search-group .form-control {
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 16px;
    padding: 4px 24px 20px;
}

.mini-stat {
    border-radius: 16px;
    padding: 16px;
    background: #f8fafc;
    border: 1px solid #eef2f7;
}

.mini-stat-label {
    font-size: 13px;
    color: #6b7280;
    margin-bottom: 6px;
}

.mini-stat-value {
    font-size: 24px;
    font-weight: 700;
    color: #111827;
}

.mini-stat.waiting {
    background: #fffaf0;
}
.mini-stat.confirmed {
    background: #eff6ff;
}
.mini-stat.cancelled {
    background: #fef2f2;
}
.mini-stat.done {
    background: #ecfdf5;
}

.table-wrap {
    padding: 0 24px 24px;
}

.custom-table {
    border-collapse: separate;
    border-spacing: 0;
    overflow: hidden;
}

.custom-table thead th {
    background: #111827;
    color: #fff;
    font-size: 13px;
    font-weight: 600;
    padding: 14px 12px;
    border: none;
    vertical-align: middle;
    white-space: nowrap;
}

.custom-table tbody td {
    padding: 14px 12px;
    border-color: #eef2f7;
    color: #374151;
    background: #fff;
}

.custom-table tbody tr:hover td {
    background: #f9fbff;
}

.patient-cell {
    display: flex;
    align-items: center;
    gap: 12px;
}

.patient-avatar {
    width: 42px;
    height: 42px;
    border-radius: 50%;
    background: #dbeafe;
    color: #1d4ed8;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    flex-shrink: 0;
}

.patient-name {
    font-weight: 600;
    color: #111827;
}

.patient-meta {
    font-size: 13px;
    color: #6b7280;
    margin-top: 2px;
}

.date-primary {
    font-weight: 600;
    color: #111827;
}

.reason-text {
    max-width: 260px;
    white-space: normal;
    color: #4b5563;
}

.status-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 120px;
    padding: 8px 12px;
    border-radius: 999px;
    font-size: 13px;
    font-weight: 600;
}

.status-badge.warning {
    background: #fff3cd;
    color: #946200;
}

.status-badge.primary {
    background: #dbeafe;
    color: #1d4ed8;
}

.status-badge.danger {
    background: #fee2e2;
    color: #b91c1c;
}

.status-badge.success {
    background: #dcfce7;
    color: #15803d;
}

.status-badge.secondary {
    background: #e5e7eb;
    color: #4b5563;
}

.btn-light-primary {
    background: #eef4ff;
    color: #2563eb;
    border: 1px solid #dbeafe;
    border-radius: 10px;
    font-weight: 600;
}

.btn-light-primary:hover {
    background: #dbeafe;
    color: #1d4ed8;
}

.empty-cell {
    padding: 48px 20px !important;
}

.empty-state {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

.empty-icon {
    width: 72px;
    height: 72px;
    border-radius: 50%;
    background: #eef2f7;
    color: #6b7280;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 28px;
    margin-bottom: 14px;
}

.custom-modal {
    border-radius: 20px;
    overflow: hidden;
}

.detail-block {
    background: #f9fafb;
    border: 1px solid #eef2f7;
    border-radius: 16px;
    padding: 18px;
    margin-bottom: 16px;
}

.detail-block-title {
    font-size: 16px;
    font-weight: 700;
    color: #111827;
    margin-bottom: 16px;
}

.detail-item {
    display: flex;
    justify-content: space-between;
    gap: 16px;
    padding: 12px 14px;
    background: #fff;
    border: 1px solid #eef2f7;
    border-radius: 12px;
    height: 100%;
}

.detail-item.vertical {
    display: block;
}

.detail-item .label {
    display: block;
    font-size: 13px;
    color: #6b7280;
    min-width: 100px;
}

.detail-item .value {
    font-weight: 600;
    color: #111827;
    text-align: right;
}

.content-box {
    margin-top: 8px;
    padding: 12px;
    border-radius: 12px;
    background: #f8fafc;
    color: #374151;
    line-height: 1.6;
    white-space: pre-line;
}

@media (max-width: 991px) {
    .stats-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .appointment-page {
        padding: 16px;
    }

    .page-header,
    .filter-section,
    .table-wrap,
    .stats-grid {
        padding-left: 16px;
        padding-right: 16px;
    }
}

@media (max-width: 576px) {
    .stats-grid {
        grid-template-columns: 1fr;
    }

    .page-title {
        font-size: 22px;
    }

    .status-badge {
        min-width: unset;
        width: 100%;
    }

    .detail-item {
        flex-direction: column;
    }

    .detail-item .value {
        text-align: left;
    }
}
</style>