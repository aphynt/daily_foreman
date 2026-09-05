<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Laporan Diggibility - {{ $data->no_unit }}</title>
<style>
  @page {
    size: A4;
    margin: 14mm 12mm 12mm 12mm;
    background-color: #ffffff;
  }
  
  *, *::before, *::after {
    box-sizing: border-box;
  }
  
  body {
    margin: 0;
    padding: 0;
    font-family: 'Segoe UI', Arial, Helvetica, sans-serif;
    color: #1e293b;
    background-color: #ffffff;
    font-size: 9.5pt;
    line-height: 1.35;
  }

  /* Header Box */
  .header-card {
    background-color: #154c86;
    color: #ffffff;
    padding: 16px 20px;
    border-radius: 4px;
    margin-bottom: 14px;
  }
  
  .header-table {
    width: 100%;
    border-collapse: collapse;
  }
  
  .header-table td {
    vertical-align: middle;
  }
  
  .header-left {
    width: 40%;
    text-align: left;
  }
  
  .header-center {
    width: 35%;
    text-align: center;
  }
  
  .header-right {
    width: 25%;
    text-align: right;
  }
  
  .title-main {
    font-size: 11pt;
    font-weight: 700;
    letter-spacing: 0.5px;
    margin-bottom: 8px;
    text-transform: uppercase;
  }
  
  .company-badge {
    display: inline-block;
    background-color: #0d3663;
    color: #ffffff;
    padding: 5px 18px;
    border-radius: 14px;
    font-size: 8pt;
    font-weight: 600;
    letter-spacing: 0.3px;
  }
  
  .unit-title {
    font-size: 21pt;
    font-weight: 800;
    letter-spacing: 0.5px;
    margin: 0 0 4px 0;
  }
  
  .report-date {
    font-size: 8.5pt;
    color: #f1f5f9;
  }
  
  .meta-id {
    font-size: 7.5pt;
    font-weight: 600;
    letter-spacing: 0.5px;
    margin-bottom: 2px;
    opacity: 0.9;
  }
  
  .location-code {
    font-size: 19pt;
    font-weight: 800;
    letter-spacing: 0.5px;
    margin: 0;
  }

  /* Average Digging Time Card */
  .kpi-card {
    border: 2.5px solid #d97706;
    background-color: #fffcf4;
    text-align: center;
    padding: 13px 10px 15px 10px;
    margin-bottom: 14px;
    border-radius: 2px;
  }
  
  .kpi-title {
    font-size: 9.5pt;
    font-weight: 700;
    color: #d97706;
    letter-spacing: 1px;
    text-transform: uppercase;
    margin-bottom: 2px;
  }
  
  .kpi-value {
    font-size: 36pt;
    font-weight: 800;
    color: #d97706;
    line-height: 1.1;
    margin: 2px 0 6px 0;
  }
  
  .kpi-desc {
    font-size: 9.5pt;
    font-weight: 700;
    color: #d97706;
    letter-spacing: 0.5px;
  }

  /* Styling Khusus Jika Material Bagus (Hijau) */
.kpi-card.kpi-success {
  border-color: #16a34a;
  background-color: #f0fdf4;
}

.kpi-card.kpi-success .kpi-title,
.kpi-card.kpi-success .kpi-value,
.kpi-card.kpi-success .kpi-desc {
  color: #16a34a;
}

  /* Metadata Grid */
  .meta-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 14px;
  }
  
  .meta-table td {
    width: 50%;
    border: 1px solid #cfd8dc;
    padding: 5px 8px;
    vertical-align: top;
  }
  
  .meta-table td.empty-cell {
    border: none;
    background: transparent;
  }
  
  .meta-label {
    font-size: 7pt;
    font-weight: 700;
    color: #64748b;
    text-transform: uppercase;
    margin-bottom: 2px;
  }
  
  .meta-val {
    font-size: 8.5pt;
    font-weight: 700;
    color: #0f172a;
  }

  /* Section Title Bar */
  .section-bar {
    background-color: #edf2f7;
    border-left: 7px solid #e67e22;
    padding: 6px 10px;
    font-size: 9pt;
    font-weight: 700;
    color: #154c86;
    margin-bottom: 10px;
    letter-spacing: 0.3px;
  }

  /* Passes Table */
  .passes-table-wrap {
    width: 100%;
  }

  .passes-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 2px 0;
    font-size: 8.5pt;
  }
  
  .passes-table th {
    background-color: #154c86;
    color: #ffffff;
    font-weight: 700;
    text-align: center;
    padding: 6px 4px;
    font-size: 8pt;
    border: none;
  }
  
  .passes-table th.col-pass {
    width: 20%;
  }
  
  .passes-table th.col-detik {
    width: 30%;
  }
  
  .passes-table td {
    padding: 5px 6px;
    text-align: center;
    border-bottom: 1px solid #dbeafe;
    border-left: 1px solid #dbeafe;
    border-right: 1px solid #dbeafe;
    color: #1e293b;
  }
  
  .passes-table tr:nth-child(even) td {
    background-color: #f8fafc;
  }
  
  .passes-table td.pass-num {
    font-weight: 600;
  }
  
  .passes-table td.pass-time {
    font-weight: 700;
  }

  /* Footer */
  .footer-text {
    margin-top: 14px;
    text-align: center;
    font-size: 7.5pt;
    color: #64748b;
  }
</style>
</head>
<body>

  <!-- Header Banner -->
  <div class="header-card">
    <table class="header-table">
      <tr>
        <td class="header-left">
          <div class="title-main">MONITORING DIGGIBILITY</div>
          <div class="company-badge">PT. SIMS JAYA KALTIM</div>
        </td>
        <td class="header-center">
          <div class="unit-title">{{ $data->no_unit }}</div>
          <div class="report-date">{{ \Carbon\Carbon::parse($data->created_at)->locale('id')->translatedFormat('j F Y, H:i') }}</div>
        </td>
        <td class="header-right">
          <div class="meta-id">UUID {{ substr($data->uuid, -10) }}</div>
          <div class="location-code">{{ $data->lokasi }}</div>
        </td>
      </tr>
    </table>
  </div>

  <!-- KPI Box -->
  <div class="kpi-card {{ trim($data->kategori) === 'MATERIAL BAGUS' ? 'kpi-success' : '' }}">
        <div class="kpi-title">AVERAGE DIGGING TIME</div>
        <div class="kpi-value">{{ $data->average_digging_time }}</div>
        <div class="kpi-desc">DETIK &nbsp;&bull;&nbsp; {{ $data->kategori }} &nbsp;&bull;&nbsp; {{ $data->keterangan_area }}</div>
    </div>

  <!-- Meta Info Table -->
  <table class="meta-table">
    <tr>
      <td>
        <div class="meta-label">WAKTU LAPOR</div>
        <div class="meta-val">{{ \Carbon\Carbon::parse($data->created_at)->locale('id')->translatedFormat('j F Y, H:i') }}</div>
      </td>
      <td>
        <div class="meta-label">NO. UNIT</div>
        <div class="meta-val">{{ $data->no_unit }}</div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="meta-label">LOKASI</div>
        <div class="meta-val">{{ $data->lokasi }}</div>
      </td>
      <td>
        <div class="meta-label">TITIK KOORDINAT</div>
        <div class="meta-val">{{ $data->titik_koordinat }}</div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="meta-label">TINGGI JENJANG</div>
        <div class="meta-val">{{ $data->tinggi_jenjang }} m</div>
      </td>
      <td>
        <div class="meta-label">OPERATOR</div>
        <div class="meta-val">{{ $data->nik_operator }} - {{ $data->nama_operator }}</div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="meta-label">PENGAWAS</div>
        <div class="meta-val">{{ $data->nik_pengawas }} - {{ $data->nama_pengawas }}</div>
      </td>
      <td>
        <div class="meta-label">JENIS MATERIAL</div>
        <div class="meta-val">{{ $data->jenis_material }}</div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="meta-label">PASSES BUCKET</div>
        <div class="meta-val">{{ $data->passes_bucket }}</div>
      </td>
      <td class="empty-cell"></td>
    </tr>
  </table>

  <!-- Detail Section Header -->
  <div class="section-bar">
    DETAIL {{ $data->total_passes }} PASSES DIGGING TIME
  </div>

  <!-- Passes Table -->
  <div class="passes-table-wrap">
    <table class="passes-table">
        <thead>
            <tr>
            <th class="col-pass">PASS</th>
            <th class="col-detik">DETIK</th>
            <th class="col-pass">PASS</th>
            <th class="col-detik">DETIK</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data->passes->chunk(2) as $row)
            <tr>
                {{-- Kolom 1 --}}
                @php $first = $row->first(); @endphp
                <td class="pass-num">{{ str_pad($first->pass_no, 2, '0', STR_PAD_LEFT) }}</td>
                <td class="pass-time">{{ number_format($first->digging_time, 2) }} detik</td>

                {{-- Kolom 2 (dicek jika jumlah data ganjil / ada item kedua) --}}
                @php $second = $row->count() > 1 ? $row->last() : null; @endphp
                @if ($second)
                <td class="pass-num">{{ str_pad($second->pass_no, 2, '0', STR_PAD_LEFT) }}</td>
                <td class="pass-time">{{ number_format($second->digging_time, 2) }} detik</td>
                @else
                <td class="pass-num">-</td>
                <td class="pass-time">-</td>
                @endif
            </tr>
            @endforeach
        </tbody>
        </table>
  </div>

  <!-- Footer -->
  <div class="footer-text">
    Dibuat oleh: {{ $data->nama_pic }} &nbsp;&bull;&nbsp; Laporan digital Monitoring Diggibility
  </div>

</body>
</html>
