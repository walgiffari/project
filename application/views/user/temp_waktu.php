<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?=$title;?></h1>





    <div class="row">
        <div class="col-lg-6">
            <?=$this->session->flashdata('message');?>
         <?=form_open_multipart('user/info');?>
              <div class="form-group">
                    <label for="akad">Akad</label>
                     <input type="datetime-local" class="form-control" id="akad" name="akad" value="<?=$user['email'];?>" >

                </div>
                <div class="form-group">
                    <label for="persepsi">Persepsi</label>
                    <input type="datetime-local" class="form-control" id="persepsi" name="persepsi" value="<?=$info['suami'];?>" >
                    <?=form_error('suami', '<small class="text-danger pl-3">', '</small>');?>
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