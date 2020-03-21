<div class="row">
    <div class="col-12 p-0">
        <ul class="nav nav-tabs tabs-bordered nav-justified">
            <li class="nav-item d-block d-md-none">
                <a href="#apm_service_<?= $item_apm['id'] ?>" data-toggle="tab" aria-expanded="false" class="nav-link ">
                    <i class="mdi mdi-panda mr-2"></i>
                </a>
            </li>
            <li class="nav-item">
                <a href="#apm_note_<?= $item_apm['id'] ?>" data-toggle="tab" aria-expanded="false" class="nav-link active">
                    <i class="fa fa-sticky-note-o mr-2"></i>
                </a>
            </li>
            <li class="nav-item">
                <a href="#apm_room_<?= $item_apm['id'] ?>" data-toggle="tab" aria-expanded="true" class="nav-link">
                    <i class="dripicons-view-apps mr-2"></i>
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane" id="apm_service_<?= $item_apm['id'] ?>">
            <?php 
                $data['list_service'] = $list_service;
                $data['district_key'] = $district_key;
                $data['list_district_editable'] = $list_district_editable;

                $editableRoomStatus = '';
                $editableRoom = '';
                $note_editable = '';
                if($list_district_editable != null)
                {
                    $editableRoomStatus = in_array($district_key, $list_district_editable) != 0 ? 'room-status':'';
                    $editableRoom = in_array($district_key, $list_district_editable) != 0 ? 'contenteditable="true"':'';
                    $note_editable = in_array($district_key, $list_district_editable) != 0 ? 'note-editable':'';
                }

                $this->load->view('components/apm-services-mobile', $data);
            ?>
            </div>
            <div class="tab-pane active" id="apm_note_<?= $item_apm['id'] ?>">
                <!-- CUSTOM Ghi Chú -->
                <blockquote class="blockquote blockquote-custom bg-white p-4 shadow rounded">
                    <div class="blockquote-custom-icon bg-info shadow-sm copy-text" 
                         data-clipboard-target="#note-<?= $item_apm['id']?>">
                            <i class="fa fa-quote-left text-white btn"></i>
                    </div>

                    <span class="mb-0 mt-1 font-italic note <?= $note_editable ?>">
                        <div id="note-<?= $item_apm['id']?>" 
                            data-name="note" 
                             data-pk="<?= $item_apm['id'] ?>">
                             <?= $item_apm['note'] =="chưa có note"? "": trim($item_apm['note']) ?>
                        </div>
                    </span>
                    <footer class="blockquote-footer pt-1 mt-1 border-top">
                        <cite title="Source Title">Not Not Tomorrow</cite>
                    </footer>
                </blockquote>
                <!-- END -->
            </div>

            <div class="tab-pane" id="apm_room_<?= $item_apm['id'] ?>">
                <?php 
                    /*Get all room by ROOM.id_apartment = id of apartment */
                    $this->load->model('apartment_model');
                    $list_room = $this->apartment_model->getListRoomById($item_apm['id']);
                    $add_new_room_btn = 'd-none';
                    if($list_district_editable != null)
                    {
                        $add_new_room_btn = (in_array($district_key, $list_district_editable) != 0) && ($editable == 1) ? '':'d-none' ;
                    }
                    
                 ?>
                    <div class="table-responsive">
                        <table id="room_datatable_<?= $item_apm['id'] ?>" class="datatable apm_room table table-bordered">
                            <div class="addRow mb-1 <?= $add_new_room_btn ?>" id="btn-<?= $item_apm['id'] ?>">
                                <button class="btn btn-success">+</button>
                            </div>
                            <thead>
                                <tr class="text-muted">
                                    <th>Mã</th>
                                    <th class="item-room-type">Loại</th>
                                    <th class="item-room-price">Giá</th>
                                    <th>m<sup>2</sup></th>
                                    <th>Trống</th>
                                    <th>Sắp</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Room infomation -->
                                <?php foreach ($list_room as $key_room => $item_room): ?>
                                    <?php 
                                        $delete_td_room = '';
                                        if($list_district_editable != null)
                                        {
                                                $delete_td_room = (in_array($district_key, $list_district_editable) != 0 AND $editable) ?
                                                '
                                                <div class=" float-left room-delete checkbox checkbox-danger checkbox-circle">
                                                    <input id="room-delete-'. $item_room['id'].'" type="checkbox"/>
                                                    <label class="text-danger" for="room-delete-'. $item_room['id'].'">
                                                        Xóa
                                                    </label>
                                                    <div id="confirm-room-delete-'. $item_room['id'].'"></div>
                                                </div>':'';
                                        }
                                     ?>
                                    <tr>
                                        <td id="maphong-<?= $item_room['id'] ?>" <?=$editableRoom ?>>
                                            <?= $item_room['maphong'] ?>
                                        </td>
                                        <td id="id_type-<?= $item_room['id'] ?>" <?=$editableRoom ?>>
                                            <?= $item_room['id_type'] ?>
                                        </td>
                                        <td id="price-<?= $item_room['id'] ?>" <?=$editableRoom ?> class="font-weight-bold">
                                            <?= $item_room['price'] ?>
                                        </td>
                                        <td id="square-<?= $item_room['id'] ?>" <?=$editableRoom ?>>
                                            <?= $item_room['square'] ?>
                                        </td>
                                        <td id="id_status-<?= $item_room['id'] ?>" class="<?= $editableRoomStatus ?>">
                                            <?= $item_room['id_status'] ?>
                                        </td>
                                        <td id="saptrong-<?= $item_room['id'] ?>" <?=$editableRoom ?>>
                                            <?= $item_room['saptrong'] ?>
                                        </td>
                                        <td>
                                            <?= $delete_td_room ?>
                                        </td>

                                    </tr>
                                    <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
            </div>

            <div class="tab-pane" id="apm_images<?= $item_apm['id'] ?>">
                <p><i>Tính năng này chưa có</i></p>
            </div>

            <div class="tab-pane" id="apm_map<?= $item_apm['id'] ?>">
                <p><i>Tính năng này cũng chưa có</i></p>
            </div>
            <hr>
            <div class="row container float-right">
                <a data-toggle="collapse" data-parent="#accordion" href="#apm_<?= $item_apm['id'] ?>" class="col-2 p-0 justify-content-center " aria-expanded="true" aria-controls="collapseOne">
                    <button type="button" class="btn btn-custom btn-sm btn-rounded waves-light waves-effect">
                        <i class=" dripicons-chevron-up align-middle"></i>
                    </button>
                </a>
            </div>
        </div>
    </div>
</div>
<!--endrow-->