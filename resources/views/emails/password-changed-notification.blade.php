<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Password Changed</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; line-height: 1.6; color: #334155; margin: 0; padding: 0; background-color: #f1f5f9; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .card { background: white; border-radius: 16px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); overflow: hidden; }
        .header { background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%); color: white; padding: 30px; text-align: center; }
        .header h1 { margin: 0; font-size: 24px; }
        .content { padding: 30px; }
        .success-box { background: #dcfce7; border: 1px solid #22c55e; border-radius: 12px; padding: 20px; margin-bottom: 20px; text-align: center; }
        .success-icon { font-size: 48px; margin-bottom: 10px; }
        .detail-row { display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid #e2e8f0; }
        .detail-label { color: #64748b; }
        .detail-value { color: #1e293b; font-weight: 500; }
        .footer { text-align: center; padding: 20px; color: #94a3b8; font-size: 14px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="header">
                <h1>📚 অক্ষর</h1>
                <p style="margin: 8px 0 0 0; opacity: 0.9;">Family Library</p>
            </div>
            <div class="content">
                <div class="success-box">
                    <div class="success-icon">🔒</div>
                    <strong style="font-size: 18px; color: #166534;">Password Changed Successfully</strong>
                    <p style="margin: 8px 0 0 0; font-size: 14px; color: #15803d;">Your account password has been updated.</p>
                </div>

                <h3 style="color: #1e293b; margin-bottom: 15px;">Account Details</h3>

                <div style="margin: 20px 0;">
                    <div class="detail-row">
                        <span class="detail-label">User</span>
                        <span class="detail-value">{{ $user->name }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Email</span>
                        <span class="detail-value">{{ $user->email }}</span>
                    </div>
                    <div class="detail-row" style="border-bottom: none;">
                        <span class="detail-label">Changed at</span>
                        <span class="detail-value">{{ $changedAt }}</span>
                    </div>
                </div>

                <p style="color: #64748b; font-size: 14px; margin-top: 20px; padding: 15px; background: #fef2f2; border-radius: 8px; border: 1px solid #fecaca;">
                    ⚠️ If you did not make this change, please contact the administrator immediately.
                </p>
            </div>
            <div class="footer">
                <p>&copy; {{ date('Y') }} অক্ষর · Family Library</p>
            </div>
        </div>
    </div>
</body>
</html>
