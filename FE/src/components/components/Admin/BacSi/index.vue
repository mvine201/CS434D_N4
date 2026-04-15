<template>
    <div class="row">
        <div class="col-lg-12">
            <div class="card radius-10 border-top border-0 border-3 border-info">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mt-2">Danh Sách Bác Sĩ</h4>
                    <div>
                        <button class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#themmoiKhachhangModal">Thêm Mới</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-2 mt-2">
                        <div class="col-lg-12">
                            <div class="position-relative search-bar-box input-group" style="width: 100%;">
                                <input @keyup.enter="searchBacSi()" v-model="tim_kiem.noi_dung_tim" type="text"
                                    class="form-control search-control" placeholder="Tìm kiếm theo tên bác sĩ...">
                                <span class="position-absolute top-50 search-show translate-middle-y"><i
                                        class='bx bx-search'></i></span>
                                <span class="position-absolute top-50 search-close translate-middle-y"><i
                                        class='bx bx-x'></i></span>
                                <button v-on:click="searchBacSi()" class="btn btn-primary">Tìm Kiếm</button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered mb-0">
                        <thead>
                            <tr class="text-center align-middle text-nowrap text-light bg-primary">
                                <th>#</th>
                                <th>Họ Tên</th>
                                <th>Email</th>
                                <th>Số Điện Thoại</th>
                                <th>Chuyên Khoa</th>
                                <th>Ngày Sinh</th>
                                <th>Phòng Khám</th>
                                <th>Tình Trạng</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(value, index) in list_bac_si" :key="index" class="align-middle">
                                <th class="text-center">{{ index + 1 }}</th>
                                <td>{{ value.ho_ten }}</td>
                                <td>{{ value.email }}</td>
                                <td class="text-center">{{ value.so_dien_thoai }}</td>
                                <td class="">{{ value.list_chuyen_khoa }}</td>
                                <td class="text-center">{{  value.ngay_sinh }}</td>
                                <td >{{ value.ten_phong_kham }}</td>
                                <td class="text-center" style="width: 200px;" >
                                    <button class="btn btn-success me-1 w-100" v-if="value.tinh_trang == 1" v-on:click="changeStatusBacSi(value)">Hoạt
                                        Động</button>
                                    <button class="btn btn-danger me-1 w-100" v-else v-on:click="changeStatusBacSi(value)">Tạm Tắt</button>
                                </td>
                                <td class="text-center" style="width: 300px;">
                                    <button class="btn btn-info me-1"
                                        v-on:click="Object.assign(view_bac_si, value)"
                                        data-bs-toggle="modal" data-bs-target="#viewBacSiModal"
                                        title="Xem">
                                        <i class="bx bx-show"></i>
                                    </button>
                                    <button class="btn btn-primary me-1" 
                                        data-bs-toggle="modal" data-bs-target="#capNhatKhachhangModal"
                                        v-on:click="Object.assign(update_bac_si, value)"
                                        title="Cập Nhật">
                                        <i class="bx bx-edit"></i>
                                    </button>
                                    <button class="btn btn-danger"  data-bs-toggle="modal"
                                        data-bs-target="#xoaKhachhangModal"
                                        v-on:click="Object.assign(del_bac_si, value)"
                                        title="Xóa">
                                        <i class="bx bx-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="themmoiKhachhangModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thêm Mới Bác Sĩ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label>Họ Tên</label>
                            <input type="text" class="form-control" v-model="create_bac_si.ho_ten" required>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label>Email</label>
                            <input type="email" class="form-control" v-model="create_bac_si.email" required>
                        </div>
                       
                        <div class="col-md-6 mb-2">
                            <label>Số Điện Thoại</label>
                            <input type="text" class="form-control" v-model="create_bac_si.so_dien_thoai" required>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label>Ngày sinh</label>
                            <input type="date" class="form-control" v-model="create_bac_si.ngay_sinh" required>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label>Giới Tính</label>
                            <select class="form-select" v-model.number="create_bac_si.gioi_tinh" required>
                                <option :value="1">Nam</option>
                                <option :value="0">Nữ</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label>Phòng Khám</label>
                            <select class="form-select" v-model="create_bac_si.id_phong_kham" >
                                <option value="">-- Chọn phòng khám --</option>
                                <option v-for="p in list_phong_kham" :key="p.id" :value="p.id">{{ p.ten_phong_kham}}</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label>Chuyên Khoa</label>
                            <select class="form-select" multiple v-model="create_bac_si.chuyen_khoa" >
                                <option v-for="ck in list_chuyen_khoa" :key="ck.id" :value="ck.id">{{ ck.ten_chuyen_khoa }}</option>
                            </select>
                            <small class="text-muted">Giữ phím Ctrl (Windows) hoặc Command (Mac) để chọn nhiều chuyên khoa</small>
                        </div>
                        <div class="col-md-3 mb-2">
                            <label>Chức Danh</label>
                            <input type="text" class="form-control" v-model="create_bac_si.chuc_danh">
                        </div>
                        <div class="col-md-3 mb-2">
                            <label>Số Năm Kinh Nghiệm</label>
                            <input type="number" class="form-control" v-model.number="create_bac_si.so_nam_kinh_nghiem">
                        </div>
                        <div class="col-md-6 mb-2">
                            <label>Mô Tả</label>
                            <textarea class="form-control" rows="3" v-model="create_bac_si.mo_ta"></textarea>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label>Kinh Nghiệm Làm Việc</label>
                            <textarea class="form-control" rows="3" v-model="create_bac_si.kinh_nghiem_lam_viec"></textarea>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label>Quá Trình Đào Tạo</label>
                            <textarea class="form-control" rows="3" v-model="create_bac_si.qua_trinh_dao_tao"></textarea>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label>Chứng Chỉ</label>
                            <textarea class="form-control" rows="3" v-model="create_bac_si.chung_chi"></textarea>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label>Thành Tựu</label>
                            <textarea class="form-control" rows="3" v-model="create_bac_si.thanh_tuu"></textarea>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label>Thành Viên Tổ Chức</label>
                            <textarea class="form-control" rows="3" v-model="create_bac_si.thanh_vien_to_chuc"></textarea>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label>Tình Trạng</label>
                            <select class="form-select" v-model.number="create_bac_si.tinh_trang">
                                <option :value="1">Hoạt Động</option>
                                <option :value="0">Tạm Tắt</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label>Hình Ảnh</label>
                            <input type="text" class="form-control" v-model="create_bac_si.hinh_anh" placeholder="Nhập đường dẫn ảnh">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" @click="themMoiBacSi">Xác
                        Nhận</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="capNhatKhachhangModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cập Nhật Bác Sĩ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label>Họ Tên</label>
                            <input type="text" class="form-control" v-model="update_bac_si.ho_ten" required>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label>Email</label>
                            <input type="email" class="form-control" v-model="update_bac_si.email" required>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label>Số Điện Thoại</label>
                            <input type="text" class="form-control" v-model="update_bac_si.so_dien_thoai" required>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label>Ngày sinh</label>
                            <input type="date" class="form-control" v-model="update_bac_si.ngay_sinh" required>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label>Giới Tính</label>
                            <select class="form-select" v-model.number="update_bac_si.gioi_tinh" required>
                                <option :value="1">Nam</option>
                                <option :value="0">Nữ</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label>Phòng Khám</label>
                            <select class="form-select" v-model="update_bac_si.id_phong_kham" required>
                                <option value="">-- Chọn phòng khám --</option>
                                <option v-for="phongKham in list_phong_kham" :key="phongKham.id" :value="phongKham.id">
                                    {{ phongKham.ten_phong_kham }}
                                </option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label>Chuyên Khoa</label>
                            <select class="form-select" multiple v-model="update_bac_si.chuyen_khoa">
                                <option v-for="ck in list_chuyen_khoa" :key="ck.id" :value="ck.id">
                                    {{ ck.ten_chuyen_khoa }}
                                </option>
                            </select>
                            <small class="text-muted">Giữ phím Ctrl (Windows) hoặc Command (Mac) để chọn nhiều chuyên khoa</small>
                        </div>
                        <div class="col-md-3 mb-2">
                            <label>Chức Danh</label>
                            <input type="text" class="form-control" v-model="update_bac_si.chuc_danh">
                        </div>
                        <div class="col-md-3 mb-2">
                            <label>Số Năm Kinh Nghiệm</label>
                            <input type="number" class="form-control" v-model.number="update_bac_si.so_nam_kinh_nghiem">
                        </div>
                        <div class="col-md-6 mb-2">
                            <label>Mô Tả</label>
                            <textarea class="form-control" rows="3" v-model="update_bac_si.mo_ta"></textarea>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label>Kinh Nghiệm Làm Việc</label>
                            <textarea class="form-control" rows="3" v-model="update_bac_si.kinh_nghiem_lam_viec"></textarea>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label>Quá Trình Đào Tạo</label>
                            <textarea class="form-control" rows="3" v-model="update_bac_si.qua_trinh_dao_tao"></textarea>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label>Chứng Chỉ</label>
                            <textarea class="form-control" rows="3" v-model="update_bac_si.chung_chi"></textarea>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label>Thành Tựu</label>
                            <textarea class="form-control" rows="3" v-model="update_bac_si.thanh_tuu"></textarea>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label>Thành Viên Tổ Chức</label>
                            <textarea class="form-control" rows="3" v-model="update_bac_si.thanh_vien_to_chuc"></textarea>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label>Tình Trạng</label>
                            <select class="form-select" v-model="update_bac_si.tinh_trang">
                                <option :value="1">Hoạt Động</option>
                                <option :value="0">Tạm Tắt</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label>Hình Ảnh</label>
                            <input type="text" class="form-control" v-model="update_bac_si.hinh_anh" 
                                placeholder="Nhập đường dẫn ảnh">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" v-on:click="upDateBacSi()">
                        Xác Nhận
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="xoaKhachhangModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Xóa Bác Sĩ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show py-2">
                        <div class="d-flex align-items-center">
                            <div class="font-35 text-white"><i class="bx bxs-message-square-x"></i></div>
                            <div class="ms-3">
                                <h6 class="mb-0 text-white">Cảnh Báo!</h6>
                                <div class="text-white">Bạn có chắc chắn xóa bác sĩ <b>{{ del_bac_si.ho_ten }}</b> này không!</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" @click="xoaBacSi()">
                        Xác Nhận
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add View Modal -->
    <div class="modal fade" id="viewBacSiModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header text-white">
                    <h5 class="modal-title" id="exampleModalLabel">
                        <i class='bx bx-user-circle me-2'></i>
                        Thông Tin Chi Tiết Bác Sĩ
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 text-center mb-4">
                            <img :src="view_bac_si.hinh_anh"
                                 class="rounded-circle border border-3 border-primary mb-3" 
                                 width="150" height="150">
                            <h4 class="mb-1">{{ view_bac_si.ho_ten}}</h4>
                            <p class="text-muted mb-2">
                                Chuyên khoa: {{ view_bac_si.list_chuyen_khoa}}
                            </p>
                            <p class="text-primary mb-0">
                                <i class='bx bx-hospital me-1'></i>
                                {{ view_bac_si.ten_phong_kham}}
                            </p>
                        </div>

                        <div class="col-12">
                            <div class="card mb-3">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0"><i class='bx bx-user me-2'></i>Thông Tin Cơ Bản</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <div class="d-flex align-items-center">
                                                <i class='bx bx-envelope text-primary me-2'></i>
                                                <div>
                                                    <small class="text-muted d-block">Email</small>
                                                    <span>{{ view_bac_si.email}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="d-flex align-items-center">
                                                <i class='bx bx-phone text-primary me-2'></i>
                                                <div>
                                                    <small class="text-muted d-block">Số Điện Thoại</small>
                                                    <span>{{ view_bac_si.so_dien_thoai}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="d-flex align-items-center">
                                                <i class='bx bx-calendar text-primary me-2'></i>
                                                <div>
                                                    <small class="text-muted d-block">Ngày Sinh</small>
                                                    <span>{{view_bac_si.ngay_sinh}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="d-flex align-items-center">
                                                <i class='bx bx-user-pin text-primary me-2'></i>
                                                <div>
                                                    <small class="text-muted d-block">Giới Tính</small>
                                                    <span>{{ view_bac_si.gioi_tinh === 1 ? 'Nam' : 'Nữ'}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="d-flex align-items-center">
                                                <i class='bx bx-time-five text-primary me-2'></i>
                                                <div>
                                                    <small class="text-muted d-block">Kinh Nghiệm</small>
                                                    <span>{{ view_bac_si.so_nam_kinh_nghiem || 0 }} năm</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="d-flex align-items-center">
                                                <i class='bx bx-briefcase text-primary me-2'></i>
                                                <div>
                                                    <small class="text-muted d-block">Chức Danh</small>
                                                    <span>{{ view_bac_si.chuc_danh}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0"><i class='bx bx-detail me-2'></i>Thông Tin Chi Tiết</h6>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <h6 class="text-primary mb-2">Chuyên Khoa</h6>
                                        <p class="mb-0">{{ view_bac_si.list_chuyen_khoa}}</p>
                                    </div>
                                    <div class="mb-3">
                                        <h6 class="text-primary mb-2">Kinh Nghiệm Làm Việc</h6>
                                        <p class="mb-0">{{ view_bac_si.kinh_nghiem_lam_viec}}</p>
                                    </div>
                                    <div class="mb-3">
                                        <h6 class="text-primary mb-2">Quá Trình Đào Tạo</h6>
                                        <p class="mb-0">{{ view_bac_si.qua_trinh_dao_tao}}</p>
                                    </div>
                                    <div class="mb-3">
                                        <h6 class="text-primary mb-2">Chứng Chỉ</h6>
                                        <p class="mb-0">{{ view_bac_si.chung_chi}}</p>
                                    </div>
                                    <div class="mb-3">
                                        <h6 class="text-primary mb-2">Thành Tựu</h6>
                                        <p class="mb-0">{{ view_bac_si.thanh_tuu}}</p>
                                    </div>
                                    <div class="mb-3">
                                        <h6 class="text-primary mb-2">Thành Viên Tổ Chức</h6>
                                        <p class="mb-0">{{ view_bac_si.thanh_vien_to_chuc}}</p>
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
            list_bac_si: [],
            list_phong_kham: [],
            list_chuyen_khoa: [],
            create_bac_si: {
                ho_ten: '',
                email: '',
                so_dien_thoai: '',
                ngay_sinh: '',
                gioi_tinh: 1,
                mo_ta: '',
                hinh_anh: '',
                chuc_danh: '',
                so_nam_kinh_nghiem: '',
                kinh_nghiem_lam_viec: '',
                qua_trinh_dao_tao: '',
                chung_chi: '',
                thanh_tuu: '',
                thanh_vien_to_chuc: '',
                tinh_trang: 1,
                id_phong_kham: '',
                chuyen_khoa: []
            },
            update_bac_si: {
                id: '',
                ho_ten: '',
                email: '',
                so_dien_thoai: '',
                ngay_sinh: '',
                gioi_tinh: 1,
                mo_ta: '',
                hinh_anh: '',
                chuc_danh: '',
                so_nam_kinh_nghiem: '',
                kinh_nghiem_lam_viec: '',
                qua_trinh_dao_tao: '',
                chung_chi: '',
                thanh_tuu: '',
                thanh_vien_to_chuc: '',
                tinh_trang: 1,
                id_phong_kham: '',
                chuyen_khoa: []
            },
            del_bac_si: {
                id: '',
            },
            tim_kiem: {
                noi_dung_tim: ''
            },
            view_bac_si: {},
        };
    },
    mounted() {
        this.loadData();
        this.loadPhongKham();
        this.loadChuyenKhoa();
    },
    methods: {
        loadChuyenKhoa() {
            baseRequestAdmin.get('admin/chuyen-khoa/data')
                .then((res) => {
                    if (res.data.status) {
                        this.list_chuyen_khoa = res.data.data;
                    } else {
                        this.$toast.error(res.data.message);
                    }
                });
        },
        loadData() {
            baseRequestAdmin.get('admin/bac-si/data')
                .then((res) => {
                    if (res.data.status) {
                        this.list_bac_si = res.data.data;
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
        loadPhongKham() {
            baseRequestAdmin.get('admin/phong-kham/data')
                .then((res) => {
                    if (res.data.status) {
                        this.list_phong_kham = res.data.data;
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
        searchBacSi() {
            baseRequestAdmin.post('admin/bac-si/search', this.tim_kiem)
                .then((res) => {
                    if (res.data.status) {
                        this.list_bac_si = res.data.data;
                        this.$toast.success(res.data.message);
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
        themMoiBacSi() {
            baseRequestAdmin.post('admin/bac-si/create', this.create_bac_si)
                .then((res) => {
                    if (res.data.status) {
                        this.$toast.success(res.data.message);
                        this.loadData();
                        this.create_bac_si = {};
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
        upDateBacSi() {
            baseRequestAdmin.post('admin/bac-si/update', this.update_bac_si)
                .then((res) => {
                    if (res.data.status == true) {
                        this.$toast.success(res.data.message);
                        this.loadData();
                        this.update_bac_si = {
                            id: '',
                            ho_ten: '',
                            email: '',
                            so_dien_thoai: '',
                            ngay_sinh: '',
                            gioi_tinh: 1,
                            mo_ta: '',
                            hinh_anh: '',
                            chuc_danh: '',
                            so_nam_kinh_nghiem: '',
                            kinh_nghiem_lam_viec: '',
                            qua_trinh_dao_tao: '',
                            chung_chi: '',
                            thanh_tuu: '',
                            thanh_vien_to_chuc: '',
                            tinh_trang: 1,
                            id_phong_kham: '',
                            chuyen_khoa: []
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
        xoaBacSi() {
            baseRequestAdmin.post('admin/bac-si/delete', this.del_bac_si)
                .then((res) => {
                    if (res.data.status == true) {
                        this.$toast.success(res.data.message);
                        this.loadData();
                        this.del_bac_si = {};
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
        changeStatusBacSi(value) {
            baseRequestAdmin.post('admin/bac-si/change-status', value)
                .then((res) => {
                    if (res.data.status == true) {
                        this.$toast.success(res.data.message);
                        this.loadData();
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
    }
};
</script>

