# CS434D_N4
#  THỐNG KÊ LỊCH HẸN BÁC SĨ (FE + BE)

---

##  Giới thiệu
- Module thống kê thuộc hệ thống quản lý lịch hẹn bác sĩ  
- Hỗ trợ admin theo dõi dữ liệu khám bệnh  
- Hiển thị dữ liệu dưới dạng bảng và biểu đồ  

---

##  Mục tiêu
- Thống kê số lượng lịch hẹn  
- Phân tích theo:
  - Chuyên khoa  
  - Bác sĩ  
  - Phòng khám  
  - Thời gian  
- Hỗ trợ dashboard quản lý  

---

##  Công nghệ sử dụng

### Backend:
- Laravel (PHP)  
- MySQL  
- Sanctum (Authentication)  

### Frontend:
- Vue 3  
- Axios  
- Chart.js (hiển thị biểu đồ)  

---

##  Chức năng chính

###  Thống kê theo chuyên khoa
- Đếm số lịch hẹn theo từng chuyên khoa  
- Trả về:
  - labels: tên chuyên khoa  
  - values: số lượng lịch  

---

###  Thống kê theo bác sĩ
- Đếm số lịch hẹn của từng bác sĩ  
- Hiển thị biểu đồ cột  

---

###  Thống kê theo phòng khám
- Đếm số bác sĩ hoặc lịch làm việc theo phòng  

---

###  Thống kê bệnh nhân theo bác sĩ
- Số lượng bệnh nhân của từng bác sĩ  
- Danh sách chi tiết bệnh nhân  

---

###  Dashboard tổng quan
- Tổng số lịch hẹn  
- Lịch hẹn trong tháng  
- Lịch hẹn thành công  
- Tỷ lệ thành công (%)  
- Đánh giá trung bình  

---

## 🔗 API Backend

- GET `/api/thong-ke/chuyen-khoa`
- GET `/api/thong-ke/bac-si`
- GET `/api/thong-ke/phong-kham`
- GET `/api/thong-ke/benh-nhan`
- GET `/api/thong-ke/dashboard`

---

## 📁 Cấu trúc

### Backend:
- Controller:
  - ThongKeController.php  
- Model:
  - PhieuDatLich  
  - BacSi  
  - BenhNhan  
  - LichLamViec  

### Frontend:
- components:
  - ChartBar.vue  
  - ChartPie.vue  
- pages:
  - Dashboard.vue  

---

##  Luồng hoạt động

- FE gửi request (Axios) → API  
- BE xử lý query + thống kê  
- BE trả JSON gồm:
  - data  
  - labels  
  - values  
- FE nhận dữ liệu → render biểu đồ  

---

##  Điểm nổi bật
- Có phân quyền bằng Sanctum  
- Dữ liệu chuẩn hóa cho biểu đồ  
- Tách logic FE và BE rõ ràng  
- Có thể mở rộng AI phân tích  

---

##  Hướng phát triển
- Thêm biểu đồ nâng cao (line chart, pie chart)  
- Phân tích xu hướng theo thời gian  
- AI dự đoán số lượng bệnh nhân  
- Gợi ý phân công bác sĩ  
