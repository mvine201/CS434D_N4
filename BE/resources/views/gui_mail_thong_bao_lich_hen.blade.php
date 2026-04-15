<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Thông báo lịch hẹn khám</title>
  <style>
    /* Một số style cơ bản cho các client hỗ trợ */
    body { margin:0; padding:0; background-color:#f4f6f8; font-family: "Helvetica Neue", Arial, sans-serif; -webkit-font-smoothing:antialiased; }
    .email-container { width:100%; max-width:680px; margin:0 auto; background:#ffffff; border-radius:8px; overflow:hidden; box-shadow:0 6px 20px rgba(16,24,40,0.08); }
    .hero { padding:28px 32px; text-align:left; background: linear-gradient(90deg,#2867ff 0%,#00b4ff 100%); color:#fff; }
    .hero h1 { margin:0; font-size:22px; line-height:1.2; }
    .hero p { margin:6px 0 0; opacity:0.95; font-size:14px; }
    .content { padding:28px 32px; color:#0f172a; }
    .card { background:#f8fafc; border-radius:8px; padding:18px; margin:14px 0; }
    .label { font-size:13px; color:#6b7280; margin-bottom:6px; display:block; }
    .value { font-size:16px; font-weight:600; color:#0f172a; }
    .btn { display:inline-block; padding:12px 18px; border-radius:8px; text-decoration:none; background:#0b61ff; color:#fff; font-weight:600; margin-top:12px; }
    .muted { color:#6b7280; font-size:13px; margin-top:16px; }
    .footer { padding:18px 32px; font-size:13px; color:#94a3b8; text-align:center; background:#fbfdff; }
    @media screen and (max-width:480px){ .hero{padding:20px} .content{padding:20px} }
  </style>
</head>
<body>
  <!-- preheader text: some email clients show this next to subject -->
  <div style="display:none; max-height:0; overflow:hidden; font-size:1px; color:#fff; line-height:1px; opacity:0;">
    Thông báo lịch hẹn khám — Xin chào {{ $data['ho_ten'] }}. Vui lòng kiểm tra thông tin lịch hẹn của bạn.
  </div>

  <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="background-color:#f4f6f8; padding:28px 16px;">
    <tr>
      <td align="center">
        <table role="presentation" class="email-container" width="100%" cellpadding="0" cellspacing="0" style="max-width:680px;">
          <tr>
            <td class="hero" style="background:linear-gradient(90deg,#2867ff 0%,#00b4ff 100%); color:#fff; padding:28px 32px;">
              <h1>Thông báo lịch hẹn khám</h1>
              <p>Chúng tôi đã ghi nhận lịch hẹn của bạn. Vui lòng đến đúng giờ để được phục vụ tốt nhất.</p>
            </td>
          </tr>

          <tr>
            <td class="content" style="padding:28px 32px; color:#0f172a;">
              <p>Xin chào <strong>{{ $data['ho_ten'] }}</strong>,</p>

              <div class="card" style="background:#f8fafc; border-radius:8px; padding:18px; margin:14px 0;">
                <div>
                  <span class="label">Ngày hẹn</span>
                  <div class="value">{{ $data['ngay_dat_hen'] }}</div>
                </div>

                <div style="margin-top:12px;">
                  <span class="label">Lý do khám</span>
                  <div class="value" style="font-weight:500;">{{ $data['ly_do_kham'] }}</div>
                </div>
              </div>

              <p style="margin:0;">Vui lòng chuẩn bị giấy tờ tùy thân (CMND/CCCD/hộ chiếu) và đến sớm 10–15 phút để hoàn tất thủ tục. Nếu bạn cần thay đổi hoặc huỷ lịch hẹn, vui lòng liên hệ phòng khám.</p>

              <!-- Button — nếu bạn có link chi tiết, thay thế # bằng biến link -->
              <a href="#" class="btn" style="display:inline-block; padding:12px 18px; border-radius:8px; background:#0b61ff; color:#fff; text-decoration:none; font-weight:600;">
                Xem chi tiết lịch hẹn
              </a>

              <p class="muted" style="color:#6b7280; font-size:13px;">Nếu bạn không thực hiện đặt hẹn này, xin vui lòng bỏ qua email hoặc liên hệ ngay với chúng tôi.</p>
            </td>
          </tr>

          <tr>
            <td class="footer" style="padding:18px 32px; font-size:13px; color:#94a3b8; text-align:center; background:#fbfdff;">
              <div style="margin-bottom:6px;">Phòng khám ABC • Địa chỉ: Số 123 Đường XYZ, Quận A, Thành phố B</div>
              <div>Hotline: <strong>0123-456-789</strong> — Email: <a href="mailto:contact@phongkhamabc.vn" style="color:#0b61ff; text-decoration:none;">contact@phongkhamabc.vn</a></div>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>
