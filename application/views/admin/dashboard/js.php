 <!-- select2 -->
 <script src="<?= base_url(); ?>assets/vendor/datatables/datatables.min.js"></script>
 <script src="<?= base_url(); ?>assets/js/gsap.min.js"></script>
 <script>
     $(document).ready(function() {
         //  var xxxxx = getTimeServer() * 1000;
         //  var timeserver = new Date(xxxxx);
         setInterval(function() {
             //  timeserver = startTime(String(timeserver));
             document.getElementById('r_saldo').innerHTML = `${formatRupiah(realsaldo())}`;
             document.getElementById('r_trx').innerHTML = realtrx();
             document.getElementById('r_stok').innerHTML = realstok();
         }, 1000);
     });

     function realsaldo() {
         let real_saldo = $.ajax({
             type: 'GET',
             url: '<?= base_url('Dashboard/real_time_saldo') ?>',
             async: false,
             success: function(data) {}
         }).responseText;
         let rs = JSON.parse(real_saldo);
         return rs;
     }
     // real time transaksi
     function realtrx() {
         let real_trx = $.ajax({
             type: 'GET',
             url: '<?php echo site_url('Dashboard/real_time_trx') ?>',
             async: false,
             success: function(data) {}
         }).responseText;
         let trx = JSON.parse(real_trx);
         return trx;
     }
     // real time stok
     function realstok() {
         let real_trx = $.ajax({
             type: 'GET',
             url: '<?php echo site_url('Dashboard/real_time_stok') ?>',
             async: false,
             success: function(data) {}
         }).responseText;
         let trx = JSON.parse(real_trx);
         return trx;
     }

     function get_data_expired() {
         $('.row_stok').remove();
         $.ajax({
             url: "<?php echo site_url('Dashboard/get_obat_exp') ?>",
             type: "GET",
             dataType: "JSON",
             success: function(data) {
                 for (let index = 0; index < data.length; index++) {
                     $('#expired').append(`<tr class="row_stok">
                        <td>${data[index].kd_obat }</td>
                        <td>${data[index].nama_obat}</td>
                        <td>${data[index].no_faktur}</td>
                        <td>${data[index].tgl_expired}</td>
                        <td>${data[index].stok}</td>
                    </tr>`);
                 }


                 $('#modal_obat_exp').modal('show'); // show bootstrap modal when complete loaded
                 $('.modal-title').text('List Obat Expired'); // Set title to Bootstrap modal title
             },
             error: function(jqXHR, textStatus, errorThrown) {
                 alert('Error get data from ajax');

             }
         });

     }


     //  class HoverButton {
     //      constructor(el) {
     //          this.el = el;
     //          this.hover = false;
     //          this.calculatePosition();
     //          this.attachEventsListener();
     //      }

     //      attachEventsListener() {
     //          window.addEventListener('mousemove', e => this.onMouseMove(e));
     //          window.addEventListener('resize', e => this.calculatePosition(e));
     //      }

     //      calculatePosition() {
     //          gsap.set(this.el, {
     //              x: 0,
     //              y: 0,
     //              scale: 1
     //          });
     //          const box = this.el.getBoundingClientRect();
     //          this.x = box.left + (box.width * 0.5);
     //          this.y = box.top + (box.height * 0.5);
     //          this.width = box.width;
     //          this.height = box.height;
     //      }

     //      onMouseMove(e) {
     //          let hover = false;
     //          let hoverArea = (this.hover ? 0.7 : 0.5);
     //          let x = e.clientX - this.x;
     //          let y = e.clientY - this.y;
     //          let distance = Math.sqrt(x * x + y * y);
     //          if (distance < (this.width * hoverArea)) {
     //              hover = true;
     //              if (!this.hover) {
     //                  this.hover = true;
     //              }
     //              this.onHover(e.clientX, e.clientY);
     //          }

     //          if (!hover && this.hover) {
     //              this.onLeave();
     //              this.hover = false;
     //          }
     //      }

     //      onHover(x, y) {
     //          gsap.to(this.el, {
     //              x: (x - this.x) * 0.4,
     //              y: (y - this.y) * 0.4,
     //              scale: 1.15,
     //              ease: 'power2.out',
     //              duration: 0.4
     //          });
     //          this.el.style.zIndex = 10;
     //      }
     //      onLeave() {
     //          gsap.to(this.el, {
     //              x: 0,
     //              y: 0,
     //              scale: 1,
     //              ease: 'elastic.out(1.2, 0.4)',
     //              duration: 0.7
     //          });
     //          this.el.style.zIndex = 1;
     //      }
     //  }

     //  const btn1 = document.querySelector('.dbox--color-1');
     //  new HoverButton(btn1);

     //  const btn2 = document.querySelector('.dbox--color-2');
     //  new HoverButton(btn2);

     //  const btn3 = document.querySelector('.dbox--color-3');
     //  new HoverButton(btn3);

     //  const btn4 = document.querySelector('.dbox--color-4');
     //  new HoverButton(btn4);
 </script>