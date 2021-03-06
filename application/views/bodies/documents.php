<style>
    @media screen and (max-width: 600px) {
      .tabel_el {
        display:none;
      }
      
      .square_el {
        display:inline;
      }
    }
    
    @media screen and (min-width: 601px) {
      .square_el {
        display:none;
      }
    }
</style>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <h1 class="h3 mb-4 text-gray-800"><?= $maintitle?></h1>

          <div class="row">
            <div class="col-lg-12">

              <?= $this->session->flashdata('message');?>

              <div class="row">
                <div class="col">
                  <?php echo $pagination; ?>
                </div>
              </div>

              <table class="table table-hover tabel_el">
                <thead>
                  <tr>
                    <?php if ($subtitle == 'RKSP'):?>
                      <th scope="col">Nomor RKSP</th>
                      <?php elseif ($subtitle == 'Manifes'):?>
                        <th scope="col">Nomor Manifes</th>
                        <?php elseif ($subtitle == 'Pembongkaran'):?>
                          <th scope="col">Nomor Pembongkaran</th>
                          <?php elseif ($subtitle == 'Penimbunan'):?>
                            <th scope="col">Nomor Penimbunan</th>
                            <?php elseif ($subtitle == 'PIB'):?>
                              <th scope="col">Nomor PIB</th>
                            <?php endif;?>

                    <?php if ($subtitle == 'Pembongkaran'):?>
                      <th scope="col">Waktu Bongkar</th>
                      <?php elseif ($subtitle == 'Penimbunan'):?>
                        <th scope="col">Waktu Timbun</th>
                        <?php else:?>
                          <th scope="col">Doc Date</th>
                        <?php endif;?>

                    <?php if ($subtitle == 'RKSP'):?>
                      <th scope="col">ETA</th>
                      <?php elseif ($subtitle == 'Manifes'):?>
                        <th scope="col">Arrival</th>
                        <?php elseif ($subtitle == 'PIB'):?>
                          <th scope="col">Ref Manifes</th>
                        <?php endif;?>

                    <th scope="col">Input Date</th>
                    <th scope="col">File</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($documents as $p) : ?>
                  <tr>
                    <td><?= $p['nomor'];?> <?php if ($this->user->numAccept($p['ref'], 'accept_manifes') == 0 && $this->user->numAccept($p['ref'], 'reject_manifes') == 1) :?><b class="text-danger">(Ditolak)</b><?php endif;?></td>
                    <td><?= date('d F Y', $p['doc_date']);?></td>

                    <?php if ($subtitle == 'RKSP' || $subtitle == 'Manifes'):?>
                      <td><?= date('d F Y', $p['eta']);?></td>
                      <?php elseif ($subtitle == 'PIB'):?>
                        <td><?= $p['no_manifes'];?></td>
                      <?php endif;?>

                    <td><?= date('d/m/Y H:i', $p['stamp']);?></td>
                    <td>
                      <?php if ($p['filename'] == 'N'):?>
                        <a href="#" class="badge badge-primary uploadDoc" data-id="<?= $p['id_tracking'];?>" data-toggle="modal" data-target="#modalUpload">Upload</a><br>
                      <?php endif;?>
                      
                      <?php if ($p['jenis'] == 'manifes'):?>
                        <?php if ($p['next'] == 0):?>
                          <a href="#" class="badge badge-warning ubahDoc" data-id="<?= $p['id_tracking'];?>" data-toggle="modal" data-target="#modal<?= $modal?>">Ubah</a>
                        <?php endif;?>
                      <?php endif;?>
                    </td>
                  </tr>
                <?php endforeach;?>
                </tbody>
              </table>

              <table class="table table-hover square_el">
                <thead>
                  <tr>
                    <?php if ($subtitle == 'RKSP'):?>
                      <th scope="col">Nomor RKSP</th>
                      <th scope="col">ETA</th>
                      <?php elseif ($subtitle == 'Manifes'):?>
                        <th scope="col">Nomor Manifes</th>
                        <th scope="col">Arrival</th>
                        <?php elseif ($subtitle == 'Pembongkaran'):?>
                          <th scope="col">Nomor Pembongkaran</th>
                          <th scope="col">Waktu Bongkar</th>
                          <?php elseif ($subtitle == 'Penimbunan'):?>
                            <th scope="col">Nomor Penimbunan</th>
                            <th scope="col">Waktu Timbun</th>
                            <?php elseif ($subtitle == 'PIB'):?>
                              <th scope="col">Nomor PIB</th>
                              <th scope="col">Ref Manifes</th>
                            <?php endif;?>
                    
                    <th scope="col">File</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($documents as $p) : ?>
                  <tr>
                    <?php if ($subtitle == 'RKSP' || $subtitle == 'Manifes'):?>
                      <td><b><?= $p['nomor'];?></b> <?php if ($this->user->numAccept($p['ref'], 'accept_manifes') == 0 && $this->user->numAccept($p['ref'], 'reject_manifes') == 1) :?><b class="text-danger">(Ditolak)</b><?php endif;?></td>
                      <td><?= date('d/m/Y', $p['doc_date']);?></td>
                      <?php elseif ($subtitle == 'PIB'):?>
                        <td><b><?= $p['nomor'];?></b><br><?= date('d/m/Y', $p['doc_date']);?></td>
                        <td><?= $p['no_manifes'];?></td>
                        <?php else:?>
                          <td><b><?= $p['nomor'];?></b><br><?= date('d/m/Y', $p['doc_date']);?></td>
                          <td><?= date('d/m/Y', $p['eta']);?></td>
                        <?php endif;?>

                    <td>
                      <?php if ($p['filename'] == 'N'):?>
                        <a href="#" class="badge badge-primary uploadDoc" data-id="<?= $p['id_tracking'];?>" data-toggle="modal" data-target="#modalUpload">Upload</a>
                      <?php endif;?>

                      <?php if ($p['jenis'] == 'manifes'):?>
                        <?php if ($p['next'] == 0):?>
                          <a href="#" class="badge badge-warning ubahDoc" data-id="<?= $p['id_tracking'];?>" data-toggle="modal" data-target="#modal<?= $modal?>">Ubah</a>
                        <?php endif;?>
                      <?php endif;?>
                    </td>
                  </tr>
                <?php endforeach;?>
                </tbody>
              </table>

              <div class="row">
                  <div class="col">
                      <?php echo $pagination; ?>
                  </div>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->