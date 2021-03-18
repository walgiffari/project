<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?=$title;?></h1>





    <div class="row">
        <div class="col-lg-6">
            <?=$this->session->flashdata('message');?>
         <?=form_open_multipart('user/info');?>
              <div class="form-group">
                    <label for="email">Email User</label>
                     <input type="text" class="form-control" id="email" name="email" value="<?=$user['email'];?>" readonly>
                </div>

                <div class="form-group">
                    <label for="suami">Nama Suami</label>
                    <input type="text" class="form-control" id="suami" name="suami" value="<?=$info['suami'];?>" >
                    <?=form_error('suami', '<small class="text-danger pl-3">', '</small>');?>
                 </div>


               <div class="form-group row">
                <div class="col-sm-2">Foto Suami</div>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm-3">
                            <img src="<?=base_url('assets/img/profile/') . $info['images_suami'];?>" class="img-thumbnail">
                        </div>
                        <div class="col-sm-9">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="images_suami" name="images_suami">
                                <label class="custom-file-label" for="images_suami">Choose file</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

                <div class="form-group">
                    <label for="istri">Nama Istri</label>
                    <input type="text" class="form-control" id="istri" name="istri" value="<?=$info['istri'];?>">
                    <?=form_error('istri', '<small class="text-danger pl-3">', '</small>');?>
                </div>

                    <div class="form-group row">
                <div class="col-sm-2">Foto Istri</div>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm-3">
                            <img src="<?=base_url('assets/img/profile/') . $info['images_istri'];?>" class="img-thumbnail">
                        </div>
                        <div class="col-sm-9">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="images_istri" name="images_istri">
                                <label class="custom-file-label" for="images_istri">Choose file</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>

                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" value="<?=$info['alamat'];?>">
                    <?=form_error('alamat', '<small class="text-danger pl-3">', '</small>');?>
                </div>
                <br><br>

                <div class="form-group">
                    <label for="suamiO">Orang tua suami</label>
                    <input type="text" class="form-control" id="suamiO" name="suamiO" value="<?=$info['alamat'];?>">
                    <?=form_error('suamiO', '<small class="text-danger pl-3">', '</small>');?>
                </div>
                <div class="form-group">
                    <label for="istriO">Orang tua istri</label>
                    <input type="text" class="form-control" id="istriO" name="istriO" value="<?=$info['alamat'];?>">
                    <?=form_error('istriO', '<small class="text-danger pl-3">', '</small>');?>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" style="width:100px;">Simpan</button>
                </div>


        </div>
    </div>



</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->