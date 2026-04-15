<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông báo thanh toán lịch hẹn</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            background-color: #f5f7fa;
            color: #333;
        }

        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px 20px;
            text-align: center;
        }

        .header h1 {
            font-size: 24px;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .header p {
            font-size: 14px;
            opacity: 0.9;
        }

        .success-icon {
            background-color: #10b981;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 20px auto;
            font-size: 28px;
        }

        .content {
            padding: 30px;
        }

        .greeting {
            font-size: 18px;
            margin-bottom: 20px;
            color: #2d3748;
        }

        .message {
            background-color: #f8fafc;
            border-left: 4px solid #10b981;
            padding: 20px;
            margin: 20px 0;
            border-radius: 0 8px 8px 0;
        }

        .payment-details {
            background-color: #fff;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            padding: 25px;
            margin: 25px 0;
        }

        .payment-details h3 {
            color: #2d3748;
            margin-bottom: 20px;
            font-size: 18px;
            border-bottom: 2px solid #edf2f7;
            padding-bottom: 10px;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #f7fafc;
        }

        .detail-row:last-child {
            border-bottom: none;
            font-weight: 600;
            font-size: 16px;
            color: #10b981;
            background-color: #f0fff4;
            padding: 15px;
            border-radius: 6px;
            margin-top: 10px;
        }

        .label {
            color: #4a5568;
            font-weight: 500;
        }

        .value {
            font-weight: 600;
            color: #2d3748;
        }

        .amount {
            font-size: 18px;
            color: #10b981;
        }

        .next-steps {
            background-color: #edf2f7;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }

        .next-steps h4 {
            color: #2d3748;
            margin-bottom: 15px;
            font-size: 16px;
        }

        .steps-list {
            list-style: none;
            counter-reset: step-counter;
        }

        .steps-list li {
            counter-increment: step-counter;
            margin: 10px 0;
            padding-left: 35px;
            position: relative;
            color: #4a5568;
        }

        .steps-list li::before {
            content: counter(step-counter);
            position: absolute;
            left: 0;
            top: 0;
            background-color: #667eea;
            color: white;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: bold;
        }

        .support {
            text-align: center;
            margin: 25px 0;
            padding: 20px;
            background-color: #fffbeb;
            border-radius: 8px;
            border: 1px solid #fed7aa;
        }

        .support h4 {
            color: #92400e;
            margin-bottom: 10px;
        }

        .support p {
            color: #b45309;
            margin: 5px 0;
        }

        .footer {
            background-color: #2d3748;
            color: white;
            text-align: center;
            padding: 25px;
        }

        .footer p {
            margin: 8px 0;
            opacity: 0.8;
        }

        .footer .company-name {
            font-weight: 600;
            font-size: 16px;
            opacity: 1;
        }

        @media (max-width: 600px) {
            .email-container {
                margin: 0;
                border-radius: 0;
            }

            .content {
                padding: 20px;
            }

            .payment-details {
                padding: 20px;
            }

            .detail-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 5px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="header">
            <h1>🏥 Phòng khám ABC</h1>
            <p>Hệ thống quản lý lịch hẹn trực tuyến</p>
        </div>

        <!-- Success Icon -->
        <div class="success-icon">
            ✓
        </div>

        <!-- Main Content -->
        <div class="content">
            <div class="greeting">
                Kính chào <strong>{{ $ho_ten }}</strong>,
            </div>

            <div class="message">
                <p>Chúng tôi xác nhận rằng thanh toán cho lịch hẹn khám bệnh của bạn đã được <strong>xử lý thành công</strong>.</p>
            </div>

            <!-- Payment Details -->
            <div class="payment-details">
                <h3>📋 Chi tiết thanh toán</h3>

                <div class="detail-row">
                    <span class="label">👤 Họ và tên:</span>
                    <span class="value">{{ $ho_ten }}</span>
                </div>

                <div class="detail-row">
                    <span class="label">🩺 Lý do khám:</span>
                    <span class="value">{{ $ly_do_kham }}</span>
                </div>

                <div class="detail-row">
                    <span class="label">📅 Ngày thanh toán:</span>
                    <span class="value">{{ date('d/m/Y H:i', strtotime(now())) }}</span>
                </div>

                <div class="detail-row">
                    <span class="label">💰 Tổng số tiền:</span>
                    <span class="amount">{{ number_format($so_tien, 0, ',', '.') }} VNĐ</span>
                </div>
            </div>

            <!-- Next Steps -->
            <div class="next-steps">
                <h4>📝 Các bước tiếp theo:</h4>
                <ol class="steps-list">
                    <li>Bạn sẽ nhận được SMS xác nhận trong vòng 5 phút</li>
                    <li>Vui lòng có mặt tại phòng khám trước 15 phút so với giờ hẹn</li>
                    <li>Mang theo giấy tờ tùy thân và thông tin bảo hiểm (nếu có)</li>
                    <li>Liên hệ hotline nếu cần thay đổi lịch hẹn</li>
                </ol>
            </div>

            <div style="text-align: center; margin: 25px 0;">
                <p style="color: #10b981; font-weight: 600; font-size: 16px;">
                    ✨ Cảm ơn bạn đã tin tương và sử dụng dịch vụ của chúng tôi!
                </p>
            </div>
        </div>

        <!-- Support Section -->
        <div class="support">
            <h4>📞 Cần hỗ trợ?</h4>
            <p><strong>Hotline:</strong> 1900-xxxx</p>
            <p><strong>Email:</strong> support@phongkhamabc.com</p>
            <p><strong>Giờ làm việc:</strong> 8:00 - 17:00 (T2-T6)</p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p class="company-name">Phòng khám ABC</p>
            <p>📍 123 Đường ABC, Quận XYZ, TP. Hồ Chí Minh</p>
            <p>☎️ 028-xxxx-xxxx | 🌐 www.phongkhamabc.com</p>
            <p style="font-size: 12px; margin-top: 15px;">
                Email này được gửi tự động, vui lòng không trả lời trực tiếp.
            </p>
        </div>
    </div>
</body>
</html>
