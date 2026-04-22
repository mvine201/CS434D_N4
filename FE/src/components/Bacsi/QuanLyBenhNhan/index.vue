<script>
import baseRequestBacsi from '../../../core/baseRequestBacsi';

export default {
    data() {
        return {
            list_benh_nhan: [],
            view_benh_nhan: {},
            view_lich_su_kham: {},
            list_lich_su_kham: [],
            tim_kiem: {
                noi_dung_tim: ""
            },
            searchTimeout: null
        }
    },

    mounted() {
        this.loadData();
    },

    methods: {
        getAuth() {
            return {
                headers: {
                    Authorization: "Bearer " + localStorage.getItem("token_bac_si")
                }
            };
        },

        formatDate(date) {
            if (!date) return '-';
            return new Date(date).toLocaleDateString('vi-VN');
        },

        getStatusText(status) {
            return {
                0: "Chờ xác nhận",
                1: "Đã xác nhận",
                2: "Đã hủy",
                3: "Hoàn thành"
            }[status] || "Không rõ";
        },

        getStatusClass(status) {
            return {
                0: "btn-warning",
                1: "btn-info",
                2: "btn-danger",
                3: "btn-success"
            }[status] || "btn-secondary";
        },

        loadData() {
            baseRequestBacsi.get('bac-si/benh-nhan/data', this.getAuth())
                .then(res => {
                    this.list_benh_nhan = res.data.data || [];
                })
                .catch(() => {
                    this.$toast.error("Lỗi tải dữ liệu");
                });
        },

        loadLichSuKham(value) {
            this.view_lich_su_kham = value;

            baseRequestBacsi.post(
                'bac-si/benh-nhan/lich-su-kham',
                { id_benh_nhan: value.id },
                this.getAuth()
            )
            .then(res => {
                this.list_lich_su_kham = res.data.data || [];
            })
            .catch(() => {
                this.$toast.error("Lỗi tải lịch sử");
            });
        },

        // 🔥 debounce search
        timKiem() {
            clearTimeout(this.searchTimeout);

            this.searchTimeout = setTimeout(() => {
                baseRequestBacsi.post(
                    'bac-si/benh-nhan/tim-kiem',
                    this.tim_kiem,
                    this.getAuth()
                )
                .then(res => {
                    if (res.data.status) {
                        this.list_benh_nhan = res.data.data;
                    }
                })
                .catch(() => {
                    this.$toast.error("Lỗi tìm kiếm");
                });
            }, 500);
        }
    }
}
</script>
