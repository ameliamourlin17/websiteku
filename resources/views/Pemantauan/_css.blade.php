<style>
    body {
        background: #8a9099;
    }

    .toolbar {
        max-width: 1100px;
        margin: 20px auto 12px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
        padding: 0 12px;
        color: #fff;
        font-size: 13px;
    }

    .toolbar .act {
        display: flex;
        gap: 10px;
    }

    .paper {
        max-width: 1100px;
        margin: 0 auto 40px;
        background: #fff;
        padding: 26px 30px 34px;
        color: #000;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 11px;
        box-shadow: 0 2px 12px rgba(0, 0, 0, .25);
    }

    .paper table {
        border-collapse: collapse;
        width: 100%;
    }

    .paper td,
    .paper th {
        border: 1px solid #000;
        padding: 2px 6px;
        vertical-align: middle;
    }

    .gray {
        background: #d9d9d9;
        font-weight: 700;
    }

    /* input di dalam kolom formulir */
    .in {
        width: 100%;
        border: 0;
        background: transparent;
        font: inherit;
        color: #000;
        padding: 2px 0;
        outline: 0;
        text-align: inherit;
    }

    select.in {
        -webkit-appearance: none;
        appearance: none;
        text-align: center;
        text-align-last: center;
        font-weight: 700;
        font-size: 15px;
        cursor: pointer;
        min-height: 26px;
    }

    textarea.in {
        resize: vertical;
        min-height: 80px;
    }

    .in::placeholder {
        color: #e00000;
        font-weight: 700;
        opacity: 1;
    }

    .ph {
        color: #777;
    }

    .ph.red {
        color: #e00000;
        font-weight: 700;
    }

    .edit .in:hover,
    .edit .in:focus {
        background: #fff6e0;
    }

    /* header */
    .hdr .logo {
        width: 150px;
        text-align: center;
        padding: 6px;
    }

    .hdr .logo img {
        width: 110px;
        display: block;
        margin: 0 auto;
    }

    .hdr .judul {
        text-align: center;
        font-weight: 700;
        line-height: 1.55;
    }

    .hdr .lbl {
        width: 105px;
    }

    .hdr .val {
        width: 185px;
    }

    .terbatas {
        display: inline-block;
        border: 2px solid #f2d600;
        color: #e0b800;
        font-weight: 700;
        font-size: 15px;
        padding: 5px 14px;
    }

    /* no ref */
    .ref {
        width: 330px !important;
        margin: 14px 0;
    }

    .ref td.k {
        width: 95px;
    }

    .ref td.c {
        width: 14px;
        border-left: 0;
        border-right: 0;
        text-align: center;
        padding: 0;
    }

    .ref td.v {
        border-left: 0;
    }

    /* tabel checklist */
    .tbl td.lab {
        font-weight: 700;
        width: 175px;
        background: #d9d9d9;
    }

    .tbl th.m {
        background: #d9d9d9;
        text-align: center;
        font-weight: 700;
    }

    .tbl td.c {
        text-align: center;
    }

    .tbl td.ctr {
        text-align: center;
        font-weight: 700;
    }

    .tbl td.sub {
        font-weight: 400;
    }

    .tbl td.chk {
        height: 30px;
        text-align: center;
    }

    .tbl td.nomor {
        width: 34px;
        text-align: center;
    }

    .catatan {
        margin-top: 14px;
    }

    .catatan .box {
        border: 1px solid #000;
        min-height: 90px;
        padding: 4px 6px;
        white-space: pre-line;
    }

    .ttd {
        margin-top: 12px;
    }

    .ttd td {
        border: 0 !important;
        padding: 2px 4px;
        vertical-align: top;
    }

    .garis {
        height: 50px;
    }

    .nama {
        font-weight: 700;
        border-bottom: 1px dotted #000;
        margin: 0 auto;
        width: 75%;
        min-height: 15px;
    }

    .nipp {
        display: flex;
        justify-content: center;
        gap: 4px;
        align-items: center;
        margin-top: 2px;
    }

    .nipp .in {
        width: 150px;
    }

    .kecil {
        font-size: 9px;
    }

    @media print {
        @page {
            size: A4 landscape;
            margin: 10mm;
        }

        html,
        body {
            background: #fff !important;
        }

        .no-print {
            display: none !important;
        }

        .paper {
            max-width: none;
            margin: 0;
            padding: 0;
            box-shadow: none;
        }

        .paper table,
        .paper tr {
            page-break-inside: avoid;
        }

        input::-webkit-calendar-picker-indicator {
            display: none;
        }

        * {
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
    }
</style>
