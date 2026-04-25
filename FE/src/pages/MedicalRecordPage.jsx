import { useEffect, useState } from "react";

export default function MedicalRecordPage() {
  // Danh sách hồ sơ bệnh án (tạm dữ liệu cứng, sau này gọi API)
  const [danhSachHoSo, setDanhSachHoSo] = useState([
    {
      ma_benh_an: "BA01",
      benh_nhan: "Nguyễn A",
      ngay_kham: "2026-04-10",
      bac_si: "Hồ Duy Công",
      trang_thai: "Đã khám",
      trieu_chung: "Đau đầu, chóng mặt",
      chan_doan: "Thiếu ngủ",
      ket_luan: "Nghỉ ngơi",
      don_thuoc: "Vitamin B",
      ghi_chu: "Tái khám sau 1 tuần",
      gioi_tinh: "Nam",
      tuoi: 25,
    },
    {
      ma_benh_an: "BA02",
      benh_nhan: "Trần B",
      ngay_kham: "2026-04-11",
      bac_si: "Hồ Duy Công",
      trang_thai: "Chờ khám",
      trieu_chung: "",
      chan_doan: "",
      ket_luan: "",
      don_thuoc: "",
      ghi_chu: "",
      gioi_tinh: "Nữ",
      tuoi: 22,
    },
  ]);

  // Tìm kiếm
  const [tuKhoa, setTuKhoa] = useState("");

  // Form chi tiết
  const [hoSoDangChon, setHoSoDangChon] = useState(null);

  // Trạng thái: đang tạo mới hay sửa
  const [dangTaoMoi, setDangTaoMoi] = useState(false);

  // Khi mở trang -> chọn hồ sơ đầu tiên
  useEffect(() => {
    if (danhSachHoSo.length > 0) {
      setHoSoDangChon(danhSachHoSo[0]);
    }
  }, []);

  // Hàm chọn hồ sơ từ bảng
  const chonHoSo = (hs) => {
    setHoSoDangChon({ ...hs });
    setDangTaoMoi(false);
  };

  // Hàm thay đổi input
  const thayDoiForm = (field, value) => {
    setHoSoDangChon((prev) => ({
      ...prev,
      [field]: value,
    }));
  };

  // Tạo mới
  const taoMoi = () => {
    setDangTaoMoi(true);
    setHoSoDangChon({
      ma_benh_an: "",
      benh_nhan: "",
      ngay_kham: "",
      bac_si: "Hồ Duy Công",
      trang_thai: "Chờ khám",
      trieu_chung: "",
      chan_doan: "",
      ket_luan: "",
      don_thuoc: "",
      ghi_chu: "",
      gioi_tinh: "",
      tuoi: "",
    });
  };

  // Lưu (thêm mới)
  const luuHoSo = () => {
    if (!hoSoDangChon.ma_benh_an || !hoSoDangChon.benh_nhan) {
      alert("Vui lòng nhập mã bệnh án và tên bệnh nhân!");
      return;
    }

    // Check trùng mã
    const tonTai = danhSachHoSo.find(
      (hs) => hs.ma_benh_an === hoSoDangChon.ma_benh_an
    );

    if (tonTai) {
      alert("Mã bệnh án đã tồn tại!");
      return;
    }

    setDanhSachHoSo((prev) => [...prev, hoSoDangChon]);
    setDangTaoMoi(false);
    alert("Thêm hồ sơ thành công!");
  };

  // Cập nhật
  const capNhatHoSo = () => {
    if (!hoSoDangChon) return;

    setDanhSachHoSo((prev) =>
      prev.map((hs) =>
        hs.ma_benh_an === hoSoDangChon.ma_benh_an ? hoSoDangChon : hs
      )
    );

    alert("Cập nhật thành công!");
  };

  // Hủy
  const huy = () => {
    setDangTaoMoi(false);

    if (danhSachHoSo.length > 0) {
      setHoSoDangChon(danhSachHoSo[0]);
    } else {
      setHoSoDangChon(null);
    }
  };

  const danhSachLoc = danhSachHoSo.filter(
    (hs) =>
      hs.ma_benh_an.toLowerCase().includes(tuKhoa.toLowerCase()) ||
      hs.benh_nhan.toLowerCase().includes(tuKhoa.toLowerCase())
  );

  return (
    <div className="min-h-screen bg-gray-100 flex">
      {/* Sidebar */}
      <aside className="w-60 bg-white shadow-md">
        <div className="p-4 text-xl font-bold border-b">ClinicX</div>

        <nav className="p-3 space-y-2">
          {[
            "Dashboard",
            "Bệnh nhân",
            "Lịch khám",
            "Hồ sơ bệnh án",
            "Thuốc",
            "Đăng xuất",
          ].map((item) => (
            <button
              key={item}
              className={`w-full text-left px-4 py-2 rounded-lg hover:bg-blue-100 ${
                item === "Hồ sơ bệnh án" ? "bg-blue-200 font-semibold" : ""
              }`}
            >
              {item}
            </button>
          ))}
        </nav>
      </aside>

      {/* Main */}
      <main className="flex-1 p-6">
        {/* Header */}
        <div className="bg-white shadow rounded-xl p-4 flex justify-between items-center">
          <h1 className="text-lg font-bold">
            ClinicX - QUẢN LÝ HỒ SƠ BỆNH ÁN
          </h1>

          <div className="text-sm font-medium">
            Bác sĩ: <span className="font-bold">Hồ Duy Công</span>
          </div>
        </div>

        {/* Search */}
        <div className="mt-4 bg-white shadow rounded-xl p-4 flex items-center gap-3">
          <span className="text-lg">🔍</span>

          <input
            type="text"
            placeholder="Tìm theo tên bệnh nhân / mã bệnh án..."
            value={tuKhoa}
            onChange={(e) => setTuKhoa(e.target.value)}
            className="flex-1 border rounded-lg px-3 py-2 outline-none focus:ring focus:ring-blue-200"
          />
        </div>

        {/* Table list */}
        <div className="mt-4 bg-white shadow rounded-xl p-4">
          <h2 className="font-bold text-lg mb-3">DANH SÁCH HỒ SƠ BỆNH ÁN</h2>

          <table className="w-full border border-gray-300 text-sm">
            <thead className="bg-gray-200">
              <tr>
                <th className="border px-2 py-2">Mã BA</th>
                <th className="border px-2 py-2">Bệnh nhân</th>
                <th className="border px-2 py-2">Ngày khám</th>
                <th className="border px-2 py-2">Bác sĩ</th>
                <th className="border px-2 py-2">Trạng thái</th>
                <th className="border px-2 py-2">Xem</th>
              </tr>
            </thead>

            <tbody>
              {danhSachLoc.map((hs) => (
                <tr
                  key={hs.ma_benh_an}
                  className="text-center hover:bg-blue-50"
                >
                  <td className="border px-2 py-2">{hs.ma_benh_an}</td>
                  <td className="border px-2 py-2">{hs.benh_nhan}</td>
                  <td className="border px-2 py-2">{hs.ngay_kham}</td>
                  <td className="border px-2 py-2">{hs.bac_si}</td>
                  <td className="border px-2 py-2">{hs.trang_thai}</td>
                  <td className="border px-2 py-2">
                    <button
                      onClick={() => chonHoSo(hs)}
                      className="px-3 py-1 bg-blue-600 text-white rounded-lg hover:bg-blue-700"
                    >
                      Xem
                    </button>
                  </td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>

        {/* Detail */}
        <div className="mt-4 bg-white shadow rounded-xl p-4">
          <h2 className="font-bold text-lg mb-3">CHI TIẾT HỒ SƠ BỆNH ÁN</h2>

          {!hoSoDangChon ? (
            <p>Chưa có hồ sơ nào.</p>
          ) : (
            <>
              <div className="grid grid-cols-2 gap-4 text-sm">
                <div>
                  <label className="font-semibold">Mã bệnh án:</label>
                  <input
                    className="w-full border rounded-lg px-3 py-2 mt-1"
                    value={hoSoDangChon.ma_benh_an}
                    onChange={(e) =>
                      thayDoiForm("ma_benh_an", e.target.value)
                    }
                    disabled={!dangTaoMoi}
                  />
                </div>

                <div>
                  <label className="font-semibold">Ngày khám:</label>
                  <input
                    type="date"
                    className="w-full border rounded-lg px-3 py-2 mt-1"
                    value={hoSoDangChon.ngay_kham}
                    onChange={(e) => thayDoiForm("ngay_kham", e.target.value)}
                  />
                </div>

                <div>
                  <label className="font-semibold">Bệnh nhân:</label>
                  <input
                    className="w-full border rounded-lg px-3 py-2 mt-1"
                    value={hoSoDangChon.benh_nhan}
                    onChange={(e) =>
                      thayDoiForm("benh_nhan", e.target.value)
                    }
                  />
                </div>

                <div className="grid grid-cols-2 gap-3">
                  <div>
                    <label className="font-semibold">Giới tính:</label>
                    <select
                      className="w-full border rounded-lg px-3 py-2 mt-1"
                      value={hoSoDangChon.gioi_tinh}
                      onChange={(e) =>
                        thayDoiForm("gioi_tinh", e.target.value)
                      }
                    >
                      <option value="">-- Chọn --</option>
                      <option value="Nam">Nam</option>
                      <option value="Nữ">Nữ</option>
                      <option value="Khác">Khác</option>
                    </select>
                  </div>

                  <div>
                    <label className="font-semibold">Tuổi:</label>
                    <input
                      type="number"
                      className="w-full border rounded-lg px-3 py-2 mt-1"
                      value={hoSoDangChon.tuoi}
                      onChange={(e) => thayDoiForm("tuoi", e.target.value)}
                    />
                  </div>
                </div>
              </div>

              <div className="mt-4 space-y-3 text-sm">
                <div>
                  <label className="font-semibold">Triệu chứng:</label>
                  <textarea
                    rows={2}
                    className="w-full border rounded-lg px-3 py-2 mt-1"
                    value={hoSoDangChon.trieu_chung}
                    onChange={(e) =>
                      thayDoiForm("trieu_chung", e.target.value)
                    }
                  />
                </div>

                <div>
                  <label className="font-semibold">Chẩn đoán:</label>
                  <textarea
                    rows={2}
                    className="w-full border rounded-lg px-3 py-2 mt-1"
                    value={hoSoDangChon.chan_doan}
                    onChange={(e) =>
                      thayDoiForm("chan_doan", e.target.value)
                    }
                  />
                </div>

                <div>
                  <label className="font-semibold">Kết luận:</label>
                  <textarea
                    rows={2}
                    className="w-full border rounded-lg px-3 py-2 mt-1"
                    value={hoSoDangChon.ket_luan}
                    onChange={(e) =>
                      thayDoiForm("ket_luan", e.target.value)
                    }
                  />
                </div>

                <div>
                  <label className="font-semibold">Đơn thuốc:</label>
                  <textarea
                    rows={2}
                    className="w-full border rounded-lg px-3 py-2 mt-1"
                    value={hoSoDangChon.don_thuoc}
                    onChange={(e) =>
                      thayDoiForm("don_thuoc", e.target.value)
                    }
                  />
                </div>

                <div>
                  <label className="font-semibold">Ghi chú:</label>
                  <textarea
                    rows={2}
                    className="w-full border rounded-lg px-3 py-2 mt-1"
                    value={hoSoDangChon.ghi_chu}
                    onChange={(e) => thayDoiForm("ghi_chu", e.target.value)}
                  />
                </div>
              </div>

              {/* Buttons */}
              <div className="mt-4 flex gap-3">
                <button
                  onClick={taoMoi}
                  className="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700"
                >
                  TẠO MỚI
                </button>

                <button
                  onClick={luuHoSo}
                  disabled={!dangTaoMoi}
                  className={`px-4 py-2 rounded-lg text-white ${
                    dangTaoMoi
                      ? "bg-blue-600 hover:bg-blue-700"
                      : "bg-gray-400 cursor-not-allowed"
                  }`}
                >
                  LƯU
                </button>

                <button
                  onClick={capNhatHoSo}
                  disabled={dangTaoMoi}
                  className={`px-4 py-2 rounded-lg text-white ${
                    !dangTaoMoi
                      ? "bg-yellow-500 hover:bg-yellow-600"
                      : "bg-gray-400 cursor-not-allowed"
                  }`}
                >
                  CẬP NHẬT
                </button>

                <button
                  onClick={huy}
                  className="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700"
                >
                  HỦY
                </button>
              </div>
            </>
          )}
        </div>
      </main>
    </div>
  );
}