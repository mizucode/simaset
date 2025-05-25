<style>
  /* General Body Setup (Minimal, bisa Anda ses

  /* Styling untuk .stk-card dan elemen di dalamnya */
  .stk-card {
    width: 220px;
    height: 350px;
    box-sizing: border-box;
    overflow: hidden;
    background-color: #ffffff;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    page-break-inside: avoid;
    /* Hindari stiker terpotong saat print */
    /* Jika stiker ini akan diletakkan dalam .a4-page atau container flex lain,
     mungkin perlu properti flex item di sini atau di parentnya.
     Untuk satu stiker tunggal, ini cukup.
  */
  }

  .stk-content {
    width: 100%;
    height: 100%;
    border: 2px solid #04294d;
    border-radius: 10px;
    /* Sinkronkan dengan .stk-card */
    box-sizing: border-box;
    padding: 12px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
  }

  /* Header Section: Logo and Favicon */
  .stk-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-bottom: 10px;
    border-bottom: 1px solid #e0e0e0;
    margin-bottom: 10px;
    flex: 0 0 auto;
    /* Tidak tumbuh, tidak menyusut, ukuran otomatis */
  }

  .stk-logo-wrapper img,
  .stk-favicon-wrapper img {
    display: block;
    max-width: 100%;
    height: auto;
  }

  .stk-favicon-wrapper img {
    margin-right: 3px;
    /* Jika masih diperlukan, bisa disesuaikan */
  }

  /* Item Details Section */
  .stk-item-info {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    flex: 0 0 auto;
    margin-bottom: 10px;
    padding: 5px 0;
  }

  .stk-item-name {
    font-size: 1.1rem;
    font-weight: 700;
    margin-bottom: 5px;
    color: #2c3e50;
    word-break: break-word;
    line-height: 1.3;
  }

  .stk-item-reg-number {
    font-size: 0.85rem;
    color: #555e68;
  }

  /* QR Code Section */
  .stk-qr-area {
    text-align: center;
    flex: 1 1 auto;
    /* Biarkan mengisi sisa ruang */
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    margin-top: auto;
    /* Dorong ke bawah jika ada sisa ruang */
  }

  .stk-qr-image-container {
    width: 150px;
    height: 150px;
    margin: 0 auto;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .stk-qr-image-container img,
  .stk-qr-image-container canvas {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
  }

  .stk-scan-text {
    margin-top: 10px;
    font-weight: 500;
    font-size: 0.9rem;
    color: #ffffff;
    text-transform: uppercase;
    font-weight: bold;



  }

  /* Print Specific Styles */
  @media print {
    body {
      padding: 0;
      margin: 0;
      background-color: white;
      color: #000;
    }

    .stk-card {
      box-shadow: none;
      /* Hilangkan bayangan stiker saat print */
      /* Jika stiker ini satu-satunya yang dicetak per halaman, 
       Anda mungkin ingin mengatur margin atau posisinya di sini atau via @page */
    }

    .stk-content {
      border: 2px solid #000000;
      /* Border hitam solid untuk print */
    }

    .stk-scan-text,
    .stk-item-name,
    .stk-item-reg-number {
      color: #000000 !important;
      /* Pastikan semua teks penting hitam */
    }

    .stk-header {
      border-bottom-color: #ccc;
      /* Garis pemisah lebih terang untuk print jika perlu */
    }
  }
</style>