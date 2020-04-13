<div class="card-header pb-1 " role="tab" id="headingOne">
    <div class="row">
        <a data-toggle="collapse" href="#apm_<?= $item_apm['id'] ?>" class="col-2 col-md p-md p-0 justify-content-center">
            <button type="button" class=" text-center btn btn-custom btn-sm btn-rounded waves-light waves-effect">
                <i class=" dripicons-chevron-down align-middle"></i>
            </button>
        </a>

        <div class="col-7 col-md-7 col-lg-9 p-1 d-md-inline header-title font-weight-bold text-dark address" style="line-height: 16px;">
            <div data-name="address" data-pk="<?= $item_apm['id'] ?>" 
                class="<?= $address_can_editable ?>
                        address-item-detail">
                <?= $item_apm['address'] ?>
            </div>

        </div>

        <span class="col-1 col-md offset-1 text-center switchery-demo" style="line-height: 30px">
            <input type="checkbox" 
                   checked data-plugin="switchery" 
                   data-color="#ff5d48"
                   data-size="small" class="float-right" />
        </span>
    </div>
    <div class="row mt-1">
        <span class="col-lg-2 col-md-6 col-6 ribbon-box apartment-date-update">
            <span class="ribbon ribbon-warning" style="margin-bottom: 0px;">
                <span><?= $item_apm['dateup'] ?></span>
            </span>

        </span>
        <span class="col-lg-5 <?= $power_sale ?>">
            <?php foreach ($list_this_apm_tag as $tag):?>
                <span class="badge badge-warning" ><?= $tag ?></span>
            <?php endforeach; ?>
        </span>
        <div class="mt-1 mt-lg-0 col-9 col-lg-6 offset-lg-3 <?= $power_lead ?>">
            <select id="apm-tag-<?= $item_apm['id'] ?>" class="select2 <?= $apartment_tag ?>" multiple data-placeholder="Chọn tags...">
            <?php foreach ($list_apm_tag as $row): ?>
                <option 
                    <?= in_array($row['slug'], array_keys($list_this_apm_tag)) == true ? 'selected':'' ?> 
                    value="<?= $row['slug'] ?>">
                    <?= $row['name'] ?>
                </option>
            <?php endforeach ?>
            </select>
        </div>
        <span class="col-lg-1 offset-lg-0 mt-lg-0 col-2 offset-0 mt-1  col-md-1 offset-md-4 <?= $power_lead ?> apartment-delete">
            <?= $apartment_can_delete_btn_view ?>
        </span>
        
        
    </div>
</div>