<?php
// receptionist/home.php
require_once '../db.php';
// Lấy dữ liệu phòng
$stmt = $con->prepare("SELECT room_number, room_type, state FROM rooms ORDER BY room_number");
$stmt->execute();
$rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);
$rooms_json = json_encode($rooms, JSON_UNESCAPED_UNICODE);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1.0" />
  <title>Quản lý lễ tân – LOTUS HOTEL</title>
  <link rel="stylesheet" href="recepstyle.css" />
  <style>
    .trong     { background:#6fdc6f }
    .co-khach  { background:#ef7070 }
    .dang-don  { background:#f4d45b }
    #actionButtons{display:flex;gap:8px;margin-top:12px}
    .btn-checkin,.btn-checkout,.btn-save{
      padding:6px 14px;border:none;border-radius:4px;cursor:pointer;color:#fff
    }
    .btn-checkin{background:#2e7d32}.btn-checkout{background:#c62828}.btn-save{background:#1976d2}
  </style>
</head>
<body>
<?php include 'includes/navbar.php'; ?>

<div class="main">
  <header>Quản lý chi tiết phòng</header><br>
  <div class="legend">
    <span class="legend-item trong">🟩 Trống</span>
    <span class="legend-item co-khach">🟥 Có khách</span>
    <span class="legend-item dang-don">🟨 Đang dọn</span>
  </div>
  <div id="building"></div>
</div>

<!-- ===== Modal chi tiết phòng ===== -->
<div id="roomModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeModal()">&times;</span>
    <h3>📋 Chi tiết phòng <span id="modalRoomNumber"></span></h3>

    <label>Loại phòng:</label><label id="modalRoomType"></label>
    <label>Giá tiền:</label><label id="modalRoomPrice"></label>

    <label>Họ tên khách hàng:</label><input type="text" id="modalGuestName">
    <label>CCCD:</label><input type="text" id="modalGuestCCCD">
    <label>Số điện thoại:</label><input type="text" id="modalGuestPhone">
    <label>Email:</label><input type="email" id="modalGuestEmail">
    <label>Địa chỉ:</label><input type="text" id="modalGuestAddress">
    <label>Ngày đến:</label><input type="date" id="modalCheckinDate" disabled>
    <label>Ngày đi:</label><input type="date" id="modalCheckoutDate">

    <label>Dịch vụ Minibar:</label>
    <div style="margin-bottom:10px">
      <label>Nước suối:
        <input type="number" id="modalWater" min="0" value="0" style="width:60px">
      </label><br>
      <label>Nước ngọt:
        <input type="number" id="modalSoftdrink" min="0" value="0" style="width:60px">
      </label><br>
      <label>Bia lon:
        <input type="number" id="modalBeer" min="0" value="0" style="width:60px">
      </label>
    </div>

    <label>Tổng tiền Minibar:</label>
    <div id="modalMinibarTotal" style="margin-bottom: 5px; font-weight: bold;">0 VND</div>

    <label>Tổng tiền:</label>
    <div id="modalTotalPrice" style="margin-bottom: 10px; font-weight: bold;">0 VND</div>

    <div id="actionButtons">
      <button class="btn-checkin"  onclick="checkIn()">Check‑in</button>
      <button class="btn-checkout" onclick="checkOut()">Check‑out</button>
    </div>
    <button id="saveButton" class="btn-save" onclick="saveRoomData()">Lưu thông tin</button>
  </div>
</div>

<script>
const building      = document.getElementById('building');
const modal         = document.getElementById('roomModal');
const numSpan       = document.getElementById('modalRoomNumber');
const typeLbl       = document.getElementById('modalRoomType');
const priceLbl      = document.getElementById('modalRoomPrice');
const gName         = document.getElementById('modalGuestName');
const gCCCD         = document.getElementById('modalGuestCCCD');
const gPhone        = document.getElementById('modalGuestPhone');
const gEmail        = document.getElementById('modalGuestEmail');
const gAddr         = document.getElementById('modalGuestAddress');
const inDate        = document.getElementById('modalCheckinDate');
const outDate       = document.getElementById('modalCheckoutDate');
const water         = document.getElementById('modalWater');
const soft          = document.getElementById('modalSoftdrink');
const beer          = document.getElementById('modalBeer');

let currentRoom = null;

[water, soft, beer, inDate, outDate].forEach(el => {
  el.addEventListener('input', calculateTotals);
});

const rooms = <?= $rooms_json ?>;
const cls  = {available:'trong', booked:'co-khach', clear:'dang-don'};
const prices = {Single:500000,Guest:770000,Deluxe:1000000,Luxury:1500000};

buildFloors();
function buildFloors(){
  for(let fl=6; fl>=1; fl--){
    const flDiv=document.createElement('div');
    flDiv.innerHTML=`<div class="floor-title">Tầng ${fl}</div>`;
    const list=document.createElement('div'); list.className='rooms';
    for(let i=1;i<=8;i++){
      const no=`${fl}${String(i).padStart(2,'0')}`;
      const info = rooms.find(r=>r.room_number===no) || {state:'available'};
      const div = document.createElement('div');
      div.className='room '+cls[info.state];
      div.dataset.room=no;
      div.innerHTML=`Phòng <br>${no}`;
      div.onclick = ()=> openModal(no);
      div.oncontextmenu = e=>{
        e.preventDefault();
        if(info.state==='clear') cleanRoom(no,div);
      };
      list.appendChild(div);
    }
    flDiv.appendChild(list);
    building.appendChild(flDiv);
  }
}

function openModal(room){
  fetch(`get_room.php?room=${room}`)
    .then(r=>r.json()).then(d=>{
      if(d.error){ alert(d.error); return; }

      currentRoom = room;
      numSpan.textContent = room;
      typeLbl.textContent = d.room_type;
      priceLbl.textContent = (prices[d.room_type]||0).toLocaleString('vi-VN')+' VND/đêm';

      gName.value   = d.customer_name || '';
      gCCCD.value   = d.cccd          || '';
      gPhone.value  = d.phone         || '';
      gEmail.value  = d.email         || '';
      gAddr.value   = d.address       || '';
      inDate.value  = d.check_in      || '';
      outDate.value = d.check_out     || '';
      water.value   = d.water         || 0;
      soft.value    = d.soft_drink    || 0;
      beer.value    = d.beer          || 0;

      const abtn = document.querySelector('.btn-checkin');
      const bbtn = document.querySelector('.btn-checkout');
      const save = document.getElementById('saveButton');

      if(d.state==='available'){
        abtn.style.display='inline-block';
        bbtn.style.display='none';
        save.style.display='none';
      }else if(d.state==='booked'){
        abtn.style.display='none';
        bbtn.style.display='inline-block';
        save.style.display='block';
      }else{
        alert('Phòng đang cần làm sạch – click phải để làm sạch!');
        return;
      }
      modal.style.display='block';
      calculateTotals();
    });
}

function closeModal(){ modal.style.display='none'; }

function checkIn(){
  if(!gName.value.trim()){ alert('Vui lòng nhập tên khách!'); return; }
  const fd = new FormData();
  fd.append('action','checkin');
  fd.append('room',currentRoom);
  fd.append('guest_name', gName.value.trim());
  fd.append('cccd', gCCCD.value.trim());
  fetch('room_actions.php',{method:'POST',body:fd})
     .then(r=>r.json()).then(res=>{
        if(res.ok){
          document.querySelector(`[data-room="${currentRoom}"]`).className='room '+cls.booked;
          inDate.value = new Date().toISOString().slice(0,10);
          saveRoomData();
        }else alert(res.error);
     });
}

function saveRoomData(){
  const fd=new FormData();
  fd.append('action','save'); fd.append('room',currentRoom);
  fd.append('customer_name', gName.value);
  fd.append('cccd', gCCCD.value);
  fd.append('phone', gPhone.value);
  fd.append('email', gEmail.value);
  fd.append('address', gAddr.value);
  fd.append('check_out', outDate.value);
  fd.append('water', water.value);
  fd.append('soft_drink', soft.value);
  fd.append('beer', beer.value);
  fetch('room_actions.php',{method:'POST',body:fd})
     .then(r=>r.json()).then(res=>{
        alert(res.ok ? 'Đã lưu!' : res.error);
     });
}

function checkOut(){
  if(!confirm('Xác nhận Check‑out?')) return;
  const fd=new FormData();
  fd.append('action','checkout');
  fd.append('room',currentRoom);
  fd.append('check_out', outDate.value);
  fetch('room_actions.php',{method:'POST',body:fd})
     .then(r=>r.json()).then(res=>{
        if(res.ok){
          document.querySelector(`[data-room="${currentRoom}"]`).className='room '+cls.clear;
          closeModal();
        }else alert(res.error);
     });
}

function cleanRoom(room,div){
  if(!confirm('Đã làm sạch phòng?')) return;
  fetch(`room_actions.php?action=clean&room=${room}`)
     .then(r=>r.json()).then(res=>{
        if(res.ok) div.className='room '+cls.available;
        else alert(res.error);
     });
}

function calculateTotals() {
  const w = parseInt(water.value) || 0;
  const s = parseInt(soft.value)  || 0;
  const b = parseInt(beer.value)  || 0;
  const minibar = w*10000 + s*15000 + b*20000;

  const checkin  = inDate.value;
  const checkout = outDate.value;
  let days = 1;
  if (checkin && checkout) {
    const d1 = new Date(checkin);
    const d2 = new Date(checkout);
    const diff = Math.round((d2 - d1) / 86400000);
    if (diff > 0) days = diff;
  }

  const roomType  = typeLbl.textContent.trim();
  const priceMap  = {Single:500000,Guest:770000,Deluxe:1000000,Luxury:1500000};
  const roomPrice = priceMap[roomType] || 0;
  const total = minibar + (days * roomPrice);

  document.getElementById('modalMinibarTotal').innerText = minibar.toLocaleString('vi-VN') + " VND";
  document.getElementById('modalTotalPrice').innerText   = total.toLocaleString('vi-VN') + " VND";
}
</script>
</body>
</html>
