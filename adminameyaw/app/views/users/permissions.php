<?php extract($data); ?>
<style>
    .btn-xs {
        padding: 3px 9px;
        font-size: 12px;
    }

    .btn {
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }
</style>

<div class="card card-custom" style="width: 100%;">
    <div class="card-header">
        <h3 class="card-title">
            View Permissions
        </h3>
    </div>

    <div class="card-body">
    <table class="table table-sm table-separate table-head-custom table-checkable" id="formTable" style="width: 100%;">
        <thead>
            <tr>
                <th class="th-col-10">No.</th>
                <th class="th-col-20">User</th>
                <th class="th-col-20">Email Address</th>
                <th class="th-col-20">Permissions</th>
                <th class="th-col-10">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $previousUuid = null;
            $permissions = [];
            foreach ($listPermissions as $result) {
                if ($result->uuid != $previousUuid) {
                    if ($permissions) { 
                        ?>
                        <tr>
                            <td rowspan="<?= count($permissions) ?>"><strong class="text-black"><?= $no++ ?></strong></td>
                            <td rowspan="<?= count($permissions) ?>"><?= Tools::getUserFullName($permissions[0]->uuid) ?></td>
                            <td rowspan="<?= count($permissions) ?>"><?= Tools::getUserEmail($permissions[0]->uuid) ?></td>
                            <td><?= $permissions[0]->permission ?></td>
                            <td><button class="btn btn-danger btn-xs deletePermission" dbid="<?= $permissions[0]->id ?>">Delete</button></td>
                        </tr>
                        <?php
                        foreach (array_slice($permissions, 1) as $permission) { ?>
                            <tr>
                                <td><?= $permission->permission ?></td>
                                <td><button class="btn btn-danger btn-xs deletePermission" dbid="<?= $permission->id ?>">Delete</button></td>
                            </tr>
                        <?php }
                    }

                    $permissions = [];
                }

                $permissions[] = $result;
                $previousUuid = $result->uuid;
            }

            if ($permissions) {
                ?>
                <tr>
                    <td rowspan="<?= count($permissions) ?>"><strong class="text-black"><?= $no++ ?></strong></td>
                    <td rowspan="<?= count($permissions) ?>"><?= Tools::getUserFullName($permissions[0]->uuid) ?></td>
                    <td rowspan="<?= count($permissions) ?>"><?= Tools::getUserEmail($permissions[0]->uuid) ?></td>
                    <td><?= $permissions[0]->permission ?></td>
                    <td><button class="btn btn-danger btn-xs deletePermission" dbid="<?= $permissions[0]->id ?>">Delete</button></td>
                </tr>
                <?php
                foreach (array_slice($permissions, 1) as $permission) { ?>
                    <tr>
                        <td><?= $permission->permission ?></td>
                        <td><button class="btn btn-danger btn-xs deletePermission" dbid="<?= $permission->id ?>">Delete</button></td>
                    </tr>
                <?php }
            }
            ?>
        </tbody>

    </table>
</div>


</div>




<script>
   $(document).ready(function() {
        $(document).off('click', '.deletePermission').on('click', '.deletePermission', function() {
            var dbid = $(this).attr('dbid');
            var formData = { dbid: dbid };

            $.confirm({
                title: 'Delete Record!',
                content: 'Are you sure to continue?',
                buttons: {
                    no: {
                        text: 'No',
                        keys: ['enter', 'shift'],
                        backdrop: 'static',
                        keyboard: false,
                        action: function() {
                            $.alert('Data is safe');
                        }
                    },
                    yes: {
                        text: 'Yes, Delete it!',
                        btnClass: 'btn-blue',
                        action: function() {
                            console.log("AJAX request is about to be sent");

                            $.ajax({
                                url: `${urlroot}/users/deletePermission`,
                                type: 'POST',
                                data: formData,
                                success: function(response) {
                                    console.log("Success response:", response);
                                    window.location.href = '/users/index';
                                    history.pushState(null, null, '/users/index');
                                    loadPage(`${urlroot}/users/permissions`);
                                    $('.navi-link').removeClass('active');
                                    $('#permissions').addClass('active');
                                    $.alert('Record deleted successfully');
                                },
                                error: function(xhr, status, error) {
                                    console.log("Error:", error);
                                    $.alert('Error: ' + error);
                                }
                            });



                        }
                    }
                }
            });
        });
    });




     var oTable = $('#formTable').DataTable({
        stateSave: true,
        "bLengthChange": false,
        "language": {
            "info": "Showing _START_ to _END_ of _TOTAL_ entries",
            "infoEmpty": "Showing 0 to 0 of 0 entries",
            "infoFiltered": "(filtered from _MAX_ total entries)",
            "lengthMenu": "Show _MENU_ entries"
        }
    });

    $('#formTable_filter').html(`
        <div class="input-icon">
            <input type="text" id="formTable_search" class="form-control" placeholder="Search...">
            <span>
                <i class="flaticon2-search-1 text-muted"></i>
            </span>
        </div>
    `);

    $('#formTable_search').on('keyup', function () {
        oTable.search($(this).val()).draw();
    });

</script>