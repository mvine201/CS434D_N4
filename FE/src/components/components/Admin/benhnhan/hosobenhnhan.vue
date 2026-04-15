<template>
    <div class="row">
        <div class="col-lg-12">
            <div class="card radius-10 border-top border-0 border-3 border-info">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="mt-2"><b>HỒ SƠ BỆNH ÁN</b></h4>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                        Thêm hồ sơ bệnh án
                    </button>
                </div>
                <div class="row mb-2 mt-2">
                    <div class="col-lg-12">
                        <div class="position-relative search-bar-box input-group" style="width: 100%;">
                            <input @keyup="timKiem()" v-model="tim_kiem.noi_dung_tim" type="text"
                                class="form-control search-control" placeholder="Tìm kiếm theo tên bệnh nhân...">
                            <span class="position-absolute top-50 search-show translate-middle-y"><i
                                    class='bx bx-search'></i></span>
                            <span class="position-absolute top-50 search-close translate-middle-y"><i
                                    class='bx bx-x'></i></span>
                            <button v-on:click="timKiem()" class="btn btn-primary">Tìm Kiếm</button>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr class="bg-primary text-light text-nowrap">
                                <th class="text-center">#</th>
                                <th class="text-center">Bệnh Nhân</th>
                                <th class="text-center">Bác Sĩ</th>
                                <th class="text-center">Ngày Khám</th>
                                <th class="text-center">Chẩn Đoán</th>
                                <th class="text-center">Ghi Chú</th>
                                <th class="text-center">Trạng Thái</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-for="(value, index) in list_ho_so" :key="index">
                                <tr class="text-nowrap">
                                    <th class="align-middle text-center">{{ index + 1 }}</th>
                                    <td class="align-middle">{{ value.ten_benh_nhan }}</td>
                                    <td class="align-middle">{{ value.ten_bac_si }}</td>
                                    <td class="align-middle text-center">{{ value.ngay_dat_hen }}</td>  
                                    <td class="align-middle">{{ value.chuan_doan }}</td>
                                    <td class="align-middle">{{ value.ghi_chu }}</td>
                                    <td class="align-middle text-center">
                                        <button @click="changeStatus(value)" v-if="value.trang_thai === 0" class="btn btn-warning w-100">Chờ xác
                                            nhận</button>
                                        <button @click="changeStatus(value)" v-else-if="value.trang_thai === 1" class="btn btn-info w-100">Đã xác
                                            nhận</button>
                                        <button @click="changeStatus(value)" v-else-if="value.trang_thai === 2" class="btn btn-danger w-100">Đã hủy</button>
                                        <button @click="changeStatus(value)" v-else-if="value.trang_thai === 3" class="btn btn-success w-100">Đã thành
                                            công</button>
                                    </td>
                                    <td class="align-middle text-center">
                                        <button v-on:click="Object.assign(view_ho_so, value)"
                                            class="btn btn-info me-2" data-bs-toggle="modal"
                                            data-bs-target="#viewModal">
                                            <i class='bx bx-show me-1'></i>Xem
                                        </button>
                                        <button v-on:click="Object.assign(edit_ho_so, value)"
                                            class="btn btn-primary me-2" data-bs-toggle="modal"
                                            data-bs-target="#updateModal">
                                            <i class='bx bx-edit me-1'></i>Sửa
                                        </button>
                                        <button v-on:click="Object.assign(del_ho_so, value)" class="btn btn-danger"
                                            data-bs-toggle="modal" data-bs-target="#deleteModal">
                                            <i class='bx bx-trash me-1'></i>Xóa
                                        </button>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Thêm Mới -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Thêm Hồ Sơ Bệnh Án</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Bệnh Nhân</label>
                            <select v-model="create_ho_so.id_benh_nhan" class="form-select">
                                <option value="">-- Chọn bệnh nhân --</option>
                                <template v-for="(value, index) in list_benh_nhan" :key="index">
                                    <option :value="value.id">{{ value.ho_ten }}</option>
                                </template>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Bác Sĩ</label>
                            <select v-model="create_ho_so.id_bac_si" class="form-select">
                                <option value="">-- Chọn bác sĩ --</option>
                                <template v-for="(value, index) in list_bac_si" :key="index">
                                    <option :value="value.id">{{ value.ho_ten }}</option>
                                </template>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Ngày Đặt Hẹn</label>
                            <input v-model="create_ho_so.ngay_dat_hen" type="date" class="form-control" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Lý Do Khám</label>
                            <textarea v-model="create_ho_so.ly_do_kham" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Chẩn Đoán</label>
                            <textarea v-model="create_ho_so.chuan_doan" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Đơn Thuốc</label>
                            <textarea v-model="create_ho_so.don_thuoc" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Ghi Chú</label>
                            <textarea v-model="create_ho_so.ghi_chu" class="form-control" rows="3"></textarea>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Trạng Thái</label>
                            <select v-model="create_ho_so.trang_thai" class="form-select">
                                <option :value="0">Chờ xác nhận</option>
                                <option :value="1">Đã xác nhận</option>
                                <option :value="2">Đã hủy</option>
                                <option :value="3">Đã thành công</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Đóng
                    </button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" v-on:click="themHoSo()">
                        Thêm mới
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Cập Nhật -->
    <div class="modal fade" id="updateModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cập Nhật Hồ Sơ Bệnh Án</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Bệnh Nhân</label>
                            <select v-model="edit_ho_so.id_benh_nhan" class="form-select">
                                <option value="">-- Chọn bệnh nhân --</option>
                                <template v-for="(value, index) in list_benh_nhan" :key="index">
                                    <option :value="value.id">{{ value.ho_ten }}</option>
                                </template>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Bác Sĩ</label>
                            <select v-model="edit_ho_so.id_bac_si" class="form-select">
                                <option value="">-- Chọn bác sĩ --</option>
                                <template v-for="(value, index) in list_bac_si" :key="index">
                                    <option :value="value.id">{{ value.ho_ten }}</option>
                                </template>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Ngày Đặt Hẹn</label>
                            <input v-model="edit_ho_so.ngay_dat_hen" type="date" class="form-control" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Lý Do Khám</label>
                            <textarea v-model="edit_ho_so.ly_do_kham" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Chẩn Đoán</label>
                            <textarea v-model="edit_ho_so.chuan_doan" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Đơn Thuốc</label>
                            <textarea v-model="edit_ho_so.don_thuoc" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Ghi Chú</label>
                            <textarea v-model="edit_ho_so.ghi_chu" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Trạng Thái</label>
                            <select v-model="edit_ho_so.trang_thai" class="form-select">
                                <option :value="0">Chờ xác nhận</option>
                                <option :value="1">Đã xác nhận</option>
                                <option :value="2">Đã hủy</option>
                                <option :value="3">Đã thành công</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Đóng
                    </button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" v-on:click="capNhatHoSo()">
                        Cập nhật
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="updateModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cập Nhật Hồ Sơ Bệnh Án</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Bệnh Nhân</label>
                            <select v-model="edit_ho_so.id_benh_nhan" class="form-select">
                                <option value="">-- Chọn bệnh nhân --</option>
                                <template v-for="(value, index) in list_benh_nhan" :key="index">
                                    <option :value="value.id">{{ value.ten_benh_nhan }}</option>
                                </template>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Bác Sĩ</label>
                            <select v-model="edit_ho_so.id_bac_si" class="form-select">
                                <option value="">-- Chọn bác sĩ --</option>
                                <template v-for="(value, index) in list_bac_si" :key="index">
                                    <option :value="value.id">{{ value.ten_bac_si }}</option>
                                </template>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Ngày Khám</label>
                            <input v-model="edit_ho_so.ngay_dat_hen" type="date" class="form-control" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Triệu Chứng</label>
                            <textarea v-model="edit_ho_so.ly_do_kham" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Chẩn Đoán</label>
                            <textarea v-model="edit_ho_so.chuan_doan" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Đơn Thuốc</label>
                            <textarea v-model="edit_ho_so.don_thuoc" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Ghi Chú</label>
                            <textarea v-model="edit_ho_so.ghi_chu" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Lý Do Khám</label>
                            <textarea v-model="edit_ho_so.ly_do_kham" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Trạng Thái</label>
                            <select v-model="edit_ho_so.trang_thai" class="form-select">
                                <option :value="0">Chờ xác nhận</option>
                                <option :value="1">Đã xác nhận</option>
                                <option :value="2">Đã hủy</option>
                                <option :value="3">Đã thành công</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Đóng
                    </button>
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal" v-on:click="capNhatHoSo()">
                        Cập nhật
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Xóa -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Xóa Hồ Sơ Bệnh Án</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" role="alert">
                        Bạn có chắc chắn muốn xóa hồ sơ bệnh án của bệnh nhân
                        <strong>{{ del_ho_so.ten_benh_nhan }}</strong>?
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Đóng
                    </button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" v-on:click="xoaHoSo()">
                        Xác nhận
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal View Chi Tiết -->
    <div class="modal fade" id="viewModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title mb-0 text-white">
                        Chi Tiết Hồ Sơ Khám Bệnh
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card mb-4 border-0 shadow-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-6 mb-3 mb-md-0">
                                    <h6 class="mb-1 fw-bold">
                                        Bệnh nhân
                                    </h6>
                                    <div>{{ view_ho_so.ten_benh_nhan }}</div>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="mb-1 fw-bold">
                                        Bác sĩ phụ trách
                                    </h6>
                                    <div>{{ view_ho_so.ten_bac_si}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4 border-0 shadow-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-6 mb-3 mb-md-0">
                                    <h6 class="mb-1 fw-bold">
                                        Ngày khám
                                    </h6>
                                    <div>{{ view_ho_so.ngay_dat_hen}}</div>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="mb-1 fw-bold">
                                        Trạng thái
                                    </h6>
                                    <div>
                                        <button v-if="view_ho_so.trang_thai === 0" class="btn btn-warning text-dark">Chờ xác nhận</button>
                                        <button v-else-if="view_ho_so.trang_thai === 1" class="btn btn-info text-dark">Đã xác nhận</button>
                                        <button v-else-if="view_ho_so.trang_thai === 2" class="btn btn-danger">Đã hủy</button>
                                        <button v-else-if="view_ho_so.trang_thai === 3" class="btn btn-success">Đã thành công</button>
                                        <button v-else class="text-muted">Không xác định</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h6 class="fw-bold mb-3">
                                Thông tin khám bệnh
                            </h6>
                            <div class="row gy-3">
                                <div class="col-md-6">
                                    <div>
                                        <span class="fw-semibold">Triệu chứng:</span>
                                        <div>{{ view_ho_so.ly_do_kham}}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div>
                                        <span class="fw-semibold">Chẩn đoán:</span>
                                        <div>{{ view_ho_so.chuan_doan}}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div>
                                        <span class="fw-semibold">Đơn thuốc:</span>
                                        <div>{{ view_ho_so.don_thuoc}}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div>
                                        <span class="fw-semibold">Ghi chú:</span>
                                        <div>{{ view_ho_so.ghi_chu}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
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
            list_ho_so: [],
            list_benh_nhan: [],
            list_bac_si: [],
            create_ho_so: {
                id_benh_nhan: "",
                id_bac_si: "",
                ngay_dat_hen: "",
                chuan_doan: "",
                don_thuoc: "",
                ghi_chu: "",
                ly_do_kham: "",
                trang_thai: 0
            },
            edit_ho_so: {
                id: "",
                id_benh_nhan: "",
                id_bac_si: "",
                thoi_gian_bat_dau: "",
                trieu_chung: "",
                chuan_doan: "",
                don_thuoc: "",
                ghi_chu: "",
                ly_do_kham: "",
                trang_thai: 0
            },
            view_ho_so: {},
            del_ho_so: {},
            tim_kiem: {
                noi_dung_tim: "",
            },
        };
    },
    mounted() {
        this.loadData();
        this.loadBenhNhan();
        this.loadBacSi();
    },
    methods: {
        timKiem() {
            baseRequestAdmin.post('admin/ho-so-benh-an/tim-kiem', {
                noi_dung_tim: this.tim_kiem.noi_dung_tim,
            })
                .then((res) => {
                    if (res.data.status) {
                        this.list_ho_so = res.data.data;
                    } else {
                        this.$toast.error(res.data.message);
                    }
                })
                .catch((res) => {
                    const list = Object.values(res.response.data.errors);
                    list.forEach((v) => {
                        this.$toast.error(v[0]);
                    });
                });
        },
        loadBenhNhan() {
            baseRequestAdmin.get('admin/benh-nhan/data')
                .then(response => {
                    if (response.data.status) {
                        this.list_benh_nhan = response.data.data;
                    } else {
                        this.$toast.error(response.data.message);
                    }
                })
                .catch((res) => {
                    const list = Object.values(res.response.data.errors);
                    list.forEach((v) => {
                        this.$toast.error(v[0]);
                    });
                });
        },
        loadBacSi() {
            baseRequestAdmin.get('admin/bac-si/data')
                .then(response => {
                    if (response.data.status) {
                        this.list_bac_si = response.data.data;
                    } else {
                        this.$toast.error(response.data.message);
                    }
                })
                .catch((res) => {
                    const list = Object.values(res.response.data.errors);
                    list.forEach((v) => {
                        this.$toast.error(v[0]);
                    });
                });
        },
        loadData() {
            baseRequestAdmin.get('admin/ho-so-benh-an/data')
                .then((res) => {
                    if (res.data.status) {
                        this.list_ho_so = res.data.data;
                    } else {
                        this.$toast.error(res.data.message);
                    }
                })
                .catch((res) => {
                    const list = Object.values(res.response.data.errors);
                    list.forEach((v) => {
                        this.$toast.error(v[0]);
                    });
                });
        },
        themHoSo() {
            baseRequestAdmin.post('admin/ho-so-benh-an/create', this.create_ho_so)
                .then((res) => {
                    if (res.data.status) {
                        this.$toast.success(res.data.message);
                        this.create_ho_so = {
                            id_benh_nhan: "",
                            id_bac_si: "",
                            ngay_dat_hen: "",
                            chuan_doan: "",
                            don_thuoc: "",
                            ghi_chu: "",
                            ly_do_kham: "",
                            trang_thai: 0
                        };
                        this.loadData();
                    } else {
                        this.$toast.error(res.data.message);
                    }
                })
                .catch(res => {
                    const list = Object.values(res.response.data.errors);
                    list.forEach((v) => {
                        this.$toast.error(v[0]);
                    });
                });
        },
        capNhatHoSo() {
            baseRequestAdmin.post('admin/ho-so-benh-an/update', this.edit_ho_so)
                .then((res) => {
                    if (res.data.status) {
                        this.$toast.success(res.data.message);
                        this.loadData();
                    } else {
                        this.$toast.error(res.data.message);
                    }
                })
                .catch(res => {
                    const list = Object.values(res.response.data.errors);
                    list.forEach((v) => {
                        this.$toast.error(v[0]);
                    });
                });
        },
        xoaHoSo() {
            baseRequestAdmin.post('admin/ho-so-benh-an/delete', this.del_ho_so)
                .then((res) => {
                    if (res.data.status) {
                        this.$toast.success(res.data.message);
                        this.loadData();
                    } else {
                        this.$toast.error(res.data.message);
                    }
                })
                .catch(res => {
                    const list = Object.values(res.response.data.errors);
                    list.forEach((v) => {
                        this.$toast.error(v[0]);
                    });
                });
        },
        changeStatus(value) {
            baseRequestAdmin.post('admin/ho-so-benh-an/change-status', value)
                .then((res) => {
                    if (res.data.status) {
                        this.$toast.success(res.data.message);
                        this.loadData();
                    } else {
                        this.$toast.error(res.data.message);
                    }
                })
                .catch((err) => {
                    console.error(err);
                    this.$toast.error(res.data.message);
                });
        },
    },
};
</script>

<style scoped>
</style>