<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sorabi Ceu Neneng - Rasa Otentik Sejak Dulu</title>
    
    <!-- Meta Tag CSRF (Penting untuk AJAX) -->
    <meta name="csrf-token" content="<?= csrf_hash() ?>">

    <!-- Bootstrap & Font Awesome dari CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- CSS Kustom Anda -->
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>
<body class="d-flex flex-column min-vh-100">

<!-- 1. NAVBAR -->
<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <a class="navbar-brand" href="<?= base_url('/') ?>">Sorabi Ceu Neneng</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="<?= base_url('/') ?>">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= base_url('menu') ?>">Menu</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= base_url('lokasi') ?>">Lokasi</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= base_url('kontak') ?>">Kontak</a></li>
                
                <?php if (session()->get('isLoggedIn')): ?>
                    <!-- JIKA USER SUDAH LOGIN -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user-circle me-1"></i> <?= esc(session()->get('fullname')) ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <?php if (session()->get('role') === 'admin'): ?>
                                <!-- Menu KHUSUS untuk ADMIN -->
                                <li><a class="dropdown-item" href="<?= base_url('admin/menu') ?>"><i class="fas fa-utensils fa-fw me-2"></i>Kelola Menu</a></li>
                                <li><a class="dropdown-item" href="<?= base_url('admin/orders') ?>"><i class="fas fa-receipt fa-fw me-2"></i>Kelola Pesanan</a></li>
                                <li><hr class="dropdown-divider"></li>
                            <?php endif; ?>
                            
                            <!-- Menu untuk SEMUA user yang login -->
                            <li><a class="dropdown-item" href="<?= site_url('profile') ?>">
    <i class="fas fa-user-cog fa-fw me-2"></i>Profil Saya
</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('logout') ?>"><i class="fas fa-sign-out-alt fa-fw me-2"></i>Logout</a></li>
                        </ul>
                    </li>
                <?php else: ?>
                    <!-- JIKA USER BELUM LOGIN -->
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('register') ?>">Registrasi</a></li>
                    <!-- <li class="nav-item"><a class="nav-link" href="<?= base_url('login') ?>">Login</a></li> -->
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<!-- 2. KONTEN UTAMA HALAMAN -->
<main class="flex-grow-1">
    <?= $this->renderSection('content') ?>
</main>

<!-- 3. FOOTER -->
<footer class="footer section-padding" style="background-color: var(--color-bg-light); padding-bottom: 30px;">
    <div class="container">
        <div class="row gy-5">
            <!-- Kolom 1: Brand & Deskripsi -->
            <div class="col-lg-4 col-md-6">
                <a class="footer-brand" href="<?= base_url('/') ?>">Sorabi Ceu Neneng</a>
                <p class="mt-3 text-muted">Menyajikan kehangatan sorabi dan renyahnya tempe dengan resep otentik warisan keluarga sejak 2007.</p>
                <div class="footer-social-icons mt-4">
                    <a href="https://www.instagram.com/mohamadaban_?utm_source=qr" class="social-icon"><i class="fab fa-instagram"></i></a>
                    <a href="https://www.facebook.com/share/1AbMwuHYEx/?mibextid=qi2Omg" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://wa.me/6283156996256" class="social-icon"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>

            <!-- Kolom 2: Link Navigasi -->
            <div class="col-lg-2 col-md-6">
                <h5 class="footer-title">Jelajahi</h5>
                <ul class="list-unstyled footer-links">
                    <li><a href="<?= base_url('/') ?>">Home</a></li>
                    <li><a href="<?= base_url('menu') ?>">Menu</a></li>
                    <li><a href="<?= base_url('lokasi') ?>">Lokasi</a></li>
                    <li><a href="<?= base_url('kontak') ?>">Kontak</a></li>
                </ul>
            </div>

            <!-- Kolom 3: Informasi Kontak -->
            <div class="col-lg-3 col-md-6">
                <h5 class="footer-title">Hubungi Kami</h5>
                <ul class="list-unstyled footer-contact">
                    <li><i class="fas fa-map-marker-alt"></i><span>Jl. Manis Rt 005 Rw 002 Desa KarangMuncang, Kabupaten Kuningan, Jawa Barat.</span></li>
                    <li><i class="fas fa-phone"></i><span>083156996256</span></li>
                    <li><i class="fas fa-envelope"></i><span>sorabiceuneneng@gmail.com</span></li>
                </ul>
            </div>

            <!-- Kolom 4: Jam Buka -->
            <div class="col-lg-3 col-md-6">
                 <h5 class="footer-title">Jam Buka</h5>
                 <p class="mb-1"><strong>Setiap Hari</strong><br>Pukul 02.00 - 08.00 WIB</p>

            </div>
        </div>

        <div class="footer-bottom">
            <div class="row">
                <div class="col-md-6"><p class="small mb-0 text-muted">© <?= date('Y') ?> Sorabi Ceu Neneng.</p></div>
                <!-- <div class="col-md-6 text-md-end"><a href="<?= base_url('login') ?>" class="small text-muted">Area Admin</a></div> -->
            </div>
        </div>
    </div>
</footer>

<!-- 4. MODAL-MODAL -->
<!-- MODAL KERANJANG -->
<div class="modal fade" id="cartModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header"><h5 class="modal-title"><i class="fas fa-shopping-bag me-2"></i>Keranjang Pesanan</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
      <div class="modal-body"><div id="cart-items-container"></div><div id="cart-empty-message" class="text-center p-4"><p class="text-muted">Keranjang Anda masih kosong.</p></div></div>
      <div class="modal-footer d-flex justify-content-between"><strong>Total: <span id="cart-total-price" class="fs-5 text-primary">Rp 0</span></strong><div><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Lanjut Belanja</button><button type="button" class="btn btn-primary" id="checkout-btn" disabled>Pesan Sekarang</button></div></div>
    </div>
  </div>
</div>
<!-- MODAL CHECKOUT -->
<div class="modal fade" id="checkoutModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"><h5 class="modal-title">Konfirmasi Pesanan</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
      <div class="modal-body">
         <p>Halo, <strong><?= esc(session()->get('fullname') ?? 'Pelanggan') ?></strong>!</p>
         <p>Anda akan mengonfirmasi pesanan ini. Detail pesanan akan dikirimkan melalui WhatsApp.</p>
         <p>Klik tombol di bawah untuk menyelesaikan pesanan.</p>
      </div>
      <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#cartModal">Kembali</button><button type="button" class="btn btn-success" id="send-whatsapp-btn">Konfirmasi & Kirim Pesanan</button></div>
    </div>
  </div>
</div>

<!-- 5. SEMUA SCRIPT JAVASCRIPT -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    
    // --- LOGIKA UNTUK NAVBAR SCROLL ---
    try {
        const navbar = document.querySelector('.navbar.fixed-top');
        if (navbar) {
            const handleScroll = () => {
                navbar.classList.toggle('scrolled', window.scrollY > 50);
            };
            window.addEventListener('scroll', handleScroll);
            handleScroll();
        }
    } catch (e) { console.error("Error pada script Navbar Scroll:", e); }

    // --- LOGIKA UNTUK KERANJANG BELANJA & PEMESANAN ---
    try {
        const isLoggedIn = <?= session()->get('isLoggedIn') ? 'true' : 'false' ?>;
        
        let cart = JSON.parse(localStorage.getItem('sorabiCart')) || [];
        const adminWhatsappNumber = '6283156996256';

        const cartCountPage = document.getElementById('cart-count-page');
        const cartItemsContainer = document.getElementById('cart-items-container');
        const cartTotalPriceElement = document.getElementById('cart-total-price');
        const cartEmptyMessage = document.getElementById('cart-empty-message');
        const checkoutBtn = document.getElementById('checkout-btn');
        
        const checkoutModalInstance = document.getElementById('checkoutModal') ? new bootstrap.Modal(document.getElementById('checkoutModal')) : null;
        const cartModalInstance = document.getElementById('cartModal') ? new bootstrap.Modal(document.getElementById('cartModal')) : null;

        function formatRupiah(number) { return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(number); }

        function renderCart() {
            if (!cartItemsContainer) return;
            cartItemsContainer.innerHTML = ''; let total = 0; let itemCount = 0;
            if (cart.length === 0) {
                cartEmptyMessage.style.display = 'block'; checkoutBtn.disabled = true;
            } else {
                cartEmptyMessage.style.display = 'none'; checkoutBtn.disabled = false;
                const table = document.createElement('table');
                table.className = 'table align-middle';
                table.innerHTML = `<thead><tr><th style="width: 50%;">Produk</th><th class="text-center">Jumlah</th><th class="text-end">Subtotal</th><th></th></tr></thead><tbody></tbody>`;
                const tbody = table.querySelector('tbody');
                cart.forEach(item => {
                    const subtotal = item.price * item.quantity; total += subtotal; itemCount += item.quantity;
                    const tr = document.createElement('tr');
                    tr.innerHTML = `<td><div class="d-flex align-items-center"><img src="${item.image}" width="60" class="rounded me-3"><div><h6 class="mb-0 small">${item.name}</h6><span class="text-muted small">${formatRupiah(item.price)}</span></div></div></td><td><div class="input-group input-group-sm justify-content-center" style="width:100px;margin:auto;"><button class="btn btn-outline-secondary quantity-change-btn" data-id="${item.id}" data-change="-1">-</button><input type="text" class="form-control text-center" value="${item.quantity}" readonly><button class="btn btn-outline-secondary quantity-change-btn" data-id="${item.id}" data-change="1">+</button></div></td><td class="text-end fw-bold">${formatRupiah(subtotal)}</td><td class="text-center"><button class="btn btn-sm btn-outline-danger remove-item-btn" data-id="${item.id}">×</button></td>`;
                    tbody.appendChild(tr);
                });
                cartItemsContainer.appendChild(table);
            }
            if (cartTotalPriceElement) cartTotalPriceElement.textContent = formatRupiah(total);
            if (cartCountPage) cartCountPage.textContent = itemCount;
            localStorage.setItem('sorabiCart', JSON.stringify(cart));
        }
        
        document.body.addEventListener('click', function(e) {
            if (e.target.matches('.add-to-cart-btn') || e.target.closest('.add-to-cart-btn')) {
                if (!isLoggedIn) {
                    alert('Anda harus registrasi terlebih dahulu untuk menambahkan item ke keranjang.');
                    window.location.href = '<?= site_url("register") ?>';
                    return;
                }
                const card = e.target.closest('.menu-item');
                if (!card) return;
                const itemId = card.dataset.id;
                const existingItem = cart.find(item => item.id === itemId);
                if (existingItem) { existingItem.quantity++; }
                else { cart.push({ id: itemId, name: card.dataset.name, price: parseFloat(card.dataset.price), image: card.dataset.image, quantity: 1 }); }
                renderCart();
            }
        });
        
        if (cartItemsContainer) {
            cartItemsContainer.addEventListener('click', function(e) {
                const target = e.target; const itemId = target.dataset.id; if (!itemId) return;
                const itemInCart = cart.find(item => item.id === itemId);
                if (target.classList.contains('quantity-change-btn')) {
                    itemInCart.quantity += parseInt(target.dataset.change);
                    if (itemInCart.quantity <= 0) cart = cart.filter(item => item.id !== itemId);
                }
                if (target.classList.contains('remove-item-btn')) cart = cart.filter(item => item.id !== itemId);
                renderCart();
            });
        }
        
        if (checkoutBtn) {
            checkoutBtn.addEventListener('click', () => { 
                if (!isLoggedIn) { alert('Anda harus login terlebih dahulu untuk memesan.'); window.location.href = '<?= site_url("login") ?>'; return; }
                if (cart.length > 0) { cartModalInstance.hide(); checkoutModalInstance.show(); } 
            });
        }
        
        const sendWhatsappBtn = document.getElementById('send-whatsapp-btn');
        if (sendWhatsappBtn) {
            sendWhatsappBtn.addEventListener('click', async function() {
                const sendButton = this;
                sendButton.disabled = true; sendButton.innerHTML = `<span class="spinner-border spinner-border-sm"></span> Memproses...`;
                const orderData = { items: cart };
                try {
                    const response = await fetch('<?= base_url("order/create") ?>', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json', 'X-Requested-With': 'XMLHttpRequest', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')},
                        body: JSON.stringify(orderData)
                    });
                    const newCsrfToken = response.headers.get('X-CSRF-TOKEN');
                    if(newCsrfToken) document.querySelector('meta[name="csrf-token"]').setAttribute('content', newCsrfToken);
                    const result = await response.json();
                    if (!response.ok || !result.success) { alert('Gagal menyimpan pesanan: ' + (result.message || 'Silakan coba lagi.')); throw new Error(result.message); }
                    let message = `*PESANAN BARU (ID: #${result.order_id})*\n\nDari: *<?= esc(session()->get('fullname')) ?>*\nNo. HP: *<?= esc(session()->get('username')) ?>*\n\n--- Detail Pesanan ---\n`;
                    let totalBelanja = 0;
                    cart.forEach(item => { const itemTotal = item.price * item.quantity; message += `▪️ *${item.name}* (x${item.quantity}) = ${formatRupiah(itemTotal)}\n`; totalBelanja += itemTotal; });
                    message += `\n*Total Pesanan: ${formatRupiah(totalBelanja)}*\n\nTerima kasih!`;
                    const whatsappUrl = `https://wa.me/${adminWhatsappNumber}?text=${encodeURIComponent(message)}`;
                    window.open(whatsappUrl, '_blank');
                    cart = []; renderCart(); checkoutModalInstance.hide(); alert('Pesanan Anda berhasil dibuat!');
                } catch (error) {
                    console.error('Error:', error); alert('Terjadi kesalahan. Pastikan Anda sudah login sebagai pelanggan.');
                } finally {
                    sendButton.disabled = false; sendButton.innerHTML = 'Konfirmasi & Kirim Pesanan';
                }
            });
        }
        renderCart();
    } catch(e) { console.error("Error pada script Keranjang:", e); }
});
</script>

<?= $this->renderSection('scripts') ?>
</body>
</html>