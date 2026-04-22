<template>
    <div class="row">
        <div class="col-lg-12">
            <div class="card radius-10 border-top border-0 border-3 border-info">
                <div class="card-header">
                    <h4 class="mt-2">LỊCH HẸN CỦA TÔI</h4>
                </div>

                <!-- SEARCH -->
                <div class="row mb-2 mt-2 px-3">
                    <div class="col-md-12 d-flex gap-2">
                        <input
                            type="text"
                            class="form-control"
                            v-model="tim_kiem.ten_benh_nhan"
                            placeholder="Nhập tên bệnh nhân..."
                        >
                    </div>
                </div>

                <!-- TABLE -->
                <div class="card-body table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr class="bg-primary text-light text-nowrap text-center">
                                <th>#</th>
                                <th>Bệnh Nhân</th>
                                <th>SĐT</th>
                                <th>Thời Gian Hẹn</th>
                                <th>Lý Do</th>
                                <th>Trạng Thái</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr v-for="(item, index) in filteredLichHen" :key="index">
                                <td class="text-center">{{ index + 1 }}</td>
                                <td>{{ item.ten_benh_nhan }}</td>
                                <td>{{ item.sdt_benh_nhan }}</td>
                                <td class="text-center">{{ formatNgay(item.ngay_dat_hen) }}</td>
                                <td>{{ item.ly_do_kham }}</td>

                                <!-- STATUS -->
                                <td class="text-center">
                                    <button :class="['btn w-100', getStatusClass(item.tinh_trang)]">
                                        {{ getStatusText(item.tinh_trang) }}
                                    </button>
                                </td>

                                <!-- ACTION -->
                                <td class="text-center">
                                    <button
                                        class="btn btn-info btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#chiTietModal"
                                        @click="chi_tiet_lich_hen = { ...item }"
                                    >
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>

                            <!-- EMPTY -->
                            <tr v-if="filteredLichHen.length === 0">
                                <td colspan="7" class="text-center py-4">
                                    Không có lịch hẹn nào
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL -->
    <div class="modal fade" id="chiTietModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h5>Chi Tiết Lịch Hẹn</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <p><b>Tên:</b> {{ chi_tiet_lich_hen.ten_benh_nhan }}</p>
                    <p><b>SĐT:</b> {{ chi_tiet_lich_hen.sdt_benh_nhan }}</p>
                    <p><b>Ngày:</b> {{ formatNgay(chi_tiet_lich_hen.ngay_dat_hen) }}</p>
                    <p><b>Lý do:</b> {{ chi_tiet_lich_hen.ly_do_kham }}</p>
                    <p><b>Trạng thái:</b> {{ getStatusText(chi_tiet_lich_hen.tinh_trang) }}</p>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
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
                ten_benh_nhan: "",
                tinh_trang: ""
            },
            chi_tiet_lich_hen: {}
        };
    },

    mounted() {
        this.loadData();
    },

    computed: {
        filteredLichHen() {
            return this.list_lich_hen.filter(item => {
                const matchName = this.tim_kiem.ten_benh_nhan
                    ? item.ten_benh_nhan.toLowerCase()
                        .includes(this.tim_kiem.ten_benh_nhan.toLowerCase())
                    : true;

                return matchName;
            });
        }
    },

    methods: {
        formatNgay(date) {
            if (!date) return '-';
            return new Date(date).toLocaleDateString('vi-VN');
        },

        getStatusText(status) {
            return {
                0: "Chờ xác nhận",
                1: "Đã xác nhận",
                2: "Đã huỷ",
                3: "Hoàn thành"
            }[status] || "Không rõ";
        },

        getStatusClass(status) {
            return {
                0: "btn-warning",
                1: "btn-primary",
                2: "btn-danger",
                3: "btn-success"
            }[status] || "btn-secondary";
        },

        loadData() {
            baseRequestBacSi.get('bac-si/lich-hen/data', {
                headers: {
                    Authorization: "Bearer " + localStorage.getItem("token_bac_si")
                }
            })
            .then(res => {
                if (res.data.status) {
                    this.list_lich_hen = res.data.data;
                }
            })
            .catch(() => {
                this.$toast.error("Lỗi load dữ liệu");
            });
        }
    }
};
</script>
