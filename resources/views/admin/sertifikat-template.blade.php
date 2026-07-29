<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        @page { size: A4 landscape; margin: 0; }
        body {
            width: 297mm;
            height: 210mm;
            font-family: 'Arial', sans-serif;
            background: #fff;
            overflow: hidden;
        }
        .sertifikat {
            width: 297mm;
            height: 210mm;
            position: relative;
            background: #fff;
            overflow: hidden;
        }
        .bg-left {
            position: absolute;
            left: 0; top: 0;
            width: 72mm;
            height: 210mm;
            background: linear-gradient(180deg, #7f0000 0%, #c0392b 50%, #7f0000 100%);
        }
        .bg-left-pattern {
            position: absolute;
            left: 0; top: 0;
            width: 72mm;
            height: 210mm;
            background-image: repeating-linear-gradient(
                45deg,
                rgba(255,255,255,0.03) 0px,
                rgba(255,255,255,0.03) 2px,
                transparent 2px,
                transparent 12px
            );
        }
        .logo-area {
            position: absolute;
            left: 0; top: 0;
            width: 72mm;
            height: 210mm;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 10mm;
        }
        .logo-circle {
            width: 35mm;
            height: 35mm;
            background: rgba(255,255,255,0.15);
            border-radius: 50%;
            border: 2px solid rgba(255,255,255,0.4);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 6mm;
        }
        .logo-text {
            color: white;
            font-size: 22pt;
            font-weight: bold;
            letter-spacing: 2px;
        }
        .logo-title {
            color: white;
            font-size: 14pt;
            font-weight: bold;
            text-align: center;
            letter-spacing: 1px;
        }
        .logo-subtitle {
            color: rgba(255,255,255,0.7);
            font-size: 7pt;
            text-align: center;
            margin-top: 2mm;
            letter-spacing: 1px;
            text-transform: uppercase;
        }
        .logo-divider {
            width: 30mm;
            height: 0.5mm;
            background: rgba(255,255,255,0.4);
            margin: 5mm 0;
        }
        .logo-address {
            color: rgba(255,255,255,0.6);
            font-size: 6pt;
            text-align: center;
            line-height: 1.6;
        }
        .content {
            position: absolute;
            left: 76mm;
            top: 0;
            width: 221mm;
            height: 210mm;
            padding: 12mm 15mm 10mm 12mm;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .header-label {
            font-size: 7pt;
            letter-spacing: 4px;
            text-transform: uppercase;
            color: #c0392b;
            font-weight: bold;
            margin-bottom: 2mm;
        }
        .header-title {
            font-size: 28pt;
            font-weight: bold;
            color: #1a0000;
            letter-spacing: 2px;
            text-transform: uppercase;
            line-height: 1.1;
        }
        .header-title span {
            color: #c0392b;
        }
        .header-divider {
            width: 40mm;
            height: 1mm;
            background: linear-gradient(90deg, #7f0000, #c0392b, transparent);
            margin: 4mm 0;
        }
        .recipient-label {
            font-size: 7pt;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: #999;
            margin-bottom: 2mm;
        }
        .recipient-name {
            font-size: 30pt;
            font-weight: bold;
            color: #1a0000;
            letter-spacing: 1px;
            font-style: italic;
            line-height: 1.1;
        }
        .recipient-desc {
            font-size: 9pt;
            color: #555;
            margin-top: 3mm;
            line-height: 1.6;
            max-width: 160mm;
        }
        .info-row {
            display: flex;
            gap: 8mm;
            align-items: stretch;
        }
        .info-box {
            flex: 1;
            background: #fdf5f5;
            border-left: 2mm solid #c0392b;
            padding: 3mm 4mm;
        }
        .info-label {
            font-size: 6pt;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: #999;
            margin-bottom: 1mm;
        }
        .info-value {
            font-size: 8pt;
            font-weight: bold;
            color: #1a0000;
        }
        .ttd-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
        }
        .ttd-box {
            text-align: center;
            width: 55mm;
        }
        .ttd-line {
            width: 50mm;
            height: 0.3mm;
            background: #333;
            margin: 0 auto 2mm;
        }
        .ttd-name {
            font-size: 8pt;
            font-weight: bold;
            color: #1a0000;
        }
        .ttd-title {
            font-size: 6.5pt;
            color: #666;
            margin-top: 0.5mm;
        }
        .cert-number {
            text-align: center;
        }
        .cert-number-label {
            font-size: 6pt;
            letter-spacing: 2px;
            color: #aaa;
            text-transform: uppercase;
        }
        .cert-number-value {
            font-size: 7.5pt;
            font-weight: bold;
            color: #7f0000;
            letter-spacing: 1px;
            margin-top: 1mm;
        }
        .watermark {
            position: absolute;
            right: 18mm;
            top: 50%;
            transform: translateY(-50%);
            width: 35mm;
            height: 35mm;
            border: 2px solid rgba(192,57,43,0.15);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .watermark-inner {
            width: 28mm;
            height: 28mm;
            border: 1px solid rgba(192,57,43,0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: rgba(192,57,43,0.2);
            font-size: 5pt;
            letter-spacing: 1px;
            text-transform: uppercase;
            font-weight: bold;
        }
        .deco-line {
            position: absolute;
            left: 73mm;
            top: 0;
            width: 1.5mm;
            height: 210mm;
            background: linear-gradient(180deg, transparent, #c0392b 20%, #c0392b 80%, transparent);
        }
        .corner-deco {
            position: absolute;
            right: 5mm;
            bottom: 5mm;
            width: 20mm;
            height: 20mm;
            border-right: 1mm solid rgba(192,57,43,0.3);
            border-bottom: 1mm solid rgba(192,57,43,0.3);
        }
        .corner-deco-top {
            position: absolute;
            right: 5mm;
            top: 5mm;
            width: 20mm;
            height: 20mm;
            border-right: 1mm solid rgba(192,57,43,0.3);
            border-top: 1mm solid rgba(192,57,43,0.3);
        }
    </style>
</head>
<body>
<div class="sertifikat">

    <div class="bg-left"></div>
    <div class="bg-left-pattern"></div>
    <div class="deco-line"></div>
    <div class="corner-deco"></div>
    <div class="corner-deco-top"></div>

    <div class="logo-area">
        <div class="logo-circle">
            <div class="logo-text">T</div>
        </div>
        <div class="logo-title">Telkom Indonesia</div>
        <div class="logo-subtitle">Witel Sukabumi</div>
        <div class="logo-divider"></div>
        <div class="logo-address">
            Plaza Telkom Sukabumi<br>
            Jl. Masjid No.1, Gunungparang<br>
            Cikole, Kota Sukabumi<br>
            Jawa Barat 43111
        </div>
    </div>

    <div class="watermark">
        <div class="watermark-inner">PT Telkom<br>Indonesia<br>Witel<br>Sukabumi</div>
    </div>

    <div class="content">
        <div>
            <div class="header-label">Sertifikat Resmi</div>
            <div class="header-title">Sertifikat <span>Magang</span></div>
            <div class="header-divider"></div>
        </div>

        <div>
            <div class="recipient-label">Diberikan kepada</div>
            <div class="recipient-name">{{ $lamaran->user->name }}</div>
            <div class="recipient-desc">
                Telah berhasil menyelesaikan Program Magang di <strong>PT Telkom Indonesia Witel Sukabumi</strong>
                dengan dedikasi dan kinerja yang baik selama periode magang berlangsung.
            </div>
        </div>

        <div class="info-row">
            <div class="info-box">
                <div class="info-label">Institusi</div>
                <div class="info-value">{{ $lamaran->universitas }}</div>
            </div>
            <div class="info-box">
                <div class="info-label">Periode Magang</div>
                <div class="info-value">
                    {{ \Carbon\Carbon::parse($lamaran->tgl_mulai)->format('d M Y') }} —
                    {{ \Carbon\Carbon::parse($lamaran->tgl_selesai)->format('d M Y') }}
                </div>
            </div>
            <div class="info-box">
                <div class="info-label">Durasi</div>
                <div class="info-value">{{ $lamaran->durasi_bulan }} Bulan</div>
            </div>
        </div>

        <div class="ttd-row">
            <div class="ttd-box">
                <div class="ttd-line"></div>
                <div class="ttd-name">{{ $lamaran->user->name }}</div>
                <div class="ttd-title">Peserta Magang</div>
            </div>
            <div class="cert-number">
                <div class="cert-number-label">Nomor Sertifikat</div>
                <div class="cert-number-value">{{ $nomorSertifikat }}</div>
                <div class="cert-number-label" style="margin-top:2mm;">Diterbitkan: {{ $tglTerbit }}</div>
            </div>
            <div class="ttd-box">
                <div class="ttd-line"></div>
                <div class="ttd-name">Manager Witel Sukabumi</div>
                <div class="ttd-title">PT Telkom Indonesia</div>
            </div>
        </div>
    </div>
</div>
</body>
</html>