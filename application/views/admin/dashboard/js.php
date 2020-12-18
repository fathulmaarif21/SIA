 <script src="<?= base_url(); ?>assets/vendor/datatables/datatables.min.js"></script>
 <script src="<?= base_url(); ?>assets/js/gsap.min.js"></script>
 <!-- Resources -->
 <script src="<?= base_url('assets/vendor/charts/'); ?>core.js"></script>
 <script src="<?= base_url('assets/vendor/charts/'); ?>charts.js"></script>
 <script src="<?= base_url('assets/vendor/charts/'); ?>animated.js"></script>
 <script src="<?= base_url('assets/vendor/charts/'); ?>rangeSelector.js"></script>
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



 <!-- Chart code -->
 <script>
     function getChartdata() {
         return fetch('<?= site_url('Dashboard/donat_chart') ?>').then(response => response.json()).then();
     }

     function getbar_chart() {
         return fetch('<?= base_url('Dashboard/bar_chart') ?>').then(response => response.json()).then();
     }
     getbar_chart();
     am4core.ready(async function() {

         // Themes begin
         am4core.useTheme(am4themes_animated);
         // Themes end
         // Create chart instance
         var chart = am4core.create("chartdiv", am4charts.PieChart);

         // Add data
         chart.data = await getChartdata();

         // Add and configure Series
         var pieSeries = chart.series.push(new am4charts.PieSeries());
         pieSeries.dataFields.value = "jml";
         pieSeries.dataFields.category = "obat";
         pieSeries.innerRadius = am4core.percent(50);
         pieSeries.ticks.template.disabled = false;
         pieSeries.labels.template.disabled = true;

         var rgm = new am4core.RadialGradientModifier();
         rgm.brightnesses.push(-0.8, -0.8, -0.5, 0, -0.5);
         pieSeries.slices.template.fillModifier = rgm;
         pieSeries.slices.template.strokeModifier = rgm;
         pieSeries.slices.template.strokeOpacity = 0.4;
         pieSeries.slices.template.strokeWidth = 0;

         chart.legend = new am4charts.Legend();
         chart.legend.position = "right";

     }); // end am4core.ready()
 </script>



 <!-- Chart code -->
 <script>
     am4core.ready(function() {

         // Themes begin
         am4core.useTheme(am4themes_animated);
         // Themes end

         // Create chart
         var chart = am4core.create("chartSaldo", am4charts.XYChart);
         chart.padding(0, 15, 0, 15);

         // Load external data
         chart.dataSource.url = "<?= base_url('Dashboard/bar_chart') ?>";
         chart.dataSource.parser = new am4core.JSONParser();
         chart.dataSource.parser.options.useColumnNames = true;
         chart.dataSource.parser.options.reverse = true;

         // the following line makes value axes to be arranged vertically.
         chart.leftAxesContainer.layout = "vertical";

         // uncomment this line if you want to change order of axes
         //chart.bottomAxesContainer.reverseOrder = true;

         var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
         dateAxis.renderer.grid.template.location = 0;
         dateAxis.renderer.ticks.template.length = 8;
         dateAxis.renderer.ticks.template.strokeOpacity = 0.1;
         dateAxis.renderer.grid.template.disabled = true;
         dateAxis.renderer.ticks.template.disabled = false;
         dateAxis.renderer.ticks.template.strokeOpacity = 0.2;
         dateAxis.renderer.minLabelPosition = 0.01;
         dateAxis.renderer.maxLabelPosition = 0.99;
         dateAxis.keepSelection = true;
         dateAxis.minHeight = 30;

         dateAxis.groupData = true;
         dateAxis.minZoomCount = 5;

         // these two lines makes the axis to be initially zoomed-in
         // dateAxis.start = 0.7;
         // dateAxis.keepSelection = true;

         var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
         valueAxis.tooltip.disabled = true;
         valueAxis.zIndex = 1;
         valueAxis.renderer.baseGrid.disabled = true;
         // height of axis
         valueAxis.height = am4core.percent(65);

         valueAxis.renderer.gridContainer.background.fill = am4core.color("#000000");
         valueAxis.renderer.gridContainer.background.fillOpacity = 0.05;
         valueAxis.renderer.inside = true;
         valueAxis.renderer.labels.template.verticalCenter = "bottom";
         valueAxis.renderer.labels.template.padding(2, 2, 2, 2);

         //valueAxis.renderer.maxLabelPosition = 0.95;
         valueAxis.renderer.fontSize = "0.8em"

         var series = chart.series.push(new am4charts.LineSeries());
         series.dataFields.dateX = "Date";
         series.dataFields.valueY = "Adj Close";
         series.tooltipText = "{valueY.value}";
         series.name = "MSFT: Value";
         series.defaultState.transitionDuration = 0;

         var valueAxis2 = chart.yAxes.push(new am4charts.ValueAxis());
         valueAxis2.tooltip.disabled = true;
         // height of axis
         valueAxis2.height = am4core.percent(35);
         valueAxis2.zIndex = 3
         // this makes gap between panels
         valueAxis2.marginTop = 30;
         valueAxis2.renderer.baseGrid.disabled = true;
         valueAxis2.renderer.inside = true;
         valueAxis2.renderer.labels.template.verticalCenter = "bottom";
         valueAxis2.renderer.labels.template.padding(2, 2, 2, 2);
         //valueAxis.renderer.maxLabelPosition = 0.95;
         valueAxis2.renderer.fontSize = "0.8em"

         valueAxis2.renderer.gridContainer.background.fill = am4core.color("#000000");
         valueAxis2.renderer.gridContainer.background.fillOpacity = 0.05;

         var series2 = chart.series.push(new am4charts.ColumnSeries());
         series2.dataFields.dateX = "Date";
         series2.dataFields.valueY = "Volume";
         series2.yAxis = valueAxis2;
         series2.tooltipText = "{valueY.value}";
         series2.name = "MSFT: Volume";
         // volume should be summed
         series2.groupFields.valueY = "sum";
         series2.defaultState.transitionDuration = 0;

         chart.cursor = new am4charts.XYCursor();

         var scrollbarX = new am4charts.XYChartScrollbar();
         scrollbarX.series.push(series);
         scrollbarX.marginBottom = 20;
         scrollbarX.scrollbarChart.xAxes.getIndex(0).minHeight = undefined;
         chart.scrollbarX = scrollbarX;


         // Add range selector
         var selector = new am4plugins_rangeSelector.DateAxisRangeSelector();
         selector.container = document.getElementById("controls");
         selector.axis = dateAxis;

     }); // end am4core.ready()
 </script>

 <!-- HTML -->


 <!-- HTML -->