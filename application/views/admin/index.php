<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?=$title;?></h1>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Email</th>
      <th scope="col">Nama Suami</th>
      <th scope="col">Nama Istri</th>
    </tr>
  </thead>
  <tbody>
    <?php $i = 1;?>
    <?php foreach ($akun as $ak): ?>
    <tr>
      <th scope="row"><?=$i;?></th>
      <td><?=$ak['email'];?></td>
      <td><?=$ak['suami'];?></td>
      <td><?=$ak['istri'];?></td>
    </tr>
<?php $i++;?>
<?php endforeach;?>
  </tbody>
</table>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->