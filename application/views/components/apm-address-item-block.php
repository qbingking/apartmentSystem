<div class="card-header pb-1 " role="tab" id="headingOne">
    <div class="row">
        <a data-toggle="collapse"
           data-parent="#accordion" 
           href="#apm_<?= $item_apm['id'] ?>" 
           class="col-2 col-md-1 p-0 justify-content-center" 
           aria-expanded="true" aria-controls="collapseOne">
            
            <button type="button" class="btn btn-custom btn-sm btn-rounded waves-light waves-effect">
                <i class=" dripicons-chevron-down align-middle"></i>
            </button>
        </a>

        <div class="col-7 col-md-7 m-md-1 p-1 d-md-inline header-title font-weight-bold text-dark address"  style="line-height: 16px;">
            <div id="apm_info_<?= $item_apm['id'] ?>" data-name="address" data-pk="<?= $item_apm['id'] ?>" 
            	class=" <?= in_array($district_key, $list_district_editable) != 0 ? 'address-editable ':''?> 
            			address-item-detail">
            			<?= $item_apm['address'] ?>
            </div>
        </div>

        <span class="col-1 col-md-1 offset-1 p-0 offset-md-2 switchery-demo" style="line-height: 30px">
            <input type="checkbox" 
                   checked data-plugin="switchery" 
                   data-color="#ff5d48"
                   data-size="small" class="float-right" />
        </span>

        <div class="mt-1 w-100 room-status-counts">
            <div class="row">
                <!-- <span class="ribbon-box col offset-5 offset-md-7 offset-lg-8 offset-xl-9">
                    <span class="ribbon ribbon-info"><span>20</span></span>
                </span>
                <span class="ribbon-box col">
                    <span class="ribbon ribbon-info"><span>04</span></span>
                </span>
                <span class="ribbon-box col">
                    <span class="ribbon ribbon-info"><span>12</span></span>
                </span> -->
                 <span class="ribbon-box col">
                    <span class="ribbon ribbon-warning" style="margin-bottom: 0px;"><span><?= $item_apm['dateup'] ?></span></span>
                </span>
            </div>

            <div class=" float-right apm-delete checkbox checkbox-danger checkbox-circle">
                <input id="apm-delete-<?= $item_apm['id'] ?>" type="checkbox">
                <label class="<?= (in_array($district_key, $list_district_editable) != 0 AND $editable) ? '':'d-none '?> text-danger" for="apm-delete-<?= $item_apm['id'] ?>">
                    Xóa
                </label>
                <div id="confirm-apm-delete-<?= $item_apm['id'] ?>"></div>
            </div>
        </div>
    </div> 
</div>