<template>
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Quản Lý Hóa Đơn</h4>
				</div>
				<div class="card-body">
					<table class="table table-bordered table-striped mb-0">
						<thead>
							<tr class="text-center align-middle text-nowrap text-light bg-primary">
								<th>#</th>
								<th>Mã Phiếu Đặt Lịch</th>
								<th>Khách Hàng</th>
								<th>Số Điện Thoại</th>
								<th>Tên Bác Sĩ</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="(item, index) in list_hoa_don" :key="item.ma_dat_lich"
								class="align-middle text-nowrap">
								<th class="text-center">{{ index + 1 }}</th>
								<td>{{ item.ma_dat_lich }}</td>
								<td>{{ item.ho_ten }}</td>
								<td>{{ item.so_dien_thoai }}</td>
								<td>{{ item.ten_bac_si }}</td>
								<td class="text-center">
									<button class="btn btn-primary shadow btn-xs sharp me-1" data-bs-toggle="modal"
										data-bs-target="#chiTietHoaDon" @click="chonHoaDon(item)"><i
											class="fas fa-eye me-0"></i></button>
									<a target="_blank" :href="`/admin/bill/` + item.id"
										class="btn btn-success shadow btn-xs sharp me-1"><i
											class="fa-solid fa-print me-0"></i></a>
								</td>
							</tr>
							<tr v-if="!loading && list_hoa_don.length === 0">
								<td colspan="7" class="text-center">Không có dữ liệu</td>
							</tr>
						</tbody>
					</table>
					<div v-if="loading" class="text-center py-3">
						<div class="spinner-border text-primary"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Modal Chi Tiết Hóa Đơn -->
	<div class="modal fade" id="chiTietHoaDon" tabindex="-1" aria-labelledby="chiTietHoaDonLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header bg-primary ">
					<h1 class="modal-title fs-5 text-white" id="chiTietHoaDonLabel">Chi Tiết Hóa Đơn</h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body ">
					<div class="container-fluid">
						<div class="row gy-4">
							<div class="col-12">
								<div
									class="d-flex justify-content-between align-items-center border rounded p-3 bg-light">
									<div>
										<div class="fw-semibold text-secondary">Mã Phiếu Đặt Lịch</div>
										<div class="fs-6">{{ hoa_don_selected.ma_dat_lich || '-' }}</div>
									</div>
									<div class="text-end">
										<div class="fw-semibold text-secondary">Tổng Tiền</div>
										<div class="fs-4 fw-bold text-danger">{{
											formatCurrency(hoa_don_selected.tong_tien) }}</div>
									</div>
								</div>
							</div>

							<div class="col-lg-6">
								<div class="card border-0 shadow-sm h-100">
									<div class="card-header bg-white">
										<div class="fw-bold">Thông tin khám</div>
									</div>
									<div class="card-body">
										<ul class="list-group list-group-flush">
											<li
												class="list-group-item d-flex justify-content-between align-items-center px-0">
												<span class="text-secondary">Tên Bác Sĩ</span>
												<span class="fw-semibold">{{ hoa_don_selected.ten_bac_si || '-'
												}}</span>
											</li>
											<li
												class="list-group-item d-flex justify-content-between align-items-center px-0">
												<span class="text-secondary">Khung Giờ</span>
												<span class="fw-semibold">{{ hoa_don_selected.thoi_gian_bat_dau }} - {{
													hoa_don_selected.thoi_gian_ket_thuc }}</span>
											</li>
											<li
												class="list-group-item d-flex justify-content-between align-items-center px-0">
												<span class="text-secondary">Đơn Giá Khám</span>
												<span class="fw-semibold">{{
													formatCurrency(hoa_don_selected.don_gia_kham) }}</span>
											</li>
										</ul>
									</div>
								</div>
							</div>

							<div class="col-lg-6">
								<div class="card border-0 shadow-sm h-100">
									<div class="card-header bg-white">
										<div class="fw-bold">Kết quả & ghi chú</div>
									</div>
									<div class="card-body">
										<div class="mb-3">
											<div class="fw-semibold text-secondary mb-1">Chuẩn Đoán</div>
											<div class="border rounded p-2 bg-light">{{ hoa_don_selected.chuan_doan ||
												'-' }}</div>
										</div>
										<div class="mb-3">
											<div class="fw-semibold text-secondary mb-1">Đơn Thuốc</div>
											<div class="border rounded p-2 bg-light">{{ hoa_don_selected.don_thuoc ||
												'-' }}</div>
										</div>
										<div>
											<div class="fw-semibold text-secondary mb-1">Ghi Chú</div>
											<div class="border rounded p-2 bg-light">{{ hoa_don_selected.ghi_chu || '-'
											}}</div>
										</div>
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
			list_hoa_don: [],
			loading: false,
			hoa_don_selected: {},
		}
	},
	mounted() {
		this.loadData();
	},
	methods: {
		loadData() {
			this.loading = true;
			baseRequestAdmin.get('admin/hoa-don/data')
				.then((res) => {
					if (res.data.status) {
						this.list_hoa_don = res.data.data || [];
					} else {
						this.$toast && this.$toast.error(res.data.message);
					}
				})
				.catch(() => {
					this.$toast && this.$toast.error(res.data.message);
				})
				.finally(() => {
					this.loading = false;
				});
		},
		chonHoaDon(item) {
			this.hoa_don_selected = { ...item };
		},
		inHoaDon() {
			this.$router.push(`/admin/bill`);
		},
		formatCurrency(value) {
			if (value === null || value === undefined || value === '') return '-';
			try {
				return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(Number(value));
			} catch (e) {
				return value;
			}
		}
	}
}
</script>
<style></style>