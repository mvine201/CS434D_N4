import { createRouter, createWebHistory } from "vue-router"; // cài vue-router: npm install vue-router@next --save
import checkAdmin from "./checkAdmin";
import checkBacSi from "./checkBacSi";
import checkBenhNhan from "./checkBenhNhan";
const routes = [
  //Client
  {
    path: "/",
    component: () => import("../components/Client/TrangChu/index.vue"),
    meta: {
      layout: "client",
    },
  },
  {
    path: "/login",
    component: () => import("../components/Client/login/index.vue"),
    meta: {
      layout: "client",
    },
  },
  {
    path: "/dang-ky",
    component: () => import("../components/Client/dangKy/index.vue"),
    meta: {
      layout: "client",
    },
  },
  {
    path: "/profile",
    component: () => import("../components/Client/Profile/index.vue"),
    meta: {
      layout: "client",
    },
  },
  {
    path: "/gioi-thieu",
    component: () => import("../components/Client/GioiThieu/index.vue"),
    meta: {
      layout: "client",
    },
  },
  {
    path: "/chinh-sach",
    component: () => import("../components/Client/ChinhSach/index.vue"),
    meta: {
      layout: "client",
    },
  },
  {
    path: "/lien-he",
    component: () => import("../components/Client/LienHe/index.vue"),
    meta: {
      layout: "client",
    },
  },
  {
    path: "/bac-si",
    component: () => import("../components/Client/BacSi/index.vue"),
    meta: {
      layout: "client",
    },
  },
  {
    path: "/bac-si/chi-tiet/:id",
    component: () => import("../components/Client/DetailBacSi/index.vue"),
    meta: {
      layout: "client",
    },
  },
  {
    path: "/tin-tuc",
    component: () => import("../components/Client/TinTuc/index.vue"),
    meta: {
      layout: "client",
    },
  },
  {
    path: "/dat-kham",
    component: () => import("../components/Client/DatKham/index.vue"),
    meta: {
      layout: "client",
    },
  },
  {
    path: "/chuyen-khoa",
    component: () => import("../components/Client/ChuyenKhoa/index.vue"),
    meta: {
      layout: "client",
    },
  },
  {
    path: "/chuyen-khoa/chi-tiet/:id",
    component: () => import("../components/Client/DetailChuyenKhoa/index.vue"),
    meta: {
      layout: "client",
    },
  },
  {
    path: "/kich-hoat/:ma_code",
    component: () => import("../components/Client/KichHoat/index.vue"),
    meta: {
      layout: "blank",
    },
    props: true,
  },
  {
    path: "/doi-mat-khau/:id_benh_nhan",
    component: () => import("../components/Client/LayLaiMatKhau/index.vue"),
    meta: {
      layout: "blank",
    },
    props: true,
  },
  {
    path: "/quen-mat-khau",
    component: () => import("../components/Client/QuenMatKhau/index.vue"),
    meta: {
      layout: "blank",
    },
  },
  {
    path: "/lich-hen-cua-toi",
    component: () => import("../components/Client/LichHen/index.vue"),
    meta: {
      layout: "client",
    },
  },
  //Admin
  {
    path: "/admin/login",
    component: () => import("../components/Admin/login/index.vue"),
    meta: {
      layout: "blank",
    },
  },
  {
    path: "/admin/dashboard",
    component: () => import("../components/Admin/dashboard/index.vue"),
    meta: {
      layout: "admin",
    },
    beforeEnter: checkAdmin,
  },
  {
    path: "/admin/profile",
    component: () => import("../components/Admin/Profile/index.vue"),
    meta: {
      layout: "admin",
    },
    beforeEnter: checkAdmin,
  },
  {
    path: "/admin/bac-si",
    component: () => import("../components/Admin/bacsi/index.vue"),
    meta: {
      layout: "admin",
    },
    beforeEnter: checkAdmin,
  },
  {
    path: "/admin/benh-nhan",
    component: () => import("../components/Admin/benhnhan/index.vue"),
    meta: {
      layout: "admin",
    },
    beforeEnter: checkAdmin,
  },
  {
    path: "/admin/ho-so-benh-an",
    component: () => import("../components/Admin/benhnhan/hosobenhnhan.vue"),
    meta: {
      layout: "admin",
    },
    beforeEnter: checkAdmin,
  },
  {
    path: "/admin/chuyen-khoa",
    component: () => import("../components/Admin/chuyenkhoa/index.vue"),
    meta: {
      layout: "admin",
    },
    beforeEnter: checkAdmin,
  },
  {
    path: "/admin/phong-kham",
    component: () => import("../components/Admin/phongkham/index.vue"),
    meta: {
      layout: "admin",
    },
    beforeEnter: checkAdmin,
  },
  {
    path: "/admin/nhan-vien",
    component: () => import("../components/Admin/nhanvien/index.vue"),
    meta: {
      layout: "admin",
    },
    beforeEnter: checkAdmin,
  },
  {
    path: "/admin/phan-quyen",
    component: () => import("../components/Admin/phanquyen/index.vue"),
    meta: {
      layout: "admin",
    },
    beforeEnter: checkAdmin,
  },
  {
    path: "/admin/kiem-tra-phieu-dat-lich",
    component: () =>
      import("../components/Admin/KiemTraPhieuDatLich/index.vue"),
    meta: {
      layout: "admin",
    },
    beforeEnter: checkAdmin,
  },
  {
    path: "/admin/thong-ke/lich-hen-chuyen-khoa",
    component: () =>
      import("../components/Admin/thongke/lichhenchuyenkhoa.vue"),
    meta: {
      layout: "admin",
    },
    beforeEnter: checkAdmin,
  },
  {
    path: "/admin/thong-ke/lich-hen-bac-si",
    component: () => import("../components/Admin/thongke/lichhenbacsi.vue"),
    meta: {
      layout: "admin",
    },
    beforeEnter: checkAdmin,
  },
  {
    path: "/admin/thong-ke/bac-si-theo-phong-kham",
    component: () =>
      import("../components/Admin/thongke/thongkebacsitheophongkham.vue"),
    meta: {
      layout: "admin",
    },
    beforeEnter: checkAdmin,
  },
  {
    path: "/admin/thong-ke/lich-lam-viec-theo-phong-kham",
    component: () =>
      import("../components/Admin/thongke/thongkelichlamviectheophongkam.vue"),
    meta: {
      layout: "admin",
    },
    beforeEnter: checkAdmin,
  },
  {
    path: "/admin/thong-ke/benh-nhan-theo-bac-si",
    component: () =>
      import("../components/Admin/thongke/thongkebenhnhantheobacsi.vue"),
    meta: {
      layout: "admin",
    },
    beforeEnter: checkAdmin,
  },
  {
    path: "/admin/slide",
    component: () => import("../components/Admin/slide/index.vue"),
    meta: {
      layout: "admin",
    },
    beforeEnter: checkAdmin,
  },
  {
    path: "/admin/bac-si/lich-lam-viec",
    component: () => import("../components/Admin/BacSi/lichlamviec.vue"),
    meta: {
      layout: "admin",
    },
    beforeEnter: checkAdmin,
  },
  {
    path: "/admin/nhan-vien",
    component: () => import("../components/Admin/nhanvien/index.vue"),
    meta: {
      layout: "admin",
    },
    beforeEnter: checkAdmin,
  },
  {
    path: "/admin/phan-quyen",
    component: () => import("../components/Admin/phanquyen/index.vue"),
    meta: {
      layout: "admin",
    },
    beforeEnter: checkAdmin,
  },
  {
    path: "/admin/thong-ke",
    component: () =>
      import("../components/Admin/thongke/lichhenchuyenkhoa.vue"),
    meta: {
      layout: "admin",
    },
    beforeEnter: checkAdmin,
  },
  {
    path: "/admin/slide",
    component: () => import("../components/Admin/slide/index.vue"),
    meta: {
      layout: "admin",
    },
  },
  {
    path: "/admin/lich-hen",
    component: () => import("../components/Admin/lichhen/index.vue"),
    meta: {
      layout: "admin",
    },
    beforeEnter: checkAdmin,
  },
  {
    path: "/admin/bill/:id",
    component: () => import("../components/Admin/Bill/index.vue"),
    meta: {
      layout: "blank",
    },
    props: true,
    beforeEnter: checkAdmin,
  },
  {
    path: "/admin/hoa-don",
    component: () => import("../components/Admin/HoaDon/index.vue"),
    meta: {
      layout: "admin",
    },
    beforeEnter: checkAdmin,
  },

  //Bác Sĩ
  {
    path: "/bac-si/login",
    component: () => import("../components/BacSi/login/index.vue"),
    meta: {
      layout: "blank",
    },
  },
  {
    path: "/bac-si/dang-ky",
    component: () => import("../components/Bacsi/DangKy/index.vue"),
    meta: { layout: "blank" },
  },
  {
    path: "/bac-si/kich-hoat/:ma_code",
    component: () => import("../components/Bacsi/KichHoat/index.vue"),
    meta: {
      layout: "blank",
    },
    props: true,
  },
  {
    path: "/bac-si/profile",
    component: () => import("../components/BacSi/Profile/index.vue"),
    meta: { layout: "bac-si" },
    beforeEnter: checkBacSi,
  },
  {
    path: "/bac-si/lich-hen",
    component: () => import("../components/BacSi/LichHen/index.vue"),
    meta: { layout: "bac-si" },
    beforeEnter: checkBacSi,
  },
  {
    path: "/bac-si/lich-ca-nhan",
    component: () => import("../components/Bacsi/LichCaNhan/index.vue"),
    meta: { layout: "bac-si" },
    beforeEnter: checkBacSi,
  },
  {
    path: "/bac-si/quan-ly-benh-nhan",
    component: () => import("../components/BacSi/QuanLyBenhNhan/index.vue"),
    meta: { layout: "bac-si" },
    beforeEnter: checkBacSi,
  },
  {
    path: "/bac-si/quen-mat-khau",
    component: () => import("../components/BacSi/QuenMatKhau/index.vue"),
    meta: { layout: "blank" },
  },
  {
    path: "/bac-si/doi-mat-khau/:id_bac_si",
    component: () => import("../components/BacSi/LayLaiMatKhau/index.vue"),
    meta: { layout: "blank" },
    props: true,
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes: routes,
});

export default router;
