<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán thành công</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f8f9fa;
        }

        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
        }

        .header h1 {
            font-size: 28px;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .success-icon {
            width: 80px;
            height: 80px;
            background-color: #28a745;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            font-size: 40px;
        }

        .content {
            padding: 40px 30px;
        }

        .greeting {
            font-size: 18px;
            margin-bottom: 30px;
            color: #2c3e50;
        }

        .info-card {
            background-color: #f8f9ff;
            border: 2px solid #e3e8ff;
            border-radius: 10px;
            padding: 25px;
            margin: 25px 0;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #e9ecef;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            font-weight: 600;
            color: #495057;
            font-size: 14px;
        }

        .info-value {
            font-weight: 500;
            color: #2c3e50;
            text-align: right;
            max-width: 60%;
        }

        .amount {
            font-size: 24px;
            font-weight: bold;
            color: #28a745;
        }

        .message {
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            border-radius: 8px;
            padding: 20px;
            margin: 25px 0;
            color: #155724;
            text-align: center;
        }

        .footer {
            background-color: #f8f9fa;
            padding: 30px;
            text-align: center;
            border-top: 1px solid #e9ecef;
        }

        .footer p {
            color: #6c757d;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .contact-info {
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 8px;
            padding: 20px;
            margin-top: 20px;
        }

        .contact-info h3 {
            color: #856404;
            margin-bottom: 10px;
            font-size: 16px;
        }

        .contact-info p {
            color: #856404;
            margin: 5px 0;
        }

        @media (max-width: 600px) {
            .email-container {
                margin: 10px;
                border-radius: 8px;
            }

            .header, .content, .footer {
                padding: 20px;
            }

            .info-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }

            .info-value {
                max-width: 100%;
                text-align: left;
            }

            .amount {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="header">
            <div class="success-icon">✓</div>
            <h1>Thanh toán thành công!</h1>
            <p>Cảm ơn bạn đã tin tướng và sử dụng dịch vụ của chúng tôi</p>
        </div>

        <!-- Content -->
        <div class="content">
            <div class="greeting">
                Xin chào <strong>{{ $data['ho_va_ten'] }}</strong>,
            </div>

            <p style="margin-bottom: 20px; color: #495057;">
                Chúng tôi vui mừng thông báo rằng giao dịch thanh toán của bạn đã được xử lý thành công.
                Dưới đây là thông tin chi tiết về đơn hàng:
            </p>

            <!-- Payment Info Card -->
            <div class="info-card">
                <div class="info-row">
                    <span class="info-label">👤 Họ và tên:</span>
                    <span class="info-value">{{ $data['ho_va_ten'] }}</span>
                </div>

                <div class="info-row">
                    <span class="info-label">💰 Số tiền thanh toán:</span>
                    <span class="info-value amount">{{ number_format($data['so_tien']) }} VNĐ</span>
                </div>

                <div class="info-row">
                    <span class="info-label">🏥 Lý do khám:</span>
                    <span class="info-value">{{ $data['ly_do_kham'] }}</span>
                </div>

                <div class="info-row">
                    <span class="info-label">📅 Thời gian thanh toán:</span>
                    <span class="info-value">{{ date('d/m/Y H:i:s') }}</span>
                </div>

                <div class="info-row">
                    <span class="info-label">📋 Mã giao dịch:</span>
                    <span class="info-value">#{{ strtoupper(uniqid()) }}</span>
                </div>
            </div>

            <!-- Success Message -->
            <div class="message">
                <strong>🎉 Thanh toán của bạn đã được xác nhận thành công!</strong><br>
                Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất để xác nhận lịch hẹn khám.
            </div>

            <!-- Contact Info -->
            <div class="contact-info">
                <h3>📞 Thông tin liên hệ</h3>
                <p><strong>Hotline:</strong> 1900 1234</p>
                <p><strong>Email:</strong> support@clinic.com</p>
                <p><strong>Địa chỉ:</strong> 123 Đường ABC, Quận XYZ, TP.HCM</p>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p><strong>Cảm ơn bạn đã chọn dịch vụ của chúng tôi!</strong></p>
            <p>Email này được gửi tự động, vui lòng không trả lời trực tiếp.</p>
            <p>Nếu có thắc mắc, vui lòng liên hệ hotline hoặc email hỗ trợ.</p>
            <p style="margin-top: 20px; font-size: 12px;">
                © {{ date('Y') }} Phòng khám ABC. All rights reserved.
            </p>
        </div>
    </div>
</body>
</html>
