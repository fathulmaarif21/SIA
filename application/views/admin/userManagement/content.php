<div class="card">
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs" id="bologna-list" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" href="#createUser" role="tab" aria-controls="description" aria-selected="true"><i class="fas fa-user-plus"></i> Buat User Baru</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#tableUsers" role="tab" aria-controls="history" aria-selected="false"><i class="fas fa-users"></i> Daftar User</a>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content mt-3">
            <div class="tab-pane active" id="createUser" role="tabpanel">
                <?= $this->include('admin/userManagement/createUser'); ?>
            </div>

            <div class="tab-pane" id="tableUsers" role="tabpanel" aria-labelledby="history-tab">
                <?= $this->include('admin/userManagement/tableUsers'); ?>
            </div>
        </div>
    </div>
</div>