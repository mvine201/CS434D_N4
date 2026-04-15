<template>
    <div class="row">
        <div class="col-lg-12">
            <div class="card border-0 shadow">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 text-white">
                        <i class="bx bx-images me-2"></i>
                        Quản Lý Slide
                    </h5>
                    <button class="btn btn-light btn-sm" @click="resetForm()" data-bs-toggle="modal"
                        data-bs-target="#slideModal">
                        <i class="bx bx-plus me-1"></i>Thêm Slide
                    </button>
                </div>
                <div class="card-body">
                    <!-- Slides Table -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="bg-light">
                                <tr class="align-middle text-center">
                                    <th width="10%">#</th>
                                    <th width="60%">Hình Ảnh</th>
                                    <th width="20%">Trạng Thái</th>
                                    <th width="10%">Hành Động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in list_slide" :key="index" class="align-middle">
                                    <td class="text-center">{{ index + 1 }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img :src="item.hinh_anh" class="img-thumbnail me-3"
                                                style="width: 150px; height: 90px; object-fit: cover;">
                                            <div>
                                                <div class="text-muted small">{{ item.hinh_anh }}</div>
                                                <div class="text-muted small">ID: {{ item.id }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-check form-switch d-flex justify-content-center">
                                            <input class="form-check-input" type="checkbox"
                                                :checked="item.tinh_trang == 1" @change="changeStatus(item)">
                                            <label class="form-check-label ms-2">
                                                {{ item.tinh_trang == 1 ? 'Hiển thị' : 'Ẩn' }}
                                            </label>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <button class="btn btn-outline-primary btn-sm" @click="editItem(item)"
                                                data-bs-toggle="modal" data-bs-target="#slideModal">
                                                <i class="bx bx-edit"></i>
                                            </button>
                                            <button class="btn btn-outline-danger btn-sm" @click="deleteItem(item)"
                                                data-bs-toggle="modal" data-bs-target="#xoaSlideModal">
                                                <i class="bx bx-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr v-if="list_slide.length === 0">
                                    <td colspan="4" class="text-center py-5 text-muted">
                                        <i class="bx bx-image-alt display-4"></i>
                                        <div class="mt-2">
                                            <h6>Chưa có slide nào</h6>
                                            <p class="mb-0">Nhấn "Thêm Slide" để tạo slide đầu tiên</p>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add/Edit Modal -->
    <div class="modal fade" id="slideModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title text-white">
                        <i class="bx bx-image me-2"></i>
                        {{ isEditing ? 'Cập Nhật Slide' : 'Thêm Slide Mới' }}
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label class="form-label fw-bold">
                                    Hình ảnh <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" v-model="form.hinh_anh"
                                    placeholder="Nhập đường dẫn hình ảnh">
                                <div class="form-text">Ví dụ: https://example.com/image.jpg</div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Trạng thái</label>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" v-model="form.tinh_trang"
                                        id="statusSwitch">
                                    <label class="form-check-label" for="statusSwitch">
                                        Hiển thị slide trên website
                                    </label>
                                </div>
                                <div class="form-text">
                                    {{ form.tinh_trang ? 'Slide sẽ hiển thị công khai' : 'Slide sẽ bị ẩn' }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <!-- Preview -->
                            <div class="mb-3" v-if="form.hinh_anh">
                                <label class="form-label fw-bold">Xem trước</label>
                                <div class="border rounded p-2 bg-light">
                                    <img :src="form.hinh_anh" class="img-fluid rounded"
                                        style="max-height: 200px; width: 100%; object-fit: cover;">
                                </div>
                            </div>

                            <div v-else class="text-center text-muted py-5">
                                <i class="bx bx-image display-4"></i>
                                <div class="mt-2">
                                    <small>Nhập đường dẫn hình ảnh để xem trước</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x me-1"></i>Đóng
                    </button>
                    <button type="button" class="btn btn-primary" @click="saveSlide" :disabled="!form.hinh_anh">
                        <i class="bx bx-save me-1"></i>
                        {{ isEditing ? 'Cập nhật' : 'Thêm mới' }}
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="xoaSlideModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title text-white">
                        <i class="bx bx-trash me-2"></i>Xác Nhận Xóa
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning">
                        <div class="d-flex align-items-center">
                            <i class="bx bx-error-circle fs-2 me-3 text-warning"></i>
                            <div>
                                <h6 class="mb-1">Bạn có chắc chắn muốn xóa slide này?</h6>
                                <p class="mb-1"><strong>ID: {{ delete_slide.id }}</strong></p>
                                <small class="text-muted">Hành động này không thể hoàn tác!</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x me-1"></i>Hủy
                    </button>
                    <button type="button" class="btn btn-danger" @click="deleteSlide">
                        <i class="bx bx-trash me-1"></i>Xác nhận xóa
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            list_slide: [],
            form: {
                id: '',
                hinh_anh: '',
                tinh_trang: 1
            },
            delete_slide: {},
            isEditing: false,
            loading: false
        }
    },
    mounted() {
        this.loadData();
    },
    methods: {
        loadData() {
            this.loading = true;
            axios.get('http://127.0.0.1:8000/api/admin/slide/data', {
                headers: {
                    Authorization: 'Bearer ' + localStorage.getItem("token_admin")
                }
            })
                .then(res => {
                    if (res.data.status) {
                        this.list_slide = res.data.data;
                    } else {
                        this.$toast.error(res.data.message);
                    }
                })
                .catch(res => {
                    if (res.response?.data?.errors) {
                        const list = Object.values(res.response.data.errors);
                        list.forEach((v, i) => {
                            this.$toast.error(v[0]);
                        });
                    } else {
                        this.$toast.error(res.response?.data?.message || 'Có lỗi xảy ra');
                    }
                })
                .finally(() => {
                    this.loading = false;
                });
        },

        editItem(item) {
            this.isEditing = true;
            this.form = {
                ...item,
                tinh_trang: item.tinh_trang == 1 ? 1 : 0
            };
        },

        deleteItem(item) {
            this.delete_slide = item;
        },

        saveSlide() {
            if (!this.form.hinh_anh) {
                this.$toast.error('Vui lòng nhập đường dẫn hình ảnh');
                return;
            }

            const url = this.isEditing ? 'admin/slide/update' : 'admin/slide/create';
            const payload = {
                ...this.form,
                tinh_trang: this.form.tinh_trang ? 1 : 0
            };

            axios.post(`http://127.0.0.1:8000/api/${url}`, payload, {
                headers: {
                    Authorization: 'Bearer ' + localStorage.getItem("token_admin")
                }
            })
                .then(res => {
                    if (res.data.status) {
                        this.$toast.success(res.data.message);
                        this.loadData();
                        this.form = {
                        };
                        this.isEditing = false;
                        document.querySelector('#slideModal .btn-close').click();
                    } else {
                        this.$toast.error(res.data.message);
                    }
                })
                .catch(res => {
                    if (res.response?.data?.errors) {
                        const list = Object.values(res.response.data.errors);
                        list.forEach((v, i) => {
                            this.$toast.error(v[0]);
                        });
                    } else {
                        this.$toast.error(res.response?.data?.message || 'Có lỗi xảy ra');
                    }
                });
        },

        deleteSlide() {
            axios.post('http://127.0.0.1:8000/api/admin/slide/delete', {
                id: this.delete_slide.id
            }, {
                headers: {
                    Authorization: 'Bearer ' + localStorage.getItem("token_admin")
                }
            })
                .then(res => {
                    if (res.data.status) {
                        this.$toast.success(res.data.message);
                        this.loadData();
                        document.querySelector('#xoaSlideModal .btn-close').click();
                    } else {
                        this.$toast.error(res.data.message);
                    }
                })
                .catch(res => {
                    if (res.response?.data?.errors) {
                        const list = Object.values(res.response.data.errors);
                        list.forEach((v, i) => {
                            this.$toast.error(v[0]);
                        });
                    } else {
                        this.$toast.error(res.response?.data?.message || 'Có lỗi xảy ra');
                    }
                });
        },

        changeStatus(item) {
            const payload = {
                id: item.id,
                tinh_trang: item.tinh_trang
            };

            axios.post('http://127.0.0.1:8000/api/admin/slide/change-status', payload, {
                headers: {
                    Authorization: 'Bearer ' + localStorage.getItem("token_admin")
                }
            })
                .then(res => {
                    if (res.data.status) {
                        this.$toast.success(res.data.message);
                        this.loadData();
                    } else {
                        this.$toast.error(res.data.message);
                    }
                })
                .catch(res => {
                    if (res.response?.data?.errors) {
                        const list = Object.values(res.response.data.errors);
                        list.forEach((v, i) => {
                            this.$toast.error(v[0]);
                        });
                    } else {
                        this.$toast.error(res.response?.data?.message || 'Có lỗi xảy ra');
                    }
                    this.loadData();
                });
        },
    }
}
</script>