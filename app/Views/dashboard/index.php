<?=$this->extend("layouts/template")?>

<?=$this->section("content")?>
  <!-- Content Header (Page header) -->
  <section class="content-header">
      <h1> 
      </h1>

  </section>
  <!-- $data['sparepart_masuk'] = $sparepart_masuk->tot_sparepart_masuk()->getResult(); 
        $data['sparepart_keluar'] = $sparepart_keluar->tot_penjualan()->getResult(); 
        $data['sparepart'] = $sparepart->tot_sparepart()->getResult(); 
        $data['supplier'] = $supplier->tot_supplier()->getResult();   -->
  <!-- Main content -->
  <section class="content">
      <div class='row'> 
          <div class='col-md-12'>
          <div class='col-md-12'>
              <h2>&nbsp; Dashboard</h2>
              <div class="col-lg-3 col-xs-12">
                  <!-- small box -->
                  <div class="small-box bg-purple">
                      <div class="inner">
                      <h3><?php echo $sparepart[0]->total;?></h3> 
                          <p>Service</p>
                      </div>
                      <div class="icon">
                      </div>
                      <a href="<?php echo base_url('servis');?>" class="small-box-footer">More info <i
                              class="fa fa-arrow-circle-right"></i></a>
                  </div>
              </div><!-- ./col -->
              <div class="col-lg-3 col-xs-12">
                  <!-- small box -->
                  <div class="small-box bg-aqua">
                      <div class="inner">
                      <h3><?php echo $sparepart[0]->total;?></h3> 
                          <p>Sparepart</p>
                      </div>
                      <div class="icon">
                      </div>
                      <a href="<?php echo base_url('sparepart');?>" class="small-box-footer">More info <i
                              class="fa fa-arrow-circle-right"></i></a>
                  </div>
              </div><!-- ./col -->
              <div class="col-lg-3 col-xs-12 ">
                  <!-- small box -->
                  <div class="small-box bg-green">
                      <div class="inner">
                      <h3><?php echo $supplier[0]->total;?></h3> 
                          <p>Supplier</p>
                      </div>
                      <div class="icon">
                      </div>
                      <a href="<?php echo base_url('supplier');?>" class="small-box-footer">More info <i
                              class="fa fa-arrow-circle-right"></i></a>
                  </div>
              </div><!-- ./col -->  
              <div class="col-lg-3 col-xs-12 ">
                  <!-- small box -->
                  <div class="small-box bg-red">
                      <div class="inner">
                      <h3><?php echo $sparepart_masuk[0]->total;?></h3> 
                          <p>Pembelian Sparepart</p>
                      </div>
                      <div class="icon">
                      </div>
                      <a href="<?php echo base_url('masuk');?>" class="small-box-footer">More info <i
                              class="fa fa-arrow-circle-right"></i></a>
                  </div>
              </div><!-- ./col -->  
              <div class="col-lg-3 col-xs-12 ">
                  <!-- small box -->
                  <div class="small-box bg-yellow">
                      <div class="inner">
                      <h3><?php echo $sparepart_keluar[0]->total;?></h3> 
                          <p>Penjualan Sparepart</p>
                      </div>
                      <div class="icon">
                      </div>
                      <a href="<?php echo base_url('keluar');?>" class="small-box-footer">More info <i
                              class="fa fa-arrow-circle-right"></i></a>
                  </div>
              </div><!-- ./col -->
            </div><!-- /.row --> 
        
          <!-- /.col-->
      </div><!-- ./row -->

      <?=$this->endSection()?>

       